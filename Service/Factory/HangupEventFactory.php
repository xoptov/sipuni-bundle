<?php

namespace Perfico\SipuniBundle\Service\Factory;

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
    public function hydration(CallEventInterface $event, Request $request)
    {
        /**
         * @var HangupEvent $event
         */
        parent::hydration($event, $request);

        $event->setStatus($request->get('status'));

        if ($request->get('call_start_timestamp')) {
            $startCallDate = new \DateTime();
            $startCallDate->setTimestamp($request->get('call_start_timestamp'));
            $event->setStartDate($startCallDate);
        }

        $event->setRecordLink($request->get('call_record_link'));
    }
} 