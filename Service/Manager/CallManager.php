<?php

namespace Perfico\SipuniBundle\Service\Manager;

use Doctrine\ORM\EntityManager;
use Perfico\CoreBundle\Entity\Activity;
use Perfico\CoreBundle\Entity\SipuniCall;
use Perfico\CRMBundle\Entity\AccountInterface;
use Perfico\CRMBundle\Entity\ActivityInterface;

class CallManager
{
    /** @var EntityManager */
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param string $callId
     * @param AccountInterface $account
     * @return SipuniCall
     */
    public function retrieveCall($callId, AccountInterface $account)
    {
        $call = $this->em->getRepository('CoreBundle:SipuniCall')
            ->findOneBy(array('callExtId' => $callId, 'account' => $account));

        if ($call == null) {
            $call = new SipuniCall();
            $this->em->persist($call);

            $activity = new Activity();
            $this->em->persist($activity);

            $call->setCallExtId($callId)
                ->setActivity($activity)
                ->setAccount($account);

            $activity->setType(ActivityInterface::TYPE_CALL)
                ->setAccount($account);
        }

        return $call;
    }
} 