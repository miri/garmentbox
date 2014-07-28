<?php

/**
 * @file
 * Contains GbCompaniesResource.
 */

class GbCompaniesResource extends \RestfulEntityBaseNode {


  /**
   * {@inheritdoc}
   */
  public function getPublicFields() {
    $public_fields = parent::getPublicFields();

    $public_fields['logo'] = array(
      'property' => 'field_company_logo',
      'process' => 'logoProcess',
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
    return $value['uri'];
  }
}
