<?php
global $user;
$currentUser = $user->uid;
//get profile url for that you can use $user_id as user id
$profileUrl = arg(1);
// compare usernames to determine whether the user is on their own profile.
if ($currentUser == $profileUrl) {
  //user is on their profile, display link
  $myAccount = 1;
}
else {
  $myAccount = 0;
}
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


       <?php
         $url = url('fh-entdecken-map', array('query' => array('y' => $variables['myvars']['lat'], 'x' => $variables['myvars']['lng'], 'z' => '15', 'k' => '', 'd' => '1644--2016', 'a' => 'all', 's' => 'dist')));
         ?>
            <div class="overlay-link-spacer"></div>

            <a
              href="<?php print $url ?>"
              title="Auf Karte anzeigen"
              class="flag unflag-action flag-link-normal" rel="nofollow">
              <div class="icon">
                <i class="material-icons">mode_edit</i>
              </div>
              <div class="icon-text">
                <?php print t('Auf Karte anzeigen'); ?>
              </div>
            </a>


          </div>
        </div>
      </div>
    </div>
  </div>
</div>