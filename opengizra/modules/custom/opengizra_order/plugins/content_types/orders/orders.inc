<?php

/**
 * Plugin definition.
 */
$plugin = array(
  'title' => t('Orders'),
  'description' => t('Displau orders per Item/ Season'),
  'required context' => new ctools_context_required(t('Node'), 'node'),
  'category' => t('Opengizra Order'),
);

/**
 * Render callback.
 */
function opengizra_order_orders_content_type_render($subtype, $conf, $args, $context) {
  if (empty($context->data)) {
    return FALSE;
  }

  $node = $context->data;

  $module = 'opengizra_order';

  $block = new stdClass();
  $block->module = $module;
  $block->title = t('Orders');
  $block->content = t('No orders created yet.');

  $query = db_select('node', 'n');
  $query->innerJoin('field_data_field_item_variant', 'fiv', 'n.nid = fiv.entity_id');
  $query->innerJoin('field_data_field_item', 'fi', 'fiv.field_item_variant_target_id = fi.entity_id');
  if ($node->type == 'season') {
    $query->innerJoin('field_data_field_season', 'fs', 'fi.field_item_target_id = fs.entity_id');
  }
  $query->innerJoin('field_data_field_inventory_line_inline', 'fili', 'fili.field_inventory_line_inline_target_id = n.nid');
  $query->innerJoin('field_data_field_customer', 'fc', 'fc.entity_id = fili.entity_id');
  $query->innerJoin('node', 'n_customer', 'n_customer.nid = fc.field_customer_target_id');
  $query->innerJoin('node', 'n_variant', 'n_variant.nid = fiv.field_item_variant_target_id');
  $query->innerJoin('field_data_field_inventory_type', 'fit', 'fit.entity_id = n.nid');
  $query->innerJoin('taxonomy_term_data', 'td', 'td.tid = fit.field_inventory_type_target_id');
  $query->leftJoin('field_data_field_quantity_info', 'fqi', 'fqi.entity_id = n.nid');
  $query->innerJoin('field_data_field_quantity', 'fq', 'fq.entity_id = fqi.field_quantity_info_value');
  $query->innerJoin('field_data_field_size', 'fsz', 'fsz.entity_id = fqi.field_quantity_info_value');


  $query->addField('n', 'nid');
  $query->addField('n_customer', 'title', 'customer');
  $query->addField('n_variant', 'title', 'variant');
  $query->addField('td', 'name', 'type');
  $query->addField('fsz', 'field_size_target_id', 'size_tid');
  $query->addField('fq', 'field_quantity_value', 'quantity');
  $query
    ->condition('n.type', 'inventory_line')
    ->condition('fiv.entity_type', 'node')
    ->condition('fi.entity_type', 'node')
    ->condition('fili.entity_type', 'node')
    ->condition('fc.entity_type', 'node')
    ->condition('fit.entity_type', 'node')
    ->condition('fqi.entity_type', 'node')
    ->condition('fq.entity_type', 'field_collection_item')
    ->condition('fsz.entity_type', 'field_collection_item')
    ;

  if ($node->type == 'season') {
    $query->condition('fs.deleted', FALSE);
    $query->condition('fs.field_season_target_id', $node->nid);
  }

  $result = $query->execute();

  $vocabulary = taxonomy_vocabulary_machine_name_load('size');
  $size_tree = taxonomy_get_tree($vocabulary->vid);

  $rows = array();
  $orders = array();
  // group the rows by inventory line node.
  foreach ($result as $row) {
    if (empty($orders[$row->nid])) {
      $orders[$row->nid] = array();
      $orders[$row->nid]['customer'] = $row->customer;
      $orders[$row->nid]['variant'] = $row->variant;
      $orders[$row->nid]['type'] = $row->type;

      foreach($size_tree as $term) {
        $orders[$row->nid][$term->tid] = 0;
      }
    }
    $orders[$row->nid][$row->size_tid] = $row->quantity;
  }
  if (!$orders) {
    return $block;
  }

  $header = array();
  $header['customer'] = t('Customer');
  $header['item variant'] = t('Variation');

  foreach ($size_tree as $term) {
    $header[$term->tid] = $term->name;
  }
  $header['total'] = t('Total');
  $header['status'] = t('Status');

  $table = array();
  foreach ($orders as $row) {
    $tr = array();
    $tr[] = $row['customer'];
    $tr[] = $row['variant'];

    $total = 0;
    foreach($size_tree as $term) {
      $total += $row[$term->tid];
      $tr[] = $row[$term->tid];
    }

    $tr[] = $total;

    $tr[] = $row['type'];

    // Total row description.
    $table[] = $tr;
  }

  $block->content = array(
    '#theme' => 'table',
    '#header' => $header,
    '#rows' => $table,
  );

  return $block;
}

/**
 * Edit form.
 */
function opengizra_order_orders_content_type_edit_form($form, &$form_state) {
  return $form;
}
