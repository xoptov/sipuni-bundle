<?php

namespace Perfico\SipuniBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

interface CallInterface
{
    /**
     * @return integer
     */
    public function getId();

    /**
     * @param string $callId
     * @return CallInterface
     */
    public function setCallExtId($callId);

    /**
     * @return string
     */
    public function getCallExtId();

    /**
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * @return ArrayCollection
     */
    public function getCallEvents();

    /**
     * @param AnswerEvent $event
     * @return CallInterface
     */
    public function setAnswerEvent(AnswerEvent $event);

    /**
     * @return AnswerEvent
     */
    public function getAnswerEvent();

    /**
     * @param HangupEventInterface $event
     * @return CallInterface
     */
    public function setHangupEvent(HangupEventInterface $event);

    /**
     * @return HangupEventInterface
     */
    public function getHangupEvent();
} 