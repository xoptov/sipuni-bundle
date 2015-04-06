<?php

namespace Perfico\SipuniBundle\Controller;

use Monolog\Handler\StreamHandler;
use Perfico\SipuniBundle\Event\CallbackEvent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Perfico\SipuniBundle\Service\Manager\CallManager;

class CallbackController extends Controller
{
    /**
     * @Method("GET")
     * @Route("/sipuni/callback")
     */
    public function indexAction(Request $request)
    {
        $logFile = $this->container->getParameter('kernel.logs_dir') . '/telephony.log';
        $streamHandler = new StreamHandler($logFile);
        $logger = $this->get('logger');
        $logger->pushHandler($streamHandler);
        $logger->debug($request->getRequestUri());

        if ($request->get('call_id') == null) {
            throw new BadRequestHttpException('call_id must be specified');
        }

        /** @var CallManager $callManager */
        $entityManager = $this->get('doctrine.orm.entity_manager');
        $callManager = $this->get('perfico_sipuni.call_manager');
        $pvm = $this->get('perfico_sipuni.event_manager');
        $dispatcher = $this->get('event_dispatcher');

        $account = $this->get('perfico_crm.account_manager')->getCurrentAccount();
        $call = $callManager->retrieveCall($request->get('call_id'), $account);

        $factory = $pvm->getFactory($request);
        $callEvent = $factory->create();
        $callEvent->setAccount($account);

        $factory->hydration($callEvent, $request, $call);

        $pvm->processing($callEvent);
        $pvm->determineUser($callEvent);

        switch (get_class($callEvent)) {

            case 'Perfico\SipuniBundle\Entity\AnswerEvent':
                $pvm->relateAnswerEvent($callEvent);
                break;

            case 'Perfico\SipuniBundle\Entity\HangupEvent':
                $pvm->relateHangupEvent($callEvent);
                $pvm->prepareActivityNote($callEvent);
                break;

        }

        $entityManager->persist($callEvent);

        $event = new CallbackEvent();
        $event->setCallEvent($callEvent);

        $dispatcher->dispatch(CallbackEvent::CALL_EVENT, $event);

        $entityManager->flush();

        return new JsonResponse(array('success' => true));
    }
} 