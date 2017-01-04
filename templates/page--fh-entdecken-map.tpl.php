<?php
?>
<header id="navbar" role="banner" class="<?php print $navbar_classes; ?> nav-no-border">
  <div class="container">
    <div class="navbar-header">
      <?php if ($logo): ?>
      <a class="logo navbar-btn pull-left" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
        <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
      </a>
      <?php endif; ?>
      <?php if (!empty($page['places_search'])): ?>
        <div class="places_search">
          <?php print render($page['places_search']); ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($site_name)): ?>
      <a class="name navbar-brand" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>"><?php print $site_name; ?></a>
      <?php endif; ?>

      <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <?php if (!empty($primary_nav) || !empty($secondary_nav) || !empty($page['navigation'])): ?>
      <div class="navbar-collapse collapse navbar-right">
        <nav role="navigation">
          <?php if (!empty($primary_nav)): ?>
            <div class="first-nav navbar-nav">
              <?php print render($primary_nav); ?>
            </div>
          <?php endif; ?>
          <?php if (!empty($secondary_nav)): ?>
            <?php print render($secondary_nav); ?>
          <?php endif; ?>
          <?php if (!empty($page['navigation'])): ?>
            <?php print render($page['navigation']); ?>
          <?php endif; ?>
        </nav>
      </div>
    <?php endif; ?>
  </div>
</header>



<!-- Removed all the sections and Div container and Style the view in the entdecken view template -->
<!-- futurehistory-entdecken-map.tpl.php -->
<div class="entdecken-container container-fluid">
  <?php print $messages; ?>
  <?php if (!empty($tabs)): ?>
    <?php print render($tabs); ?>
  <?php endif; ?>
  <?php if (!empty($page['help'])): ?>
    <?php print render($page['help']); ?>
  <?php endif; ?>
  <?php if (!empty($action_links)): ?>
    <ul class="action-links"><?php print render($action_links); ?></ul>
  <?php endif; ?>
  <?php print render($page['content']); ?>
</div>


<footer class="footer-entdecken">
  <div class="container">
    <div class="row">
	  <div class="col-md-3">
        <?php print render($page['footer-1']); ?>
      </div>
	  <div class="col-md-3">
        <?php print render($page['footer-2']); ?>
      </div>
	  <div class="col-md-3">
        <?php print render($page['footer-3']); ?>
      </div>
	  <div class="col-md-3">
        <?php print render($page['footer-4']); ?>
      </div>
    </div>
  </div>
</footer>
