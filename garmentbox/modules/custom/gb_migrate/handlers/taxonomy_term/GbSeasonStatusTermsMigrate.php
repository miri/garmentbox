<?php

/**
 * @file
 * Contains \GbSeasonStatusTermsMigrate.
 */

class GbSeasonStatusTermsMigrate extends GbMigration {

  public $entityType = 'taxonomy_term';
  public $bundle = 'measurement_units';

  public $csvColumns = array(
    array('field_unit_type', 'Type'),
    array('field_conversion_ratio', 'Conversion'),
  );

  public function __construct() {
    parent::__construct();
    $this->addFieldMapping('field_unit_type', 'field_unit_type');
    $this->addFieldMapping('field_conversion_ratio', 'field_conversion_ratio');
  }
}
