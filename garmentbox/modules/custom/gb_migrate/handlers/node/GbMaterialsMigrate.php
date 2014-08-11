<?php

/**
 * @file
 * Contains \GbMaterialsMigrate.
 */

class GbMaterialsMigrate extends GbMigration {

  public $entityType = 'node';
  public $bundle = 'material';

  public $csvColumns = array(
    array('body', 'Body'),
    array('field_images', 'Images'),
    array('field_material_type', 'Material type'),
  );

  public $dependencies = array(
    'GbMaterialTypeTermsMigrate',
  );

  public function __construct() {
    parent::__construct();

    $this->addFieldMapping('body', 'body');
    $this->addFieldMapping('field_images', 'field_images');

    $this
      ->addFieldMapping('field_images:file_replace')
      ->defaultValue(FILE_EXISTS_REPLACE);
    $this
      ->addFieldMapping('field_images:source_dir')
      ->defaultValue(drupal_get_path('module', 'gb_migrate') . '/images');
    $this
      ->addFieldMapping('field_material_type', 'field_material_type')
      ->sourceMigration('GbMaterialTypeTermsMigrate');
  }
}
