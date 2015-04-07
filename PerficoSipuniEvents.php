<?php

namespace Perfico\SipuniBundle;

class PerficoSipuniEvents
{
    const FIRST_CALL = 'perfico_sipuni.event.first_call';
    const CALL = 'perfico_sipuni.event.call';
    const ANSWER = 'perfico_sipuni.event.answer';
    const HANGUP = 'perfico_sipuni.event.hangup';
    const UNDEFINED = 'perfico_sipuni.event.undefined';
    const ERROR_CHAIN = 'perfico_sipuni.event.error_chain';
} 