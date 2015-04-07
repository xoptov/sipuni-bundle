<?php

namespace Perfico\SipuniBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

abstract class Call
{
    /** integer */
    protected $id;

    /** @var string */
    protected $callExtId;

    /** @var \DateTime */
    protected $createdAt;

    /** @var CallEventInterface[] */
    protected $callEvents;

    /** @var AnswerEvent */
    protected $answerEvent;

    /** @var HangupEventInterface */
    protected $hangupEvent;

    public function onCreate()
    {
        $this->createdAt = new \DateTime();
    }

    public function __construct()
    {
        $this->callEvents = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $callId
     * @return Call
     */
    public function setCallExtId($callId)
    {
        $this->callExtId = $callId;

        return $this;
    }

    /**
     * @return string
     */
    public function getCallExtId()
    {
        return $this->callExtId;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return ArrayCollection
     */
    public function getCallEvents()
    {
        return $this->callEvents;
    }

    /**
     * @param AnswerEvent $event
     * @return Call
     */
    public function setAnswerEvent(AnswerEvent $event)
    {
        $this->answerEvent = $event;

        return $this;
    }

    /**
     * @return AnswerEvent
     */
    public function getAnswerEvent()
    {
        return $this->answerEvent;
    }

    /**
     * @param HangupEventInterface $event
     * @return Call
     */
    public function setHangupEvent(HangupEventInterface $event)
    {
        $this->hangupEvent = $event;

        return $this;
    }

    /**
     * @return HangupEventInterface
     */
    public function getHangupEvent()
    {
        return $this->hangupEvent;
    }
} 