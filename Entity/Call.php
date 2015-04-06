<?php

namespace Perfico\SipuniBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Perfico\CRMBundle\Entity\ActivityInterface;
use Perfico\CRMBundle\Entity\AccountInterface;

abstract class Call
{
    /** integer */
    protected $id;

    /** @var string */
    protected $callExtId;

    /** @var \DateTime */
    protected $createdAt;

    /** @var ActivityInterface */
    protected $activity;

    /** @var AccountInterface */
    protected $account;

    /** @var CallEventInterface[] */
    protected $callEvents;

    /** @var AnswerEvent */
    protected $answerEvent;

    /** @var HangupEventInterface */
    protected $hangupEvent;

    public function onCreate()
    {
        $this->createdAt = new \DateTime();
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
     * @param ActivityInterface $activity
     * @return Call
     */
    public function setActivity(ActivityInterface $activity)
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * @return ActivityInterface
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * @param AccountInterface $account
     * @return Call
     */
    public function setAccount(AccountInterface $account)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * @return AccountInterface
     */
    public function getAccount()
    {
        return $this->account;
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