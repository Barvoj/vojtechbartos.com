<?php

use Page\SignIn;

class WelcomeCest
{
    function showHomepage(AcceptanceTester $I, SignIn $signInModal)
    {
        $I->wantTo('sign in');
        $signInModal->signIn('admin', 'hcAdmin');
        $I->see('Vojtěch Bartoš');
    }


    function showMyArticles(AcceptanceTester $I, SignIn $signInModal)
    {
        $I->wantTo('List my articles');
        $signInModal->signIn('admin', 'hcAdmin');
        $I->see('Vojtěch Barrtoš');
    }
}
