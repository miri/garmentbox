<?php
/**
 * @file
 * opengizra_order.views_default.inc
 */

/**
 * Implements hook_views_default_views().
 */
function opengizra_order_views_default_views() {
  $export = array();

  $view = new view;
  $view->name = 'orders';
  $view->description = '';
  $view->tag = 'default';
  $view->base_table = 'node';
  $view->human_name = 'Orders';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['access']['type'] = 'perm';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['query']['options']['query_comment'] = FALSE;
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['pager']['type'] = 'full';
  $handler->display->display_options['style_plugin'] = 'table';
  $handler->display->display_options['style_options']['columns'] = array(
    'title' => 'title',
  );
  $handler->display->display_options['style_options']['default'] = '-1';
  $handler->display->display_options['style_options']['info'] = array(
    'title' => array(
      'sortable' => 0,
      'default_sort_order' => 'asc',
      'align' => '',
      'separator' => '',
      'empty_column' => 0,
    ),
  );
  $handler->display->display_options['style_options']['override'] = 1;
  $handler->display->display_options['style_options']['sticky'] = 0;
  $handler->display->display_options['style_options']['empty_table'] = 0;
  /* Relationship: Entity Reference: Referenced Entity */
  $handler->display->display_options['relationships']['field_inventory_line_inline_target_id']['id'] = 'field_inventory_line_inline_target_id';
  $handler->display->display_options['relationships']['field_inventory_line_inline_target_id']['table'] = 'field_data_field_inventory_line_inline';
  $handler->display->display_options['relationships']['field_inventory_line_inline_target_id']['field'] = 'field_inventory_line_inline_target_id';
  $handler->display->display_options['relationships']['field_inventory_line_inline_target_id']['required'] = 1;
  /* Relationship: Entity Reference: Referenced Entity */
  $handler->display->display_options['relationships']['field_item_variant_target_id']['id'] = 'field_item_variant_target_id';
  $handler->display->display_options['relationships']['field_item_variant_target_id']['table'] = 'field_data_field_item_variant';
  $handler->display->display_options['relationships']['field_item_variant_target_id']['field'] = 'field_item_variant_target_id';
  $handler->display->display_options['relationships']['field_item_variant_target_id']['relationship'] = 'field_inventory_line_inline_target_id';
  $handler->display->display_options['relationships']['field_item_variant_target_id']['required'] = 1;
  /* Relationship: Entity Reference: Referenced Entity */
  $handler->display->display_options['relationships']['field_item_target_id']['id'] = 'field_item_target_id';
  $handler->display->display_options['relationships']['field_item_target_id']['table'] = 'field_data_field_item';
  $handler->display->display_options['relationships']['field_item_target_id']['field'] = 'field_item_target_id';
  $handler->display->display_options['relationships']['field_item_target_id']['relationship'] = 'field_item_variant_target_id';
  $handler->display->display_options['relationships']['field_item_target_id']['required'] = 1;
  /* Field: Content: Customer */
  $handler->display->display_options['fields']['field_customer']['id'] = 'field_customer';
  $handler->display->display_options['fields']['field_customer']['table'] = 'field_data_field_customer';
  $handler->display->display_options['fields']['field_customer']['field'] = 'field_customer';
  $handler->display->display_options['fields']['field_customer']['alter']['alter_text'] = 0;
  $handler->display->display_options['fields']['field_customer']['alter']['make_link'] = 0;
  $handler->display->display_options['fields']['field_customer']['alter']['absolute'] = 0;
  $handler->display->display_options['fields']['field_customer']['alter']['external'] = 0;
  $handler->display->display_options['fields']['field_customer']['alter']['replace_spaces'] = 0;
  $handler->display->display_options['fields']['field_customer']['alter']['trim_whitespace'] = 0;
  $handler->display->display_options['fields']['field_customer']['alter']['nl2br'] = 0;
  $handler->display->display_options['fields']['field_customer']['alter']['word_boundary'] = 1;
  $handler->display->display_options['fields']['field_customer']['alter']['ellipsis'] = 1;
  $handler->display->display_options['fields']['field_customer']['alter']['more_link'] = 0;
  $handler->display->display_options['fields']['field_customer']['alter']['strip_tags'] = 0;
  $handler->display->display_options['fields']['field_customer']['alter']['trim'] = 0;
  $handler->display->display_options['fields']['field_customer']['alter']['html'] = 0;
  $handler->display->display_options['fields']['field_customer']['element_label_colon'] = 1;
  $handler->display->display_options['fields']['field_customer']['element_default_classes'] = 1;
  $handler->display->display_options['fields']['field_customer']['hide_empty'] = 0;
  $handler->display->display_options['fields']['field_customer']['empty_zero'] = 0;
  $handler->display->display_options['fields']['field_customer']['hide_alter_empty'] = 1;
  $handler->display->display_options['fields']['field_customer']['settings'] = array(
    'link' => 0,
  );
  $handler->display->display_options['fields']['field_customer']['field_api_classes'] = 0;
  /* Sort criterion: Content: Post date */
  $handler->display->display_options['sorts']['created']['id'] = 'created';
  $handler->display->display_options['sorts']['created']['table'] = 'node';
  $handler->display->display_options['sorts']['created']['field'] = 'created';
  $handler->display->display_options['sorts']['created']['order'] = 'DESC';
  /* Contextual filter: Content: Season (field_season) */
  $handler->display->display_options['arguments']['field_season_target_id']['id'] = 'field_season_target_id';
  $handler->display->display_options['arguments']['field_season_target_id']['table'] = 'field_data_field_season';
  $handler->display->display_options['arguments']['field_season_target_id']['field'] = 'field_season_target_id';
  $handler->display->display_options['arguments']['field_season_target_id']['relationship'] = 'field_item_target_id';
  $handler->display->display_options['arguments']['field_season_target_id']['default_argument_type'] = 'fixed';
  $handler->display->display_options['arguments']['field_season_target_id']['default_argument_skip_url'] = 0;
  $handler->display->display_options['arguments']['field_season_target_id']['summary']['number_of_records'] = '0';
  $handler->display->display_options['arguments']['field_season_target_id']['summary']['format'] = 'default_summary';
  $handler->display->display_options['arguments']['field_season_target_id']['summary_options']['items_per_page'] = '25';
  $handler->display->display_options['arguments']['field_season_target_id']['break_phrase'] = 0;
  $handler->display->display_options['arguments']['field_season_target_id']['not'] = 0;
  /* Filter criterion: Content: Published */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'node';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = 1;
  $handler->display->display_options['filters']['status']['group'] = 1;
  $handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'order' => 'order',
  );

  /* Display: Content pane */
  $handler = $view->new_display('panel_pane', 'Content pane', 'panel_pane_orders');
  $handler->display->display_options['argument_input'] = array(
    'field_season_target_id' => array(
      'type' => 'context',
      'context' => 'entity:node.nid',
      'context_optional' => 0,
      'panel' => '0',
      'fixed' => '',
      'label' => 'Content: Season (field_season)',
    ),
  );
  $export['orders'] = $view;

  return $export;
}
