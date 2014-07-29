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
      'process_callback' => 'gb_restful_get_image_styles',
    );

    return $public_fields;
  }


  public function getQueryForList() {
    $query =  parent::getQueryForList();

    $request = $this->getRequest();
    if (!empty($request['item'])) {
      $query->fieldCondition('field_item', 'target_id', intval($request['item']));
    }

    return $query;
  }

  /**
   * Return image URLs based on image styles.
   *
   * @param $value
   *   The image array.
   *
   * @return array
   *   Array keyed by the image style and the url as the value.
   */
  protected function logoProcess($value) {
    $uri = $value['uri'];
    $return = array(
      'original' => file_create_url($uri),
    );

    $image_styles = array(
      'thumbnail',
      'medium',
      'large',
    );

    foreach ($image_styles as $image_style) {
      $return[$image_style] = image_style_url($image_style, $uri);
    }
    return $return;
  }
}
