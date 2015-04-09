<?php

namespace Perfico\SipuniBundle\Exception;

use Perfico\SipuniBundle\Entity\CallEventInterface;

class CallException extends \Exception
{
    /** @var CallEventInterface */
    protected $callEvent;

    public function __construct(CallEventInterface $callEvent, $message = '', $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->callEvent = $callEvent;
    }

    public function getCallEvent()
    {
        return $this->callEvent;
    }
} 