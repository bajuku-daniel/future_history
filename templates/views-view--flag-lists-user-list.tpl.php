<?php

/**
 * @file
 * Main view template.
 *
 * Variables available:
 * - $classes_array: An array of classes determined in
 *   template_preprocess_views_view(). Default classes are:
 *     .view
 *     .view-[css_name]
 *     .view-id-[view_name]
 *     .view-display-id-[display_name]
 *     .view-dom-id-[dom_id]
 * - $classes: A string version of $classes_array for use in the class attribute
 * - $css_name: A css-safe version of the view name.
 * - $css_class: The user-specified classes names, if any
 * - $header: The view header
 * - $footer: The view footer
 * - $rows: The results of the view query, if any
 * - $empty: The empty text to display if the view is empty
 * - $pager: The pager next/prev links to display, if any
 * - $exposed: Exposed widget form/info to display
 * - $feed_icon: Feed icon to display, if any
 * - $more: A link to view more, if any
 *
 * @ingroup views_templates
 */
?>

<div class="<?php print $classes; ?>">
  <?php print render($title_prefix); ?>
  <?php if ($title): ?>
    <?php print $title; ?>
  <?php endif; ?>
  <?php print render($title_suffix); ?>
  <?php if ($header): ?>
    <?php
    $title_1 = $view->field['title_1']->original_value;
    $period_start = $view->field['period_start']->original_value;
    $period_end = $view->field['period_end']->original_value;
    $tour_distance = $view->field['tour_distance']->original_value;
    $edit_list = $view->field['edit_list']->original_value;
    $description = $view->field['description']->original_value;
    $fid = $view->field['fid']->original_value;



    $user_app_deeplink_access = isset($view->result[0]->flag_lists_flags_android_purchase_id) && !empty($view->result[0]->flag_lists_flags_android_purchase_id) && ($user->uid !== $view->result[0]->flag_lists_flags_uid);
//    $user_app_deeplink_access = true;
//    $view->result[0]->flag_lists_flags_android_purchase_id
    //markup for deeplinks
    $google_qr_deeplink_url = $view->result[0]->flag_lists_flags_tour_deeplink;
    $google_qr_image_url = $view->result[0]->flag_lists_flags_tour_qrcode;

    $google_qr_alt
      = t('QR Code for @url', array(
      '@url' => $google_qr_deeplink_url
    ));

    $google_qr_code_img = theme('image', array(
      'path' => $google_qr_image_url,
      'alt' => $google_qr_alt,
      'attributes' => array('class' => 'googleQRcode'),
    ));
    $tour_deeplink_qr_code_image = $google_qr_code_img;
    $tour_deeplink_qr_code_markup = '<div class="deeplink_wrapper">
<p>Verwende auf deinem Smartphone oder Tablet einen QR-Code scanner oder die Future-History App um den Code zu scannen und die Tour zu laden.<br><br>

Future-History App:<br>
nach dem Öffnen der App in der Anmeldemaske “QR-Code scannen” auswählen.</p>
</div>';
    ?>

    <div class="container">
    <div class="view-header">
      <!--      --><?php //print $header; ?>

      <h4>Meine Tour: <?php print $title_1 ?> | <?php print $period_start ?>
        - <?php print $period_end ?> | <span
          id="tour_distance"><?php print $tour_distance ?></span> M</h4>

      <?php if (user_is_logged_in()): ?>  <a href="/de/user/touren">Meine Touren
        auflisten</a> | <?php print $edit_list ?>
      <?php endif; ?>

      <?php if (isset($user_app_deeplink_access) && $user_app_deeplink_access && $header): ?>

        <?php
    switch ($view->result[0]->flag_lists_flags_tour_type){
        case 0:
          $tour_typ_class = 'free';
          break;
        case 1:
          $tour_typ_class = 'group';
          break;
        case 2:
          $tour_typ_class = 'single';
          break;
        }

        ?>
        <a data-toggle="modal"
           data-target="#add-to-modal"
           class="ansicht-collection-button-message"><button class="btn btn-primary btnNext" type="submit" id="qr-code" ><span class="icon glyphicon <?php print $tour_typ_class ?>"></span> Diese
          Tour in der App öffnen</button></a>


      <?php endif; ?>

      <p><?php print $description ?></p>
      <div class="hidden-fields" style="display:none"><input id="tour_id"
                                                             value="<?php print $fid ?>"/>
      </div>

    </div>
    </div>
  <?php endif; ?>
  <?php if (isset($user_app_deeplink_access) && $user_app_deeplink_access && $header): ?>
  <!-- Modal -->
  <div class="modal fade" id="add-to-modal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close"
                  data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tour in APP öffnen</h4>
        </div>
        <div class="modal-body">


<!--          <div class="row">-->
<!--            <div class="col-md-12"><label>Direktlink zur Tour</label> <p>Direktlink zur Installation der APP und zum Öffnen der Tour: <br><b>--><?php //print l($google_qr_deeplink_url, $google_qr_deeplink_url) ?><!-- </b><br><br><br></p></div>-->
<!--          </div>-->
          <div class="row">
            <div
              class="col-md-6"><?php print $tour_deeplink_qr_code_image; ?></div>
            <div
              class="col-md-6"><?php print $tour_deeplink_qr_code_markup ?></div>


          </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">
            Schließen
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal END -->
  <?php endif; ?>
  <?php if ($exposed): ?>
    <div class="view-filters">
      <?php print $exposed; ?>
    </div>
  <?php endif; ?>

  <?php if ($attachment_before): ?>
    <div class="attachment attachment-before">
      <?php print $attachment_before; ?>
    </div>
  <?php endif; ?>

  <?php if ($rows): ?>
    <div class="view-content">
      <div class="row">
        <?php print $rows; ?>
      </div>
      <div class="row">
        <div class="container"> <h4> Übersichtskarte </h4></div>
        <div style="width:100%;height:500px;" id="fh-touren-detail-map"></div>
      </div>

    </div>
  <?php elseif ($empty): ?>
    <div class="view-empty">
      <?php print $empty; ?>
    </div>
  <?php endif; ?>

  <?php if ($attachment_after): ?>
    <div class="attachment attachment-after">
      <?php print $attachment_after; ?>
    </div>
  <?php endif; ?>

  <?php if ($more): ?>
    <?php print $more; ?>
  <?php endif; ?>

  <?php if ($footer): ?>
    <div class="view-footer">
      <?php print $footer; ?>
    </div>
  <?php endif; ?>

  <?php if ($feed_icon): ?>
    <div class="feed-icon">
      <?php print $feed_icon; ?>
    </div>
  <?php endif; ?>

</div><?php /* class view */ ?>
