<?php

namespace Perfico\SipuniBundle\Controller;

use Monolog\Handler\StreamHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CallbackController extends Controller
{
    public function indexAction(Request $request)
    {
        $logFile = $this->container->getParameter('kernel.logs_dir') . '/telephony.log';
        $streamHandler = new StreamHandler($logFile);
        $logger = $this->get('logger');
        $logger->pushHandler($streamHandler);
        $logger->debug($request->getRequestUri());

        $eventManager = $this->get('perfico_sipuni.event_manager');
        $eventManager->processing($request);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return new JsonResponse(array('success' => true));
    }
} 