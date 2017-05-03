<!--------- NEW CONTAINER TITLE YEAR ------------>
<div class="title-tour">
  <div class="views-field views-field-title">
  <span class="field-content">
<?php print $myvars['title'] ?></span>
  </div>
</div>
<!--------- END NEW CONTAINER TITLE YEAR ------------>
<div class="views-field views-field-view">
  <span class="field-content">
  <div class="">
      <div class="view-content">
        <div
          class="views-row views-row-1 views-row-odd views-row-first views-row-last">
  <div class="views-field views-field-field-bild">
    <div class="field-content">
  <!------- SLIDER ---------->
<ul class="rslides ">
<?php print $myvars['images'] ?>
</ul>
  </div>
    <!------ END SLIDER ------------>
    <!-------- OVERLAY CONTAINER ------->
<div class="overlay-container-touren">
<div class="overlay-touren">
<div class="overlay-inner">
<a href="<?php print $myvars['view_url'] ?>" title="Details">
<div class="icon"><img
    src="/<?php print drupal_get_path('module', 'futurehistory') . '/images/tourdetails.png' ?>"></div>
<div class="icon-text">Details</div>
</a>
  <!------- SPACER --> <div class="overlay-link-spacer"></div>

  <?php
  $tour=implode(",",[$row->fid,str_replace(","," ",$row->flag_lists_flags_title),$row->flag_lists_flags_tour_distance]);
  $url = "/de/fh-entdecken-map?y=51.31491849367987&x=9.460614849999956&z=6&k=&d=1644--2016&s=dist&a=all&t=".$tour;
  ?>
  <a
    href="<?php print $url ?>"
    title="Auf Karte anzeigen" class="flag unflag-action flag-link-normal"
    rel="nofollow">
	    <div class="icon">
	<i class="material-icons">mode_edit</i>
	   </div>
	   <div class="icon-text">
	Auf Karte anzeigen</div></a>

	 </div>
  <!--- END OVERLAY---></div>
  <!--- END OVERLAY CONTAINER---></div>
 </div>  </div>
    </div>
</div></span></div>
<div class="views-field views-field-tour-distance">
  <?php print $myvars['distance'] ?></div>
<div class="views-field views-field-period-start">
  <?php print $myvars['period'] ?></div>
<div class="views-field views-field-description">
  <div class="text-end"></div>
  <span class="field-content">
  <?php print $myvars['description'] ?>
    </span>
</div>
