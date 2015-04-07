<?php

namespace Perfico\SipuniBundle\Service\Factory;

use Perfico\SipuniBundle\Entity\CallEventInterface;
use Symfony\Component\HttpFoundation\Request;

interface EventFactoryInterface
{
    /**
     * @return CallEventInterface
     */
    public function create();

    /**
     * @param CallEventInterface $event
     * @param Request $request
     */
    public function hydration(CallEventInterface $event, Request $request);
} 