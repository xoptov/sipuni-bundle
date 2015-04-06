<?php

namespace Perfico\SipuniBundle\Service\Factory;

use Perfico\SipuniBundle\Entity\CallEventInterface;
use Symfony\Component\HttpFoundation\Request;
use Perfico\SipuniBundle\Entity\Call;

interface EventFactoryInterface
{
    /**
     * @return CallEventInterface
     */
    public function create();

    /**
     * @param CallEventInterface $event
     * @param Request $request
     * @param Call $call
     */
    public function hydration(CallEventInterface $event, Request $request, Call $call);
} 