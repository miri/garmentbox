<?php

/**
 * @file
 * Contains \GbMaterialsMigrate.
 */

class GbMaterialsMigrate extends GbMigration {

  public $entityType = 'node';
  public $bundle = 'material';

  public $csvColumns = array(
    array('field_material_images', 'Images'),
    array(OG_AUDIENCE_FIELD, 'Company'),
    array('field_vendor', 'Vendor'),
  );

  public $dependencies = array(
    'GbCompaniesMigrate',
    'GbVendorsMigrate',
  );

  public function __construct() {
    parent::__construct();

    $this->addFieldMapping('field_material_images', 'field_material_images');

    $this
      ->addFieldMapping('field_material_images:file_replace')
      ->defaultValue(FILE_EXISTS_REPLACE);
    $this
      ->addFieldMapping('field_material_images:source_dir')
      ->defaultValue(drupal_get_path('module', 'gb_migrate') . '/images');

    $this
      ->addFieldMapping(OG_AUDIENCE_FIELD, OG_AUDIENCE_FIELD)
      ->sourceMigration('GbCompaniesMigrate');

    $this
        ->addFieldMapping('field_vendor', 'field_vendor')
        ->sourceMigration('GbVendorsMigrate');
  }
}
