<?php

use Drupal\DrupalExtension\Context\DrupalContext;
use Behat\Behat\Context\Step\Given;
use Behat\Gherkin\Node\TableNode;

require 'vendor/autoload.php';

class FeatureContext extends DrupalContext {

  /**
   * @Given /^I am on a "([^"]*)" page with id "([^"]*)"$/
   */
  public function iAmOnAPageWithId($arg1, $arg2) {
    $path = 'node/' . $arg2;

    // Use Drupal Context 'I am at'.
    return new Given("I am at \"$path\"");
  }

  /**
   * @Given /^I should see the following <links>$/
   */
  public function iShouldSeeTheFollowingLinks(TableNode $table) {
    $page = $this->getSession()->getPage();
    $table = $table->getHash();

    foreach ($table as $key => $value) {
      $link = $table[$key]['links'];
      $result = $page->findLink($link);
      if(empty($result)) {
        throw new Exception("The link '" . $link . "' was not found");
      }
    }
  }

  /**
   * @Then /^I should see a table titled "([^"]*)" with the following <contents>:$/
   */
  public function iShouldSeeATableTitledWithTheFollowingContents($title, TableNode $table) {
    $page = $this->getSession()->getPage();
    // Find the container of the table with the correct pane title
    $element = $page->find('xpath', '//h2[.="' . $title .'"]/parent::div');
    if (!$element) {
      throw new Exception("No pane titled '$title' was found.");
    }
    $element = $element->find('css', 'table');
    if (!$element) {
      throw new Exception("No table was found inside the pane titled '$title'.");
    }

    // Compare the table header.
    $this->compareTableRow($element->findAll('css', 'thead th'), $table->getRow(0));

    // Compare the rows.
    foreach ($element->findAll('css', 'tbody tr') as $i => $row) {
       $this->compareTableRow($row->findAll('css', 'td'), $table->getRow($i + 1));
    }
  }

  /**
   * @Given /^the BOM total should be "([^"]*)"$/
   */
  public function theBomTotalShouldBe($total) {
    $element = $this->getSession()->getPage();
    if ($element->find('css', '.bom-total .amount')->getText() != $total) {
      throw new Exception("The BOM has a different total price than '$total'");
    }
  }

  /**
   * Compare a present table row cells with the expected row.
   *
   * @param $cells
   *   Array of table row cells retrieved with findAll().
   * @param $expected_row
   *   One row from the TableNode object.
   */
  private function compareTableRow($cells, $expected_row) {
    foreach ($cells as $i => $cell) {
      if (empty($expected_row[$i])) {
        throw new Exception("Unexpected cell with text '{$th->getText()}'.");
        continue;
      }

      if ($cell->getText() != $expected_row[$i]) {
        throw new Exception("Found '{$cell->getText()}' instead of '{$expected_row[$i]}'.");
      }
    }

    if (count($expected_row) > $i) {
      throw new Exception('Missing column.');
    }

  }
}
