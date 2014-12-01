<?php

/**
 * @file
 * Contains \GbItemsMigrate.
 */

class GbVendorsMigrate extends GbMigration {

  public $entityType = 'node';
  public $bundle = 'vendor';

  public $csvColumns = array(
    array('title', 'Title'),
  );

  public function __construct() {
    parent::__construct();

    $this->addFieldMapping('title', 'title');

    $this
      ->addFieldMapping('field_vendor', 'field_vendor')
      ->sourceMigration('GbVendorsMigrate');
  }

}
