<?php

namespace Perfico\SipuniBundle\Service\Manager;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Perfico\SipuniBundle\Entity\CallEventInterface;
use Perfico\SipuniBundle\Entity\Call;

class CallManager
{
    /** @var ObjectManager */
    protected $objectManager;

    /** @var string */
    protected $class;

    /** @var ObjectRepository */
    protected $repository;

    public function __construct(ObjectManager $om, $class)
    {
        $this->objectManager = $om;
        $this->repository = $om->getRepository($class);

        $metadata = $om->getClassMetadata($class);
        $this->class = $metadata->getName();
    }

    /**
     * @param CallEventInterface $callEvent
     * @return Call
     */
    public function create(CallEventInterface $callEvent)
    {
        /** @var Call $call */
        $call = new $this->class;
        $call->setCallExtId($callEvent->getCallExtId());

        switch ($callEvent->getType()) {
            case CallEventInterface::TYPE_ANSWER:
                $call->setAnswerEvent($callEvent);
                break;
            case CallEventInterface::TYPE_HANGUP:
                $call->setHangupEvent($callEvent);
                break;
        }

        $this->objectManager->persist($call);

        return $call;
    }

    /**
     * @param CallEventInterface $callEvent
     * @return Call
     */
    public function search(CallEventInterface $callEvent)
    {
        return $this->repository->findOneBy(['callExtId' => $callEvent->getCallExtId()]);
    }
} 