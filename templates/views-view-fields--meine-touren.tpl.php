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

<div class="icon"><img src="/<?php print drupal_get_path('module', 'futurehistory') . '/images/tourdetails.png' ?>"></div>
<div class="icon-text">Details</div>

</a>


  <!------- SPACER --> <div class="overlay-link-spacer"></div>


<a
  href="<?php print $myvars['edit_url'] ?>"
  title="Diese Tour bearbeiten" class="flag unflag-action flag-link-normal"
  rel="nofollow">
	    <div class="icon">
	<i class="material-icons">mode_edit</i>
	   </div>
	   <div class="icon-text">
	Bearbeiten</div></a>


  <!------- SPACER --> <div class="overlay-link-spacer"></div>


<a
  href="<?php print $myvars['delete_url'] ?>"
  title="Diese Tour löschen" class="flag unflag-action flag-link-normal"
  rel="nofollow">
	    <div class="icon">
	<i class="material-icons">delete_forever</i>
	   </div>
	   <div class="icon-text">
	Löschen</div></a>



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
