<?php

namespace Perfico\SipuniBundle\Service\Factory;

use Perfico\SipuniBundle\Entity\AnswerEvent;

class AnswerEventFactory extends CallEventFactory
{
    /**
     * {@inheritdoc}
     */
    public function create()
    {
        return new AnswerEvent();
    }
} 