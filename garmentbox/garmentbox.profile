<?php
/**
 * @file
 * Garmentbox profile.
 */

/**
 * Implements hook_form_FORM_ID_alter().
 *
 * Allows the profile to alter the site configuration form.
 */
function garmentbox_form_install_configure_form_alter(&$form, $form_state) {
  // Pre-populate the site name with the server name.
  $form['site_information']['site_name']['#default_value'] = $_SERVER['SERVER_NAME'];
}

/**
 * Implements hook_install_tasks().
 */
function garmentbox_install_tasks() {
  $tasks = array();

  $tasks['garmentbox_set_variables'] = array(
    'display_name' => st('Set Variables'),
    'display' => FALSE,
  );

  $tasks['garmentbox_set_og_permissions'] = array(
    'display_name' => st('Setup Blocks'),
    'display' => FALSE,
  );
  return $tasks;
}

/**
 * Task callback; Set variables.
 */
function garmentbox_set_variables() {
  $variables = array(
    // Features default export path.
    'features_default_export_path' => 'profiles/garmentbox/modules/custom',
    // Mime-mail.
    'mimemail_format' => 'full_html',
    'mimemail_sitestyle' => FALSE,
    'mimemail_name' => 'GarmentBox',
    'mimemail_mail' => 'info@garmentbox.com',
    // jQuery versions.
    'jquery_update_jquery_version' => '1.10',
    'jquery_update_jquery_admin_version' => '1.5',
    // Enable restful files upload.
    'restful_file_upload' => 1,
    // Private files directory.
    'file_private_path' => 'sites/default/files/private',
    'file_default_scheme' => 'private',
  );

  foreach ($variables as $key => $value) {
    variable_set($key, $value);
  }
}

/**
 * Task callback; Setup OG permissions.
 *
 * We do this here, late enough to make sure all group-content were
 * created.
 */
function garmentbox_set_og_permissions() {
  // @todo: Re-enble.
  return;

  $og_roles = og_roles('node', 'company');
  $rid = array_search(OG_AUTHENTICATED_ROLE, $og_roles);

  $permissions = array();
  $types = array(
    'item',
    'item_variant',
    'material',
    'season',
  );
  foreach ($types as $type) {
    $permissions["create $type content"] = TRUE;
    $permissions["update own $type content"] = TRUE;
    $permissions["update any $type content"] = TRUE;
  }
  og_role_change_permissions($rid, $permissions);
}
