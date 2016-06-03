<?php

namespace Auth\Components\Forms\SignInForm;

interface SignInFormFactory
{
    /**
     * @return SignInForm
     */
    public function create() : SignInForm;
}