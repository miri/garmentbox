core = 7.x
api = 2

; Modules
projects[admin_menu][subdir] = "contrib"
projects[admin_menu][version] = "3.0-rc3"

projects[admin_views][subdir] = "contrib"
projects[admin_views][version] = "1.0"

projects[addressfield][subdir] = "contrib"
projects[addressfield][version] = "1.0-beta3"

projects[auto_nodetitle][subdir] = "contrib"
projects[auto_nodetitle][version] = "1.0"

projects[beautytips][subdir] = "contrib"
projects[beautytips][version] = "2.x-dev"

projects[cas][subdir] = "contrib"
projects[cas][version] = "1.x-dev"

projects[commerce][subdir] = "contrib"
projects[commerce][version] = "1.3"

projects[commerce_migrate][subdir] = "contrib"
projects[commerce_migrate][version] = "1.x-dev"

projects[ctools][subdir] = "contrib"
projects[ctools][version] = "1.2"

projects[date][subdir] = "contrib"
projects[date][version] = "2.6"

projects[devel][subdir] = "contrib"
projects[devel][version] = "1.3"

projects[diff][subdir] = "contrib"
projects[diff][version] = "3.2"

projects[entity][subdir] = "contrib"
projects[entity][version] = "1.x-dev"

projects[entityreference][subdir] = "contrib"
projects[entityreference][version] = "1.0"
projects[entityreference][patch][] = "http://drupal.org/files/1354482-er-user-roles-19.patch"

projects[entityreference_prepopulate][subdir] = "contrib"
projects[entityreference_prepopulate][version] = "1.x-dev"

projects[features][subdir] = "contrib"
projects[features][version] = "1.0"

projects[field_collection][subdir] = "contrib"
projects[field_collection][version] = "1.x-dev"

projects[field_collection_table][subdir] = "contrib"
projects[field_collection_table][version] = "1.x-dev"
projects[field_collection_table][patch][] = "http://drupal.org/files/field_collection_table-hidden_header_fieldr-0.patch"

projects[field_group][subdir] = "contrib"
projects[field_group][version] = "1.1"

projects[flag][subdir] = "contrib"
projects[flag][version] = "2.0-beta8"

projects[fontyourface][subdir] = "contrib"
projects[fontyourface][version] = "2.4"

projects[format_number][subdir] = "contrib"
projects[format_number][version] = "1.x-dev"

projects[gravatar][subdir] = "contrib"
projects[gravatar][version] = "1.1"

projects[image_delta_formatter][subdir] = "contrib"
projects[image_delta_formatter][version] = "1.x-dev"

projects[inline_entity_form][subdir] = "contrib"
projects[inline_entity_form][version] = "1.x-dev"

projects[jcarousel][subdir] = "contrib"
projects[jcarousel][version] = "2.6"

projects[libraries][subdir] = "contrib"
projects[libraries][version] = "1.0"

projects[mailsystem][version] = 2.34
projects[mailsystem][subdir] = "contrib"

projects[message][subdir] = "contrib"
projects[message][version] = "1.6"

projects[message_notify][subdir] = "contrib"
projects[message_notify][version] = "2.3"

projects[migrate][version] = 2.4
projects[migrate][subdir] = "contrib"

projects[migrate_extras][version] = 2.x-dev
projects[migrate_extras][subdir] = "contrib"

projects[mimemail][version] = 1.0-alpha1
projects[mimemail][subdir] = "contrib"
projects[mimemail][patch][] = "http://drupal.org/files/rules-1585546-1-moving_rules_actions.patch"
projects[mimemail][patch][] = "http://drupal.org/files/compress_install_missing_value.patch"

projects[module_filter][subdir] = "contrib"
projects[module_filter][version] = 1.7

projects[multiupload_filefield_widget][subdir] = "contrib"
projects[multiupload_filefield_widget][version] = 1.0
projects[multiupload_filefield_widget][patch][] = "http://drupal.org/files/mfw_size_notice-1548502-6.patch"

projects[multiupload_imagefield_widget][subdir] = "contrib"
projects[multiupload_imagefield_widget][version] = 1.0

projects[oauth][subdir] = "contrib"
projects[oauth][version] = "3.0"
projects[oauth][patch][] = "http://drupal.org/files/980340-d7.patch"
projects[oauth][patch][] = "http://drupal.org/files/1535764-fix-signatures.patch"
projects[oauth][patch][] = "http://drupal.org/files/oauth-1431642-consumer-deletion.patch"

projects[og][subdir] = "contrib"
projects[og][version] = "2.x-dev"

projects[og_purl][subdir] = "contrib"
projects[og_purl][version] = "1.x-dev"

projects[panels][subdir] = "contrib"
projects[panels][version] = "3.3"

projects[pathauto][subdir] = "contrib"
projects[pathauto][version] = "1.1"

projects[purl][subdir] = "contrib"
projects[purl][version] = "1.x-dev"

projects[rules][subdir] = "contrib"
projects[rules][version] = "2.2"

projects[strongarm][subdir] = "contrib"
projects[strongarm][version] = "2.0"

projects[title][subdir] = "contrib"
projects[title][version] = "1.x-dev"

projects[token][subdir] = "contrib"
projects[token][version] = "1.1"

projects[views][subdir] = "contrib"
projects[views][version] = "3.3"

projects[views_bulk_operations][subdir] = "contrib"
projects[views_bulk_operations][version] = "3.1"

; Libraries.
libraries[jquery.cycle][type] = "libraries"
libraries[jquery.cycle][download][type] = "git"
libraries[jquery.cycle][download][url] = "https://github.com/malsup/cycle.git"

libraries[cas][type] = "libraries"
libraries[cas][download][type] = "get"
libraries[cas][download][url] = "http://downloads.jasig.org/cas-clients/php/current.tgz"
libraries[cas][directory_name] = "CAS"

; Themes
projects[omega][subdir] = "contrib"
projects[omega][version] = "4.0-alpha1"
