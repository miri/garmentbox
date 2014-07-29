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

    unset($public_fields['self']);

    $public_fields['logo'] = array(
      'property' => 'field_company_logo',
      'process_callback' => 'gb_restful_get_image_styles',
    );

    return $public_fields;
  }
}
