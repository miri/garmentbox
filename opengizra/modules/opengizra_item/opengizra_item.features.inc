<?php
/**
 * @file
 * opengizra_item.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function opengizra_item_ctools_plugin_api() {
  list($module, $api) = func_get_args();
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_views_api().
 */
function opengizra_item_views_api() {
  return array("version" => "3.0");
}

/**
 * Implements hook_node_info().
 */
function opengizra_item_node_info() {
  $items = array(
    'item' => array(
      'name' => t('Item'),
      'base' => 'node_content',
      'description' => '',
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
    'item_instance' => array(
      'name' => t('Item instance'),
      'base' => 'node_content',
      'description' => '',
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  return $items;
}