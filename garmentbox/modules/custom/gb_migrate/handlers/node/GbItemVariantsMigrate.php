<?php

/**
 * @file
 * Contains \GbItemVariantsMigrate.
 */

class GbItemVariantsMigrate extends GbMigration {

  public $entityType = 'node';
  public $bundle = 'item_variant';

  public $csvColumns = array(
    array('field_item', 'Item'),
    array('field_images', 'Images'),
    array('field_item_status', 'Status'),
    array('field_retail_price', 'Retail price'),
    array('field_wholesale_price', 'Wholesale price'),
  );

  public $dependencies = array(
    'garmentboxItems',
    'garmentboxItemStatusTerms',
  );

  public function __construct() {
    parent::__construct();
    $this->addFieldMapping('body', 'body');

    $this
      ->addFieldMapping('field_item', 'field_item')
      ->sourceMigration('garmentboxItems');


    $this->addFieldMapping('field_images', 'field_images');
    $this
      ->addFieldMapping('field_images:file_replace')
      ->defaultValue(FILE_EXISTS_REPLACE);
    $this
      ->addFieldMapping('field_images:source_dir')
      ->defaultValue(drupal_get_path('module', 'gb_migrate') . '/images');

    $this
      ->addFieldMapping('field_item_status', 'field_item_status')
      ->sourceMigration('garmentboxItemStatusTerms');

    $this->addFieldMapping('field_retail_price', 'field_retail_price');

    $this->addFieldMapping('field_wholesale_price', 'field_wholesale_price');

  }

  function prepareRow($row) {
    parent::prepareRow($row);
    $row->field_images = explode('; ', $row->field_images);
  }

  public function complete($entity, $row) {
    // Flag certain item variants as line-sheet items.
    $item_variant_titles = array(
      'Lines v-neck shirt',
      'Black v-neck shirt',
    );

    if (in_array($entity->title, $item_variant_titles)) {
      flag('flag', 'line_sheet', $entity->nid, user_load(1));
    }
  }
}
