<?php

/**
 * @file
 * Contains \GbItemsMigrate.
 */

class GbItemsMigrate extends GbMigration {


  public $entityType = 'node';
  public $bundle = 'item';

  public $csvColumns = array(
    array('body', 'Body'),
    array('field_season', 'Season'),
    array('field_item_status', 'Status'),
    array('field_image', 'Image'),
  );

  public $dependencies = array(
    'garmentboxItemStatusTerms',
    'garmentboxSeasons',
  );

  public function __construct() {
    parent::__construct();
    $this->addFieldMapping('body', 'body');

    $this
      ->addFieldMapping('field_season', 'field_season')
      ->sourceMigration('garmentboxSeasons');

    $this
      ->addFieldMapping('field_item_status', 'field_item_status')
      ->sourceMigration('garmentboxItemStatusTerms');

    $this->addFieldMapping('field_image', 'field_image');
    $this
      ->addFieldMapping('field_image:file_replace')
      ->defaultValue(FILE_EXISTS_REPLACE);
    $this
      ->addFieldMapping('field_image:source_dir')
      ->defaultValue(drupal_get_path('module', 'gb_migrate') . '/images');
  }

}
