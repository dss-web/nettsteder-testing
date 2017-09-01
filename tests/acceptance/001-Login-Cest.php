<?php


class Login_Cest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    public function loginToWP(AcceptanceTester $I)
    {
    	// login as administrator
        $I->amOnPage('wp-login.php');
        $I->fillField('#user_login', 'admin');
        $I->fillField('#user_pass', 'Passord1234');
        $I->click('Log In');

    	$I->seeCurrentUrlEquals('/wp-admin/');
	$I->seeInTitle('Dashboard');
    }
}
