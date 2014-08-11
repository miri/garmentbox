<?php

/**
 * @file
 * Contains \GbSeasonsMigrate.
 */

class GbSeasonsMigrate extends GbMigration {

  public $entityType = 'node';
  public $bundle = 'season';

  public $csvColumns = array(
    array('body', 'Body'),
    array('field_season_status', 'Status'),
  );

  public $dependencies = array(
    'garmentboxSeasonStatusTerms',
  );

  public function __construct() {
    parent::__construct();
    $this->addFieldMapping('body', 'body');

    $this
      ->addFieldMapping('field_season_status', 'field_season_status')
      ->sourceMigration('garmentboxSeasonStatusTerms');
  }
}
