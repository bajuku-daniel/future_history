<?php
/**
 * @file
 * template.php
 */

// overrides the default "my account" link with avatar and name
function future_history_menu_link(array $variables) {
  global $user;
  $element = $variables['element'];
  $sub_menu = '';
  $caret_text = '';
  $welcom_text = '';
  if ($element['#below']) {
    unset($element['#below']['#theme_wrappers']); // remove default html menu wrappers
    $sub_menu = '<ul class="dropdown-menu fh-nav-user-picture-dd">' . drupal_render($element['#below']) . '</ul>'; // add wrapper <ul> tag with bootstrap class
    $caret_text = ' <span class="caret"></span>'; // only show caret if submenu exists
  }
  $title = '';
  // Check if the user is logged in, that you are in the correct menu,
  // and that you have the right menu item
  if ($user->uid != 0 && $element['#theme'] == 'menu_link__user_menu' && $element['#href'] == 'user' && !empty($element['#below']) ) {
    $element['#title'] = $welcom_text . '<span class="fh-user">' .  $user->name . '</span>';
    // prepare bootstrap attributes for wrapper <li>, and then the <a> tag it contains
    $element['#attributes']['class'][] = 'dropdown';
    $element['#attributes']['class'][] = 'fh-nav-user-picture';
    $element['#localized_options']['html'] = TRUE;
    $element['#localized_options']['attributes']['class'][] = 'dropdown-toggle';
    $element['#localized_options']['attributes']['data-target'] = '#';
    $element['#localized_options']['attributes']['data-toggle'] = 'dropdown';
    // manually prepare picture, <a> tag with image reference, username (theme_user_picture won't work due to nested <a> tag)
    if (!empty($user->picture)) {
      $fid = $user->picture;
      $file = file_load($fid);
      $title = theme('image_style', array('style_name' => 'fh-avatar-menu', 'path' => $file->uri, 'alt' => $element['#title'], 'title' => $element['#title'])) . '<div class="link-text">' . $caret_text .  $element['#title'] . '</div>' ;
    }
    else {
      // set the default user picture under public://pictures/default.jpg
      $title = theme('image_style', array('style_name' => 'fh-avatar-menu', 'path' => 'public://pictures/default.jpg', 'alt' => $element['#title'], 'title' => $element['#title'])) . '<div class="link-text">' . $caret_text .  $element['#title'] . '</div>' ;
    }
  }
  else {
    $title = $element['#title'];
  }
  $output = l($title, $element['#href'], $element['#localized_options']);

  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

// Hide the "status" filter input box if no entwurf is in
function future_history_preprocess_views_exposed_form(&$variables) {
  $options = isset($variables['form']['status_selective']['#options']) ? $variables['form']['status_selective']['#options'] : '';
  if ($variables['form']['#id'] == 'views-exposed-form-meine-ansichten-page-1') {
    if (!in_array('Entwurf', $options)) {
      unset($variables['widgets']['filter-status_selective']);
    }
  }
}

function future_history_preprocess_page(&$variables) {
    if (isset($variables['node']->type)) {
        $nodetype = $variables['node']->type;
        $variables['theme_hook_suggestions'][] = 'page__' . $nodetype;
    }
    //echo '<pre>'; var_dump($variables['theme_hook_suggestions']); echo '</pre>';
}

//function future_history_preprocess_user_picture(&$variables) {
  //change only the relevant part and leave the rest of the code
  //For Drupal 7 imagecache is in core so I put the correct syntax

/*
  if (!array_key_exists('cid', $variables['account'])) {
    if (empty($variables['account']['picture'])) {

      $variables['user_picture'] = theme('image_style', array('style_name' => 'profile_avatar', 'path' => 'public://pictures/default.jpg', 'alt' => 'user picture', 'title' => 'user picture'));
    }
  }
}*/

function future_history_preprocess_node(&$variables) {
  $variables['messages'] = theme('status_messages');
}
