<?php

namespace Perfico\SipuniBundle\Entity;

class HangupEvent extends CallEvent implements HangupEventInterface
{
    /** @var string */
    protected $status;

    /** @var \DateTime */
    protected $startDate;

    /** @var string */
    protected $recordLink;

    /**
     * {@inheritdoc}
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * {@inheritdoc}
     */
    public function setStartDate(\DateTime $date)
    {
        $this->startDate = $date;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * {@inheritdoc}
     */
    public function setRecordLink($link)
    {
        $this->recordLink = $link;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRecordLink()
    {
        return $this->recordLink;
    }
}