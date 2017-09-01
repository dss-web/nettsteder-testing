<?php


class WPFirstCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTestMe(AcceptanceTester $I)
    {
	/*$I->loginAsAdmin();
	$I->amOnPluginsPage();
    	$I->activatePlugin('dss-wp-events');*/
	
	// login as administrator
	$I->amOnPage('wp-login.php');
	//$I->fillField('#user_login', 'theAdmin');
	//$I->fillField('#user_pass', 'thePassword');
	$I->fillField('#user_login', 'admin');
	$I->fillField('#user_pass', 'Passord1234');
	$I->click('Log In');

	$I->see('At a Glance');

	//$sitedomain = $I->getSiteDomain();
	//echo $sitedomain . "\n";

	//$I->see('DSS Events');

	// go to the plugins page
	$I->amOnPage('/wp-admin/plugins.php'); 

	$I->see('DSS Events');

	//$I->fail( 'whatever' );

	//$I->activatePlugin('dss-wp-events');

	$slug = $plugin_slug = 'dss-events';

	$I->activatePlugin($slug);
	$I->seePluginActivated($slug);
	//$I->deactivatePlugin('dss-events');
	//$I->seePluginDeactivated('dss-events');

	//if ( ! $I->can( 'seePluginActivated', $slug ) && ! $I->can( 'seePluginActivated', $plugin_slug ) ) {
 	//   $I->fail( 'Could not activate ' . $slug );
	//}
    }

    public function tryToTestYou(AcceptanceTester $I)
    {
        $I->loginAs('foo', 'bar');
        $I->amOnPluginsPage();
	//$I->activatePlugin('dss-wp-events');
	//$I->activatePlugin('acme-plugin');
    }
}

//$I = new AcceptanceTester( $scenario );
//$I->loginAs('foo', 'bar');

//$I->loginAsAdmin();
//$I->amOnPluginsPage();

