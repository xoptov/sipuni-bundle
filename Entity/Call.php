<?php

namespace Perfico\SipuniBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

abstract class Call implements CallInterface
{
    /** integer */
    protected $id;

    /** @var string */
    protected $callExtId;

    /** @var \DateTime */
    protected $createdAt;

    /** @var ArrayCollection */
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
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function setCallExtId($callId)
    {
        $this->callExtId = $callId;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCallExtId()
    {
        return $this->callExtId;
    }

    /**
     * {@inheritdoc}
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function getCallEvents()
    {
        return $this->callEvents;
    }

    /**
     * {@inheritdoc}
     */
    public function setAnswerEvent(AnswerEvent $event)
    {
        $this->answerEvent = $event;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAnswerEvent()
    {
        return $this->answerEvent;
    }

    /**
     * {@inheritdoc}
     */
    public function setHangupEvent(HangupEventInterface $event)
    {
        $this->hangupEvent = $event;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getHangupEvent()
    {
        return $this->hangupEvent;
    }
} 