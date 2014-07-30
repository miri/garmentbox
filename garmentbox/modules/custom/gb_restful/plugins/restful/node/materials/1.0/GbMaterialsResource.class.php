<?php

/**
 * @file
 * Contains GbMaterialsResource.
 */

class GbMaterialsResource extends \RestfulEntityBaseNode {


  /**
   * {@inheritdoc}
   */
  public function getPublicFields() {
    $public_fields = parent::getPublicFields();

    unset($public_fields['self']);

    $public_fields['created'] = array(
      'property' => 'created',
    );

    $public_fields['updated'] = array(
      'property' => 'changed',
    );

    $public_fields['image'] = array(
      'property' => 'field_material_image',
      'process_callback' => 'gb_restful_get_image_styles',
    );

    $public_fields['price'] = array(
      'property' => 'field_price',
    );

    return $public_fields;
  }
}
