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
        throw new \Exception("The link '$link' was not found");
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
      // If not found, search for a table with $title as its caption. Select
      // the parent of the table element.
      $element = $page->find('xpath', '//caption[.="' . $title .'"]/../..');
    }
    if (!$element) {
      throw new \Exception("No table titled '$title' was found.");
    }

    $element = $element->find('css', 'table');
    if (!$element) {
      throw new \Exception("No table was found inside the pane titled '$title'.");
    }
    $rows = $table->getRows();
    $head_row = array_shift($rows);
    // Compare the table header.
    $this->compareTableRow($element->findAll('css', 'thead th'), $head_row);

    // Compare the rows.
    foreach ($element->findAll('css', 'tbody tr') as $i => $row) {
      if (empty($rows[$i])) {
        break;
      }
      $this->compareTableRow($row->findAll('css', 'td'), $rows[$i]);
    }
  }

  /**
   * @Given /^the BOM total should be "([^"]*)"$/
   */
  public function theBomTotalShouldBe($total) {
    if ($this->getSession()->getPage()->find('css', '.bom-total .amount')->getText() != $total) {
      throw new \Exception("The BOM has a different total price than '$total'.");
    }
  }

  /**
   * @Given /^the "([^"]*)" price should be "([^"]*)"$/
   */
  public function thePriceShouldBe($price_type, $price) {
    switch ($price_type) {
      case 'production':
        $selector = '.pane-production-price';
        break;

      case 'wholesale':
      case 'retail':
        $selector = ".field-name-field-{$price_type}-price";
        break;
    }
    if ($this->getSession()->getPage()->find('css', "$selector .field-item")->getText() != $price) {
      throw new \Exception("The production price is not '$price'.");
    }
  }


  /**
   * @Given /^the page status is shown as "([^"]*)"$/
   */
  public function thePageStatusIsShownAs($status) {
    if (!$this->getSession()->getPage()->find('xpath', '//div[contains(@class, "field-item") and .="' . $status . '"]')) {
      throw new Exception("Missing indication for status '$status'.");
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
      if (!array_key_exists($i, $expected_row)) {
        throw new \Exception("Unexpected cell with text '{$cell->getText()}'.");
      }

      switch ($expected_row[$i]) {
        case '<ignore>':
          continue 2;

        case '<image>':
          // Make sure the cell contains an image tag.
          if (!$cell->find('css', 'img')) {
            throw new \Exception('Missing image');
          }
          break;

        default:
          if ($cell->getText() != $expected_row[$i]) {
            throw new \Exception("Found '{$cell->getText()}' instead of '{$expected_row[$i]}'.");
          }
      }
    }

    if (count($expected_row) > $i + 1) {
      throw new \Exception('Missing column.');
    }
  }
}
