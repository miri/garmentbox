<?php
/**
 * @file
 * opengizra_order.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function opengizra_order_ctools_plugin_api() {
  list($module, $api) = func_get_args();
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_node_info().
 */
function opengizra_order_node_info() {
  $items = array(
    'order' => array(
      'name' => t('Order'),
      'base' => 'node_content',
      'description' => '',
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  return $items;
}