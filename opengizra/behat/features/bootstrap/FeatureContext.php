<?php

use Drupal\DrupalExtension\Context\DrupalContext;
use Behat\Behat\Context\Step\Given;

require 'vendor/autoload.php';

class FeatureContext extends DrupalContext {

  /**
   * @Given /^I am on a "([^"]*)" page with id "([^"]*)"$/
   */
  public function iAmOnAPageWithId($arg1, $arg2) {
    $path = 'node/' . $arg2;
    echo $path;
    // Use Drupal Context 'I am at'.
    return new Given("I am at \"$path\"");
  }
}
