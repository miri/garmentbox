<?php

/**
 * @file
 * Contains GbItemVariantsResource.
 */

class GbItemVariantsResource extends \RestfulEntityBaseNode {


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

    $public_fields['images'] = array(
      'property' => 'field_item_variant_images',
      'process_callback' => 'gb_restful_get_images_styles',
    );

    $public_fields['materials'] = array(
      'property' => 'field_materials',
      'resource' => array(
        'material' => 'materials',
      ),
    );

    return $public_fields;
  }


  /**
   * Overrides \RestfulEntityBaseNode::getQueryForList();
   */
  public function getQueryForList() {
    $query =  parent::getQueryForList();

    $request = $this->getRequest();
    if (!empty($request['item'])) {
      $query->fieldCondition('field_item', 'target_id', intval($request['item']));
    }

    return $query;
  }
}
