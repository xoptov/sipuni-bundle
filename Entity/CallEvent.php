<?php

namespace Perfico\SipuniBundle\Entity;

use Perfico\SipuniBundle\Entity;

class CallEvent implements CallEventInterface
{
    /** @var integer */
    protected $id;

    /** @var string */
    protected $callExtId;

    /** @var Call */
    protected $call;

    /** @var integer */
    protected $type;

    /** @var string */
    protected $srcNumber;

    /** @var integer */
    protected $srcType;

    /** @var  string */
    protected $dstNumber;

    /** @var integer */
    protected $dstType;

    /** @var \DateTime */
    protected $eventDate;

    /** @var string */
    protected $treeName;

    /** @var string */
    protected $treeNumber;

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
    public function setCall(Call $call)
    {
        $this->call = $call;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCall()
    {
        return $this->call;
    }

    /**
     * {@inheritdoc}
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function setSrcNumber($number)
    {
        $this->srcNumber = $number;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getSrcNumber()
    {
        return $this->srcNumber;
    }

    /**
     * {@inheritdoc}
     */
    public function setSrcType($type)
    {
        $this->srcType = $type;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getSrcType()
    {
        return $this->srcType;
    }

    /**
     * {@inheritdoc}
     */
    public function setDstNumber($number)
    {
        $this->dstNumber = $number;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDstNumber()
    {
        return $this->dstNumber;
    }

    /**
     * {@inheritdoc}
     */
    public function setDstType($type)
    {
        $this->dstType = $type;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDstType()
    {
        return $this->dstType;
    }

    /**
     * {@inheritdoc}
     */
    public function setEventDate(\DateTime $date)
    {
        $this->eventDate = $date;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getEventDate()
    {
        return $this->eventDate;
    }

    /**
     * {@inheritdoc}
     */
    public function setTreeName($name)
    {
        $this->treeName = $name;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTreeName()
    {
        return $this->treeName;
    }

    /**
     * {@inheritdoc}
     */
    public function setTreeNumber($number)
    {
        $this->treeNumber = $number;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTreeNumber()
    {
        return $this->treeNumber;
    }
} 