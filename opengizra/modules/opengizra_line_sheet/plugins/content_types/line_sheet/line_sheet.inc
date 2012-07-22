<?php

/**
 * Plugin definition.
 */
$plugin = array(
  'title' => t('Line Sheet'),
  'description' => t('Show a line sheet of a collection.'),
  'category' => t('Opengizra - Line Sheet'),
  'required context' => new ctools_context_required(t('Node'), 'node'),
  'hook theme' => 'opengizra_line_sheet_line_sheet_content_type_theme',
);

/**
 * Render callback.
 */
function opengizra_line_sheet_line_sheet_content_type_render($subtype, $conf, $args, $context) {
  if (empty($context->data)) {
    return;
  }

  $node = $context->data;

  $module = 'opengizra_line_sheet';
  $block = new stdClass();
  $block->module = $module;
  $block->title = t('Line Sheet @collection', array('@collection' => $node->title));

  if (!$nids = opengizra_line_sheet_flag_get_flagged_content('line_sheet', $node)) {
    $block->content = t('No items added to the line sheet.');
    return $block;
  }

  $items = array();
  // Iterate over the item instances, but key them by the item node ID.
  foreach ($nids as $row) {
    $nid = $row->content_id;
    $sizes = array();
    $wrapper = entity_metadata_wrapper('node', $nid);
    $item_wrapper = $wrapper->field_item;

    $item_nid = $item_wrapper->getIdentifier();

    $items[$item_nid]['body'] = $wrapper->body->value() ? $wrapper->body->value->value() : '';
    if ($image = $wrapper->field_images->value()) {
      $items[$item_nid]['images'][] = array('data' => theme('image_style', array('style_name' => 'thumbnail', 'path' => $image[0]['uri'])));
    }
    foreach ($wrapper->field_size_info as $size_wrapper) {
      $sizes[] = $size_wrapper->field_size->label();
    }
    $items[$item_nid]['sizes'] = implode(', ', $sizes);
  }

  $output = '';
  foreach ($items as $nid => $variables) {
    $variables['images'] = theme('item_list', array('items' => $variables['images']));
    $output .= theme('opengizra_line_sheet', $variables);
  }

  $block->content = $output;
  return $block;
}

/**
 * Form settings.
 */
function opengizra_line_sheet_line_sheet_content_type_edit_form($form, &$form_state) {
  return $form;
}

/**
 * Delegated hook_teheme().
 */
function opengizra_line_sheet_line_sheet_content_type_theme(&$theme, $plugin) {
  $theme['opengizra_line_sheet'] = array(
    'path' => $plugin['path'],
    'template' => 'line-sheet',
    'variables' => array(
      'body' => NULL,
      'images' => NULL,
      'links' => NULL,
      'sizes' => NULL,
    ),
  );
}

