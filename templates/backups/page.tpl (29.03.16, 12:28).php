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
      <?php if (!empty($page['language'])): ?>
        <div class="language-switcher">
          <?php print render($page['language']); ?>
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

<?php if ($is_front == TRUE): ?>

  <div class="main fill">
    <div class="container">
      <header role="banner" id="page-header">
        <?php print render($page['header']); ?>
      </header> <!-- /#page-header -->
      <div class="row">
        <section<?php print $content_column_class; ?>>
          <a id="main-content"></a>
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
          <div class="slide_caption">
            <div class="container ">
		      <div class="row">
		        <div class="col-md-8 col-md-offset-2">
                  <div class="backstretch-caption-wrapper">
	   			    <div class="backstretch-caption-container"> </div>
                  </div>
                </div>
		      </div>
		    </div>
          </div>
          <div class="start_content container-fluid">
            <?php print render($page['content']); ?>
          </div>
        </section>
      </div>
    </div>
  </div>
<?php endif; ?>

  
<?php if ($is_front == FALSE): ?>
  <div class="main-container container">
    <header role="banner" id="page-header">
      <?php print render($page['header']); ?>
    </header> <!-- /#page-header -->
    <div class="row">
      <?php if (!empty($page['sidebar_first'])): ?>
        <aside class="col-sm-3" role="complementary">
          <?php print render($page['sidebar_first']); ?>
        </aside>  <!-- /#sidebar-first -->
      <?php endif; ?>
      <section<?php print $content_column_class; ?>>
        <?php if (!empty($page['highlighted'])): ?>
          <div class="highlighted jumbotron"><?php print render($page['highlighted']); ?></div>
        <?php endif; ?>
        <?php if (!empty($breadcrumb)): print $breadcrumb; endif;?>
        <a id="main-content"></a>
        <?php print render($title_prefix); ?>
        <?php if (!empty($title)): ?>
          <h1 class="page-header"><?php print $title; ?></h1>
        <?php endif; ?>
        <?php print render($title_suffix); ?>
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
      </section>
      <?php if (!empty($page['sidebar_second'])): ?>
        <aside class="col-sm-3" role="complementary">
          <?php print render($page['sidebar_second']); ?>
        </aside>  <!-- /#sidebar-second -->
      <?php endif; ?>
    </div>
  </div>
<?php endif; ?>


<footer class="footer">
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
