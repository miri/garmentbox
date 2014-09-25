<?php

/**
 * @file
 * Contains GbItemsResource.
 */

class GbItemsResource extends \GbEntityBaseNode {


  /**
   * Overrides \RestfulEntityBaseNode::publicFieldsInfo().
   */
  public function publicFieldsInfo() {
    $public_fields = parent::publicFieldsInfo();

    $public_fields['company'] = array(
      'property' => OG_AUDIENCE_FIELD,
      'resource' => array(
        'company' => array(
          'resource_name' => 'companies',
          'full_view' => FALSE,
        )
      ),
    );

    $public_fields['item_variants'] = array(
      'callback' => array($this, 'getItemVariantsFromItem'),
    );

    return $public_fields;
  }

  protected function getItemVariantsFromItem(\EntityMetadataWrapper $wrapper) {
    // Get a list of referencing item variants.
    $handler = restful_get_restful_handler('item_variants');
    $request = array(
      'filter' => array(
        'item' => $wrapper->getIdentifier(),
      ),
    );
    return $handler->get('', $request);
  }
}
