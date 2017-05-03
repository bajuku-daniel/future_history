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
<div class="container container-ansichten">
  <div class="row">

    <h4> <?php print(t('Eigene Bilder')); ?>  </h4>
    <?php if ($exposed): ?>
      <div class="view-exposed">
        <?php print $exposed; ?>

      </div>
    <?php endif; ?>
    <div class="addAnsichtButtons">
      <a
        href="/de/fh-entdecken-map?y=51.31491849367987&x=9.460614849999956&z=6&k=&d=1644--2016&s=dist&a=<?php print $profileUrl ?>"
        class="btn btn-primary btnNext">Auf Karte anzeigen</a>
  <?php if($myAccount): ?>
      <a
        href="/de/user/meine_ansichten"
        class="btn btn-primary btnNext">Bilder bearbeiten</a>
  <?php endif; ?>
    </div>
    <?php if (isset($empty)): ?>
      <div class="view-empty">
        <?php print $empty; ?>
      </div>
    <?php endif; ?>


  </div>
</div>

<div class="container-fluid">
  <div class="row-fluid">
    <div class="col-sm-12">
      <div class="<?php print $classes; ?>">
        <?php if ($rows): ?>
          <div class="view-content">
            <?php print $rows; ?>
          </div>

        <?php endif; ?>

      </div>

    </div>
    </br>


  </div>

</div>

<div class="pager wrapper">
  <?php print $pager ?>
</div>