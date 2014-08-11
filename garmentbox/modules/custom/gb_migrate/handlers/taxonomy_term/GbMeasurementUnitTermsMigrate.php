<?php

/**
 * @file
 * Contains \GbMaterialTypeTermsMigrate.
 */

class GbMaterialTypeTermsMigrate extends GbMigration {

  public $entityType = 'taxonomy_term';
  public $bundle = 'material_types';

  public $csvColumns = array(
    array('name', 'Name'),
    array('field_measurement_types', 'Measurement types'),
  );

  public function __construct() {
    parent::__construct();
    $this
      ->addFieldMapping('field_measurement_types', 'field_measurement_types')
      ->separator('|');
  }
}
