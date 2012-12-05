<?php

/**
 * Implements of hook_drush_command().
 */
function garmentbox_company_drush_command() {
  $items['gb-user-create'] = array(
    'description' => 'Create user.',
    'arguments' => array(
      'company' => 'Company to attach the user to.',
    ),
  );

  return $items;
}


/**
 * Command callback. Generate a user and for a specific company.
 */
function drush_garmentbox_company_gb_user_create($company) {
  // Search the company node ID.
  $query = new EntityFieldQuery();
  $result = $query->entityCondition('entity_type', 'node')
    ->propertyCondition('type', 'company')
    ->propertyCondition('status', NODE_PUBLISHED)
    ->propertyCondition('title', check_plain($company))
    ->range(0, 1)
    ->execute();

  if (empty($result['node'])) {
    return drush_set_error('GARMENTBOX_COMPANY_INVALID_COMPANY', t('Company "@company" not found.', array('@company' => $company)));
  }
  $company_nid = key($result['node']);

  // Use a random string as the username.
  $name = user_password();
  $account = (object) array(
    'uid' => NULL,
    'name' => $name,
    'pass' => NULL,
    'mail' => $name . '@example.com',
    'status' => 1,
    'created' => REQUEST_TIME,
    'roles' => array(DRUPAL_AUTHENTICATED_RID),
    'language' => LANGUAGE_NONE,
  );

  $wrapper = entity_metadata_wrapper('user', $account);
  $wrapper->og_user_company->set(array($company_nid));
  $wrapper->save();

  drush_log(t('Generated a user under company "@company"', array('@company' => $company)), 'success');
  drush_print_r(t('User ID: @id', array('@id' => $account->uid)));
}
