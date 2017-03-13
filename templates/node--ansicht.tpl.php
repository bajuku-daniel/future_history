<?php
  $theme_path = drupal_get_path('theme', 'future_history');
  drupal_add_js($theme_path.'/js/jquery.mobile.custom.min.js', array('type' => 'file', 'scope' => 'footer'));
  drupal_add_js($theme_path.'/js/image_slider.js', array('type' => 'file', 'scope' => 'footer'));
  $image_old_info =  image_get_info(image_style_path($content['field_bild']['0']['#image_style'] ,$content['field_bild']['#items']['0']['uri']));
?>

<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>
  <div class="content"<?php print $content_attributes; ?>>
    <div class="row ansicht-picture">
      <div class="container">
        <div class="row">
          <div class="col-md-10 col-md-offset-1 col-centered">
            <?php if (!empty($content['field_bild_overlay'])): ?>
              <?php
              $overlay_image_style =  $content['field_bild_overlay']['0']['#image_style'];
              if(isset($variables['mc_style'])){
                $overlay_image_style = $variables['mc_style'];
                //TODO: call themed IMAGE manualcrop here
                $imgstyled = cb_util_render_image($content['field_bild_overlay']['#items']['0'],$overlay_image_style);
              }
              ?>

              <figure class="cd-image-container" style="max-height:<?php print($image_old_info['height']); ?>px; max-width:<?php print($image_old_info['width']); ?>px;">
                <?php print $imgstyled ?>
    			<span class="cd-image-label" data-type="modified">New</span>
     	  	    <div class="cd-resize-img"> <!-- the resizable image on top -->
                  <img src="<?php print  image_style_url($content['field_bild']['0']['#image_style'] ,$content['field_bild']['#items']['0']['uri']); ?>" alt="Original Image">
    		      <span class="cd-image-label" data-type="original">Old</span>
    		  	</div>
                <span class="cd-handle">
                  <?php if (!empty($content['field_jahr'])): ?>
                    <span class="cd-new-label">
                      <?php  print($content['field_jahr']['0']['#markup']);?>
                    </span>
                  <?php endif; ?>
                  <?php if (!empty($content['field_overlay_jahr'])): ?>
                    <span class="cd-old-label">
                      <?php  print($content['field_overlay_jahr']['0']['#markup']); ?>
                    </span>
                  <?php endif; ?>
                </span>
    	      </figure> <!-- cd-image-container -->
            <?php else : ?>
              <div class="futurehistory-single-image">
                <img src="<?php print  image_style_url($content['field_bild']['0']['#image_style'] ,$content['field_bild']['#items']['0']['uri']); ?>" />
              </div>
            <?php endif; ?>
          </div>
        </div>

        <div class="row ansicht-details-aktion">
          <?php if (!empty($content['field_audio_datei'])): ?>
             <div class="col-md-1 col-md-offset-1 ansicht-audio">
               <i class="material-icons">volume_down</i><a class="ansicht-audio-button"> Audio</a>
               <div class="audio-container">
                 <audio id="ansicht-audio-player" src="<?php print($content['field_audio_datei']['0']['#markup']); ?>" controls > Your browser does not support the audio element. </audio>
                 <div class="audio-close"><i class="material-icons">close</i></div>
               </div>
             </div>
             <div class="col-md-3 ansicht-collections">
          <?php else : ?>
             <div class="col-md-3 col-md-offset-1 ansicht-collections">
          <?php endif; ?>

          <?php if ($logged_in == 1): ?>
            <i class="material-icons">library_add</i> <a data-toggle="modal" data-target="#add-to-modal" class="ansicht-collection-button-message">Hinzufügen</a>
            <!-- Modal -->
            <div class="modal fade" id="add-to-modal" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Bild hinzufügen / entfernen</h4>
                  </div>
                  <div class="modal-body">

                    <i class="material-icons">photo_library</i><span class="add-to-modal-link"><?php print flag_create_link('bookmarks', $node->nid); ?></span><br>
                    <span class="add-to-tour-list"><?php print flag_lists_create_link() ?></span>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                  </div>
                </div>
              </div>
            </div>

          <?php else : ?>
            <i class="material-icons">library_add</i> <a data-toggle="modal" data-target="#login-modal" class="ansicht-collection-button-message"> Hinzufügen</a>
            <!-- Modal -->
            <div class="modal fade" id="login-modal" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Lieber Besucher</h4>
                  </div>
                  <div class="modal-body">
                    <?php $destination = drupal_get_destination();?>
                    <p>Zum Anlegen einer Bildersammlung oder einer Tour bitte <a href="/user/login?destination=<?php print $destination['destination']; ?>">ANMELDEN</a> oder <a href="/user/register?destination=<?php print $destination['destination']; ?>">REGISTRIEREN</a></p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>
          </div>

          <div class="col-md-2 ansicht-comment">
            <?php if ($logged_in == 1): ?>
                <i class="material-icons">comment</i><a href="#kommentare" class="ansicht-comment-button"> Kommentieren</a>
              </div>
            <?php else : ?>
                <i class="material-icons">comment</i> <a data-toggle="modal" data-target="#login-modal-comment" class="ansicht-collection-button-message"> Kommentieren</a>
              </div>
              <!-- Modal -->
              <div class="modal fade" id="login-modal-comment" role="dialog">
                <div class="modal-dialog">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Lieber Besucher</h4>
                    </div>
                    <div class="modal-body">
                      <?php $destination = drupal_get_destination();?>
                      <p>Zum kommentieren eines Bildes bitte <a href="/user/login?destination=<?php print $destination['destination'];?>">ANMELDEN</a> oder <a href="/user/register?destination=<?php print $destination['destination'];?>">REGISTRIEREN</a></p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                    </div>
                  </div>
                </div>
              </div>
            <?php endif; ?>

          <div class="col-md-1 ansicht-share">
            <i class="material-icons">share</i><a class="ansicht-share-button"> Teilen</a>
            <div class="share-container">
              <!-- Go to www.addthis.com/dashboard to customize your tools -->
              <div class="addthis_inline_share_toolbox"></div>
              <div class="share-close"><i class="material-icons">close</i></div>
            </div>
          </div>
          <div class="col-md-1 ansicht-info">
            <i class="material-icons">info</i><a href="#infos" class="ansicht-info-button"> Infos</a>
          </div>
          <div class="col-md-2 col-md-offset-1 ansicht-back-to-map">
            <i class="material-icons">keyboard_arrow_left</i><a href="/fh-entdecken-map" class="ansicht-back-button"> Zurück zur Karte</a>
          </div>
        </div>
      </div>
    </div>
    <div class="row ansicht-details">
      <div class="container">

        <div class="col-md-10 col-md-offset-1">
          <?php print render($title_prefix); ?>
          <?php if (!empty($title)): ?>
            <h1><?php print $title; ?> | <?php if(isset($content['field_genauigkeit']) && ($content['field_genauigkeit']['0']['#markup'] == 'ungefähr')) {print('um '); } print($content['field_jahr']['0']['#markup']);?></h1>
          <?php endif; ?>
          <?php if (!empty($content['field_teaser_kurzetext'])): ?>
            <h3><?php  print render($content['field_teaser_kurzetext']);  ?></h3>
          <?php endif; ?>
          <?php if (!empty($content['field_text'])): ?>
            <p><?php  print render($content['field_text']);  ?><p>
          <?php endif; ?>
          <span id="infos" ></span>
          <table class="table table-striped ansicht-info-table">
            <!-- TODO: put all the variables in a Translage string print t(); -->
            <tbody>
              <tr>
                <td class="ansicht-info-lable"><b>Ort</b></td>
                <td class="ansicht-info-content"><?php print($content['field_stadt']['0']['#markup']); ?></td>
              </tr>
               <tr>
                <td class="ansicht-info-lable"><b>Autor</b></td>
                <td class="ansicht-info-content"><?php print render($name); ?></td>
              </tr>
              <tr>
                <td class="ansicht-info-lable"><b>Kategorien</b></td>
                <td class="ansicht-info-content"><?php print render($content['field_kategorie']); ?></td>
              </tr>
              <tr>
                <td class="ansicht-info-lable"><b>Suchbegriffe / Tags</b></td>
                <td class="ansicht-info-content"><?php print render($content['field_tags']); ?></td>
              </tr>
              <tr>
                <td class="ansicht-info-lable"><b>Lizenz</b></td>
                <td class="ansicht-info-content">

                <?php
                  $term=taxonomy_term_load($node->field_lizenz['und'][0]['tid']);
                  $lizenz_name = $term->name;
                  $lizenz_link = NULL;
                  if (!empty($term->field_lizenz_link)) {
                    $lizenz_link = $term->field_lizenz_link['und'][0]['url'];
                    print '<a target="_blank" href="' . $lizenz_link . '">' . $lizenz_name .'</a>';
                  } else {
                    print $lizenz_name;
                  }
                ?>

              </td>
              </tr>
              <tr>
                <td class="ansicht-info-lable"><b>Bildquelle</b></td>
                <?php if (!empty($content['field_bildquelle_url'])): ?>
                  <td style="word-break:break-all;word-wrap:break-word" class="ansicht-info-content"><a href="<?php print $content['field_bildquelle_url'][0]['safe_value']; ?>"><?php print render($content['field_bildquelle']); ?></a></td>
                <?php else: ?>
                  <td style="word-break:break-all;word-wrap:break-word" class="ansicht-info-content"><?php print render($content['field_bildquelle']); ?></td>
                <?php endif; ?>
              </tr>
              <tr>
                <td class="ansicht-info-lable"><b>Urheber</b></td>
                <td class="ansicht-info-content"><?php print render($content['field_urheber']); ?></td>
              </tr>
              <?php if (!empty($content['field_bild_overlay'])): ?>
                <tr>
                  <td class="ansicht-info-lable"><b>Urheber Vergleichsbild</b></td>
                  <td class="ansicht-info-content"><?php print render($content['field_autor_overlay']); ?></td>
                </tr>
                <tr>
                  <td class="ansicht-info-lable"><b>Lizenz Vergleichsbild</b></td>
                  <td class="ansicht-info-content">

                    <?php
                      if (!empty($node->field_lizenz_overlay)) {
                        $term=taxonomy_term_load($node->field_lizenz_overlay['und'][0]['tid']);
                        $lizenz_name = $term->name;
                        $lizenz_link = NULL;
                        if (!empty($term->field_lizenz_link)) {
                          $lizenz_link = $term->field_lizenz_link['und'][0]['url'];
                          print '<a target="_blank" href="' . $lizenz_link . '">' . $lizenz_name .'</a>';
                        } else {
                          print $lizenz_name;
                        }
                      }
                    ?>

                  </td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>

        </div>

        <div class="col-md-10 col-md-offset-1">
          <h4>Satellitenansicht</h4>
          <input type="hidden" id="ansicht_lat" value="<?php print($content['field_position_der_aufnahme']['0']['lat']);?>">
          <input type="hidden" id="ansicht_lng" value="<?php print($content['field_position_der_aufnahme']['0']['lng']);?>">
          <input type="hidden" id="ansicht_direction" value="<?php print($content['field_position_der_aufnahme']['0']['view_direction']);?>">
          <input type="hidden" id="ansicht_angle" value="<?php print($content['field_position_der_aufnahme']['0']['angle']);?>">
          <div style="width:100%; height:400px;" id="ansicht-overview-map"></div>
        </div>

        <div class="col-md-10 col-md-offset-1">
          <span id="kommentare"></span>
          <?php if ($logged_in == 0): ?>
            <!--<h4 id="comments">Kommentare</h4>-->
          <?php endif; ?>
          <?php
            hide($content['field_bild']);
            hide($content['field_bild_overlay']);
            hide($content['field_teaser_kurzetext']);
            hide($content['field_text']);
            hide($content['comments']);
            hide($content['field_jahr']);
            hide($content['field_audio_datei']);
            hide($content['field_overlay_jahr']);
            hide($content['field_stadt']);
            hide($content['field_kategorie']);
            hide($content['field_genauigkeit']);
            hide($content['field_position_der_aufnahme']);
            hide($content['field_bildquelle_url']);
            hide($content['field_lizenz_overlay']);
            hide($content['field_autor_overlay']);
            //print render($content);
          ?>

          <?php print render($content['comments']); ?>
        </div>

      </div> <!-- end container -->

    </div>
  </div>

</div>
