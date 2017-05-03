<?php
?>
<header id="navbar" role="banner" class="<?php print $navbar_classes; ?>">
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

<!--  for login page-->
<?php if ($user->uid === 0){ ?>
  <div class="main-container container ">
    <?php }else{ ?>
  <div class="container-fluid fill">
<?php } ?>
    <?php print $messages; ?>
    <?php if (!empty($page['help'])): ?>
      <?php print render($page['help']); ?>
    <?php endif; ?>
    <?php print render($page['content']); ?>
  </div>

  <footer class="footer">
      <div class="container">
        <div class="row">
    	     <div class="col-md-12">
            <?php print render($page['footer-top']); ?>
          </div>
        </div>
        <div class="row">
    	     <div class="col-md-12">
            <?php print render($page['footer-bottom']); ?>
          </div>
        </div>
      </div>
    </footer>
