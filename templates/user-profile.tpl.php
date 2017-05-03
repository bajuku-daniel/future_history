<?php

/**
 * @file
 * Default theme implementation to present all user profile data.
 *
 * This template is used when viewing a registered member's profile page,
 * e.g., example.com/user/123. 123 being the users ID.
 *
 * Use render($user_profile) to print all profile items, or print a subset
 * such as render($user_profile['user_picture']). Always call
 * render($user_profile) at the end in order to print all remaining items. If
 * the item is a category, it will contain all its profile items. By default,
 * $user_profile['summary'] is provided, which contains data on the user's
 * history. Other data can be included by modules. $user_profile['user_picture']
 * is available for showing the account picture.
 *
 * Available variables:
 *   - $user_profile: An array of profile items. Use render() to print them.
 *   - Field variables: for each field instance attached to the user a
 *     corresponding variable is defined; e.g., $account->field_example has a
 *     variable $field_example defined. When needing to access a field's raw
 *     values, developers/themers are strongly encouraged to use these
 *     variables. Otherwise they will have to explicitly specify the desired
 *     field language, e.g. $account->field_example['en'], thus overriding any
 *     language negotiation rule that was previously applied.
 *
 * @see user-profile-category.tpl.php
 *   Where the html is handled for the group.
 * @see user-profile-item.tpl.php
 *   Where the html is handled for each item in the group.
 * @see template_preprocess_user_profile()
 *
 * @ingroup themeable
 */

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

<div class="container">
  <div class="row PROFILE_TPL">
    <div class="col-sm-12 blog-main">
      <h4>Profil</h4>
      <div class="blog-post profil">

        <div
          class="picture circular"><?php print $user_profile['user_picture']['#markup']; ?></div>
        <div class="name"><?php print render($user_name); ?>
          <?php if ($myAccount): ?>
            <a class="btn btn-default profile-edit-button"
               href="/user/<?php print($currentUser); ?>/edit?destination=<?php print $_GET['q'] ?>">Profil
              Bearbeiten </a>
          <?php endif ?></div>
        <div
          class="info"><?php print $total_bilder . ' | ' . $total_touren ?></div>
      </div>
    </div>
  </div>

  <div class="row PROFILE_TPL">
    <div class="col-sm-12 ">
      <?php if (!empty(trim($user_interessts))): ?>
        </br></br><span><b>Interessen</b></br>
          <?php print $user_interessts; ?></span></br>
      <?php endif ?>
      <?php if (!empty($user_about)): ?>
        </br></br><span> <b>Über mich</b></br>
          <?php print $user_about; ?></span>
      <?php endif ?>
    </div>
  </div>


</div>

<?php if (!empty($user_activity)): ?>
  <div class="row PROFILE_TPL_activity">
    <div class="col-sm-12 ">
      <div class="blog-post activity">
        <h4>Benutzer Aktivität</h4>
        <?php print $user_activity; ?>
      </div>
    </div>
  </div>
<?php endif ?>

<?php if ((int) $user_last_views_total > 0): ?>

  <div class="container-fluid fill">
    <div class="row PROFILE_TPL_ansichten">
      <div class="col-sm-12 blog-main ansichten">
        <div class="blog-post">
          <?php print $user_last_views; ?>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php if ((int) $user_tours_views_total > 0): ?>
  <div class="container-fluid fill">
    <div class="row PROFILE_TPL_touren">
      <div class="col-sm-12 blog-main touren">
        <div class="blog-post">
          <?php print $user_tours_views; ?>
        </div>
      </div>
    </div>
  </div>

<?php endif; ?>



