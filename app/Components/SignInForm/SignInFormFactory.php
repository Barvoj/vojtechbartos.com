<?php

namespace VojtechBartos\Components\Forms\SignInForm;

interface SignInFormFactory
{
    /**
     * @return SignInForm
     */
    public function create() : SignInForm;
}