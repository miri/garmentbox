<?php

/**
 * @file
 * Template overrides as well as (pre-)process and alter hooks for the
 * Default Omega Starterkit theme.
 */

/**
 * Page preprocess.
 */
function garmentbox_omega_preprocess_page(&$variables) {
  $node = menu_get_object();
  // When the node wasn't loaded, try fetching it from the menu item.
  if (!$node) {
    $item = menu_get_item();
    if (substr($item['path'], 0, 8) == 'season/%') {
      // When on a panels page, ['map'][1] has the node itself.
      if (!empty($item['map'][1]->data)) {
        $node = $item['map'][1]->data;
      }
      else {
        $nid = NULL;
        // When on a views page, ['map'][1] has the node ID.
        if (!empty($item['map']) && is_numeric($item['map'][1])) {
          $node = node_load($item['map'][1]);
        }
        // When on a menu page callback. ['original_map'][1] has the node ID.
        elseif (is_numeric($item['original_map'][1])) {
          $node = node_load($item['original_map'][1]);
        }
      }
    }
  }

  if ($node) {
    $variables['page']['title'] = node_view($node, 'garmentbox_header');
    $variables['page']['breadcrumbs'] = garmentbox_general_get_node_breadcrumbs($node);
    $variables['page']['tabs'] = garmentbox_general_get_node_tabs($node);
    $variables['page']['main_button'] = garmentbox_general_get_node_main_button($node);
  }
}

/**
 * Node preprocess.
 */
function garmentbox_omega_preprocess_node(&$variables) {
  if ($variables['view_mode'] == 'garmentbox_header') {
    $variables['display_submitted'] = FALSE;
  }
}
