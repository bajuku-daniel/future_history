<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>


  <div class="content"<?php print $content_attributes; ?>>
    <div class="row">
      <div class="col-md-7">
        <?php if (!empty($content['field_bild_overlay'])): ?> 
          <div class="futurehistory-image-comparsion1">
            <img src="<?php print  file_create_url($content['field_bild']['#items']['0']['uri']); ?>" />
            <img src="<?php print  file_create_url($content['field_bild_overlay']['#items']['0']['uri']); ?>" />
          </div>
        <?php else : ?>
          <div class="futurehistory-single-image">
            <img src="<?php print  file_create_url($content['field_bild']['#items']['0']['uri']); ?>" />
          </div>
        <?php endif; ?>         
      </div>
      <div class="col-md-5">
        <?php 
          hide($content['field_bild']);
          hide($content['field_bild_overlay']);
          print render($content); 
        ?>
      
      </div>

    </div>
  </div>

  <?php print render($content['links']); ?>
</div>

