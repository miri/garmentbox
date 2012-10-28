<?php

namespace Drupal\DrupalExtension\Context;

use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Exception\PendingException;
use Behat\Mink\Exception\UnsupportedDriverActionException;

use Drupal\Drupal;

use Symfony\Component\Process\Process;

use Behat\Behat\Context\Step\Given;
use Behat\Behat\Context\Step\When;
use Behat\Behat\Context\Step\Then;

use Behat\Mink\Driver\Selenium2Driver as Selenium2Driver;

use Drupal\DrupalExtension\Context;

class FeatureContext extends DrupalContext {
  /**
   * @Then /^I should be logged out$/
   */
  public function iShouldBeLoggedOut() {
    return !$this->loggedIn();
  }

  /**
   * @Given /^I am on a "([^"]*)" page with id "([^"]*)"$/
   */
  public function iAmOnAPageWithId($arg1, $arg2) {
    $path = 'node/' . $arg2;
    echo $path;
    // Use Drupal Context 'I am at'.
    return new Given("I am at \"$path\"");
  }

  /**
   * @Then /^I should see the node heading "([^"]*)"$/
   */
  public function iShouldSeeTheNodeHeading($arg1) {
    return new Given("I should see text matching \"$arg1\"");
  }
}
