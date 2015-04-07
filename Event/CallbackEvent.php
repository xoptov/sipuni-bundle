<?php

namespace Perfico\SipuniBundle\Event;

use Perfico\SipuniBundle\Entity\CallEventInterface;
use Symfony\Component\EventDispatcher\Event;

class CallbackEvent extends Event
{
    /** @var CallEventInterface */
    protected $callEvent;

    /**
     * @param CallEventInterface $callEvent
     */
    public function setCallEvent(CallEventInterface $callEvent)
    {
        $this->callEvent = $callEvent;
    }

    /**
     * @return CallEventInterface
     */
    public function getCallEvent()
    {
        return $this->callEvent;
    }
} 