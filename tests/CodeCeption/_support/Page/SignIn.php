<?php
namespace Page;

use AcceptanceTester;

class SignIn
{
    // include url of current page
    public static $URL = '/';

    public static $signInModal = '#frm-signForm-component-form';
    public static $flashMessage = '.flash';
    public static $usernameField = 'username';
    public static $passwordField = 'password';
    public static $signInButton = 'signin';

    /** @var AcceptanceTester */
    protected $tester;

    public function __construct(AcceptanceTester $I)
    {
        $this->tester = $I;
    }

    public function signIn($name, $password)
    {
        $I = $this->tester;

        // if snapshot exists - skipping login
        if ($I->loadSessionSnapshot('login')) {
            return $this;
        }

        $I->amOnPage('/');
        $I->click("Přihlásit");
        $I->waitForElement(static::$signInModal, 30);
        $I->fillField(static::$usernameField, $name);
        $I->fillField(static::$passwordField, $password);
        $I->click(static::$signInButton);
        $I->waitForElement(static::$flashMessage, 30);
        $I->see('Byli jste úspěšně přihlášeni.');

        // saving snapshot
        $I->saveSessionSnapshot('login');

        return $this;
    }
}
