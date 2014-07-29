<?php

/**
 * @file
 * Contains GbItemVariantssResource.
 */

class GbItemVariantssResource extends \RestfulEntityBaseNode {


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
      'property' => 'updated',
    );

    $public_fields['images'] = array(
      'property' => 'field_item_variant_images',
    );

    return $public_fields;
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
    $request = array('sort' => '-updated');

    return $handler->get($item_id, $request);


  }
}
