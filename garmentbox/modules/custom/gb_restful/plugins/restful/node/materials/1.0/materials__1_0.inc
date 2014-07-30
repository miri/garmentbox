<?php

$plugin = array(
  'label' => t('Materials'),
  'resource' => 'materials',
  'name' => 'materials__1_0',
  'entity_type' => 'node',
  'bundle' => 'material',
  'description' => t('Export the "Material" content type.'),
  'class' => 'GbMaterialsResource',
  'authentication_types' => TRUE,
);
