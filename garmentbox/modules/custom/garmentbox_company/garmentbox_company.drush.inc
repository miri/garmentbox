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
 * Command callback. Generate a number of users.
 */
function drush_garmentbox_company_gb_user_create($company) {
  // Search the company node ID.
  $query = new EntityFieldQuery();
  $result = $query->entityCondition('entity_type', 'node')
    ->propertyCondition('type', 'company')
    ->propertyCondition('status', NODE_PUBLISHED)
    ->propertyCondition('title', check_plain($company))
    ->execute();

  if (empty($result['node'])) {
    return drush_set_error('GARMENTBOX_COMPANY_INVALID_COMPANY', t('Company "@company" not found.', array('@company' => $company)));
  }

  // Use a random string as the username.
  $name = user_password();

  $options = array(
    'uid' => NULL,
    'name' => $name,
    'pass' => NULL,
    'mail' => $name . '@example.com',
    'status' => 1,
    'created' => REQUEST_TIME,
    'roles' => array(DRUPAL_AUTHENTICATED_RID),
    'language' => LANGUAGE_NONE,
  );
  $account = user_save(drupal_anonymous_user(), $options);

  // if (drush_generate_is_number($num_users) == FALSE) {

  // }
  // drush_generate_include_devel();
  // $roles = drush_get_option('roles') ? explode(',', drush_get_option('roles')) : array();
  // devel_create_users($num_users, drush_get_option('kill'), 0, $roles);
  drush_log(t('Generated a user under company "@company"', array('@company' => $company)), 'success');
}
