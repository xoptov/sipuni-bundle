<?php

namespace Perfico\SipuniBundle\Entity;

interface HangupEventInterface extends CallEventInterface
{
    /**
     * @param string $status
     * @return HangupEventInterface
     */
    public function setStatus($status);

    /**
     * @return string
     */
    public function getStatus();

    /**
     * @param \DateTime $date
     * @return HangupEventInterface
     */
    public function setStartDate(\DateTime $date);

    /**
     * @return \DateTime
     */
    public function getStartDate();

    /**
     * @param string $link
     * @return HangupEventInterface
     */
    public function setRecordLink($link);

    /**
     * @return string
     */
    public function getRecordLink();
} 