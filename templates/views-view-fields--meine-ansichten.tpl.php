<?php
$R = 0;
?>
<div class="myfields">
  <div class="views-field views-field-field-bild">
    <div class="title_year">
      <div class="views-field views-field-title">
  <span class="field-content">
<?php print $myvars['title'] ?>
  </span>
      </div>
      <div id="separator"></div>
      <div class="views-field views-field-field-jahr">
        <div
          class="field-content"><?php print $myvars['datum'] ?></div>
      </div>
    </div>
    <div class="field-content">
      <?php print $myvars['bild'] ?>
      <div class="picture-upload-date">hinzugefügt
        am <?php print $myvars['node_created'] ?></div>
      <div class="overlay-container-eigenebilder">
        <div class="overlay-eigenebilder">
          <div class="overlay-inner">
            <a href="/node/<?php print $myvars['nid'] ?>"
               title="Weitere Informationen zu diesem Bild">
              <div class="icon"><i class="material-icons">fullscreen</i></div>
              <div class="icon-text"><?php print t('Details'); ?></div>
            </a>
            <div class="overlay-link-spacer"></div>
            <a
              href="/node/<?php print $myvars['nid'] ?>/edit?destination=<?php print $_GET['q'] ?>"
              title="Bild bearbeiten"
              class="flag unflag-action flag-link-normal" rel="nofollow">
              <div class="icon">
                <i class="material-icons">mode_edit</i>
              </div>
              <div class="icon-text">
                <?php print t('Bearbeiten'); ?>
              </div>
            </a>
            <div class="overlay-link-spacer"></div>
            <a
              href="node/<?php print $myvars['nid'] ?>/delete?destination=<?php print $_GET['q'] ?>"
              title="Bild löschen" class="flag unflag-action flag-link-normal"
              rel="nofollow">
              <div class="icon">
                <i class="material-icons">delete_forever</i>
              </div>
              <div class="icon-text">
                <?php print t('Löschen'); ?>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>