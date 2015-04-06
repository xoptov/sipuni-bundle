<?php

namespace Perfico\SipuniBundle\Service\Factory;

use Perfico\SipuniBundle\Entity\Call;
use Perfico\SipuniBundle\Entity\CallEventInterface;
use Perfico\SipuniBundle\Entity\HangupEvent;
use Symfony\Component\HttpFoundation\Request;

class HangupEventFactory extends CallEventFactory
{
    /**
     * {@inheritdoc}
     */
    public function create()
    {
        return new HangupEvent();
    }

    /**
     * {@inheritdoc}
     */
    public function hydration(CallEventInterface $event, Request $request, Call $call)
    {
        /**
         * @var HangupEvent $event
         */
        parent::hydration($event, $request, $call);

        $event->setStatus($request->get('status'));

        if ($request->get('call_start_timestamp')) {
            $date = new \DateTime();
            $date->setTimestamp($request->get('call_start_timestamp'));
            $event->setStartDate($date);
        }

        $event->setRecordLink($request->get('call_record_link'));
    }
} 