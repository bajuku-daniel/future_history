<?php
function ds_content_element() {
  return array(
    'label' => t('Content-Element-Wrapper'),
      'regions' => array(
      'inhalt' => t('Inhalt')
    ),
    // Add this line if there is a default css file.
    'css' => TRUE,
    // Add this line if you're using DS 2.x for icon preview
    'image' => TRUE,
  );
}

