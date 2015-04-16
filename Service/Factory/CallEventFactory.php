<?php

namespace Perfico\SipuniBundle\Service\Factory;

use Perfico\SipuniBundle\Entity\CallEvent;
use Perfico\SipuniBundle\Entity\CallEventInterface;
use Symfony\Component\HttpFoundation\Request;

class CallEventFactory implements EventFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function create()
    {
        return new CallEvent();
    }

    /**
     * {@inheritdoc}
     */
    public function hydration(CallEventInterface $event, Request $request)
    {
        $event->setCallExtId($request->get('call_id'))
            ->setType($request->get('event'))
            ->setSrcNumber(trim($request->get('src_num')))
            ->setSrcType($request->get('src_type'))
            ->setDstNumber(trim($request->get('dst_num')))
            ->setDstType($request->get('dst_type'))
            ->setTreeName($request->get('treeName'))
            ->setTreeNumber($request->get('treeNumber'));

        if ($request->get('timestamp')) {
            $date = new \DateTime();
            $date->setTimestamp($request->get('timestamp'));
            $event->setEventDate($date);
        }
    }
} 