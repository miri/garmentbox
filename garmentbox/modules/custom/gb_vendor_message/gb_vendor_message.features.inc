<?php
/**
 * @file
 * gb_vendor_message.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function gb_vendor_message_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_default_message_type().
 */
function gb_vendor_message_default_message_type() {
  $items = array();
  $items['create_new_vendor_node'] = entity_import('message_type', '{
    "name" : "create_new_vendor_node",
    "description" : "Create new vendor node",
    "argument_keys" : [],
    "argument" : [],
    "category" : "message_type",
    "data" : {
      "token options" : { "clear" : 0 },
      "purge" : { "override" : 0, "enabled" : 0, "quota" : "", "days" : "" }
    },
    "language" : "",
    "arguments" : null,
    "message_text" : { "und" : [
        {
          "value" : "\\u003Ch2\\u003EA new vendor created : [message:field-vendor:title]\\t by [message:field-vendor:author:name] user\\u003C\\/h2\\u003E",
          "format" : "filtered_html",
          "safe_value" : "\\u003Cp\\u003EA new vendor created : [message:field-vendor:title]\\t by [message:field-vendor:author:name] user\\u003C\\/p\\u003E\\n"
        }
      ]
    }
  }');
  return $items;
}
