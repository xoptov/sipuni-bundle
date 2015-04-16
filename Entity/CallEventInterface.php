<?php

namespace Perfico\SipuniBundle\Entity;

use Perfico\SipuniBundle\Entity;

interface CallEventInterface
{
    /**
     * @const
     */
    const TYPE_CALL = 1;
    const TYPE_HANGUP = 2;
    const TYPE_ANSWER = 3;

    /**
     * @return integer
     */
    public function getId();

    /**
     * @param string $callId
     * @return CallEventInterface
     */
    public function setCallExtId($callId);

    /**
     * @return string
     */
    public function getCallExtId();

    /**
     * @param Call $call
     * @return CallEventInterface
     */
    public function setCall(Call $call);

    /**
     * @return Call
     */
    public function getCall();

    /**
     * @param integer $type
     * @return CallEventInterface
     */
    public function setType($type);

    /**
     * @return integer
     */
    public function getType();

    /**
     * @param string $number
     * @return CallEventInterface
     */
    public function setSrcNumber($number);

    /**
     * @return string
     */
    public function getSrcNumber();

    /**
     * @param integer $type
     * @return CallEventInterface
     */
    public function setSrcType($type);

    /**
     * @return string
     */
    public function getSrcType();

    /**
     * @param string $number
     * @return CallEventInterface
     */
    public function setDstNumber($number);

    /**
     * @return string
     */
    public function getDstNumber();

    /**
     * @param integer $type
     * @return CallEventInterface
     */
    public function setDstType($type);

    /**
     * @return integer
     */
    public function getDstType();

    /**
     * @param \DateTime $date
     * @return CallEventInterface
     */
    public function setEventDate(\DateTime $date);

    /**
     * @return \DateTime
     */
    public function getEventDate();

    /**
     * @param string $name
     * @return CallEventInterface
     */
    public function setTreeName($name);

    /**
     * @return string
     */
    public function getTreeName();

    /**
     * @param string $number
     * @return CallEventInterface
     */
    public function setTreeNumber($number);

    /**
     * @return string
     */
    public function getTreeNumber();
} 