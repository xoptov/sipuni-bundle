<?php

namespace Perfico\SipuniBundle\Service\Manager;

use Perfico\SipuniBundle\Entity\Call;
use Perfico\SipuniBundle\Entity\CallEventInterface;
use Perfico\SipuniBundle\Event\CallbackEvent;
use Perfico\SipuniBundle\Exception\CallChainException;
use Perfico\SipuniBundle\Exception\CallTypeException;
use Perfico\SipuniBundle\PerficoSipuniEvents;
use Symfony\Component\HttpFoundation\Request;
use Perfico\SipuniBundle\Service\Factory\EventFactoryInterface;
use Perfico\SipuniBundle\Service\Factory\AnswerEventFactory;
use Perfico\SipuniBundle\Service\Factory\CallEventFactory;
use Perfico\SipuniBundle\Service\Factory\HangupEventFactory;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Doctrine\Common\Persistence\ObjectManager;

class EventManager
{
    /** @var CallManager */
    protected $manager;

    /** @var EventDispatcherInterface */
    protected $dispatcher;

    /** @var ObjectManager */
    protected $objectManager;

    public function __construct(CallManager $manager, EventDispatcherInterface $dispatcher, ObjectManager $om)
    {
        $this->manager = $manager;
        $this->dispatcher = $dispatcher;
        $this->objectManager = $om;
    }

    /**
     * @param Request $request
     * @throws CallChainException
     * @return CallEventInterface
     */
    public function processing(Request $request)
    {
        // Retrieving event factory by factory manager
        $factory = $this->createFactory($request);

        $callEvent = $factory->create();
        $factory->hydration($callEvent, $request);
        $this->objectManager->persist($callEvent);

        // Retrieving Call by CallManager
        $call = $this->manager->search($callEvent);

        if ($call instanceof Call) {
            $callEvent->setCall($call);
            if ($callEvent->getType() == CallEventInterface::TYPE_CALL) {
                $event = $this->createEvent($callEvent);

                $this->dispatcher->dispatch(PerficoSipuniEvents::CALL, $event);
            } else {
                $this->processingChain($callEvent);
            }
        } else {
            if ($callEvent->getType() == CallEventInterface::TYPE_CALL) {
                $call = $this->manager->create($callEvent);
                $callEvent->setCall($call);
                $event = $this->createEvent($callEvent);

                $this->dispatcher->dispatch(PerficoSipuniEvents::FIRST_CALL, $event);
            } else {
                throw new CallChainException($callEvent);
            }
        }

        return $callEvent;
    }

    /**
     * @param CallEventInterface $callEvent
     * @throws CallTypeException
     */
    protected function processingChain(CallEventInterface $callEvent)
    {
        $call = $callEvent->getCall();
        if ($callEvent->getType() == CallEventInterface::TYPE_ANSWER) {
            $call->setAnswerEvent($callEvent);
            $event = $this->createEvent($callEvent);

            $this->dispatcher->dispatch(PerficoSipuniEvents::ANSWER, $event);

        } else if ($callEvent->getType() == CallEventInterface::TYPE_HANGUP) {
            $call->setHangupEvent($callEvent);
            $event = $this->createEvent($callEvent);

            $this->dispatcher->dispatch(PerficoSipuniEvents::HANGUP, $event);

        } else {
            throw new CallTypeException($callEvent);
        }
    }

    /**
     * @param CallEventInterface $callEvent
     * @return CallbackEvent
     */
    protected function createEvent(CallEventInterface $callEvent)
    {
        $event = new CallbackEvent();
        $event->setCallEvent($callEvent);

        return $event;
    }

    /**
     * @param Request $request
     * @return EventFactoryInterface
     */
    protected function createFactory(Request $request)
    {
        switch ($request->get('event')) {
            case CallEventInterface::TYPE_HANGUP:
                $factory = new HangupEventFactory();
                break;
            case CallEventInterface::TYPE_ANSWER:
                $factory = new AnswerEventFactory();
                break;
            default:
                $factory = new CallEventFactory();
        }

        return $factory;
    }
} 