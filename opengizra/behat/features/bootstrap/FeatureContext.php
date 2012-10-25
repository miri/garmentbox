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

}
