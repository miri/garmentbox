<?php

/**
 * @file
 * Contains GbItemsResource.
 */

class GbItemsResource extends \RestfulEntityBaseNode {


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

    $public_fields['recents_variants'] = array(
      'callback' => array($this, 'getRecentVariants'),
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
    if (!empty($request['company'])) {
      $query->fieldCondition(OG_AUDIENCE_FIELD, 'target_id', intval($request['company']));
    }

    return $query;
  }

  /**
   * Returns 5 last updated item variants.
   *
   * @param \EntityMetadataWrapper $wrapper
   *   The wrapped entity.
   *
   * @return array
   *   Array with the 5 recent item variants.
   */
  protected function getRecentVariants(\EntityMetadataWrapper $wrapper) {
    $version = $this->getVersion();
    $handler = restful_get_restful_handler('item_variants', $version['major'], $version['minor']);

    $item_id = $wrapper->getIdentifier();
    $request = array('sort' => '-updated', 'item' => $item_id);

    return $handler->get('', $request);
  }
}
