<?php if (isset($title_suffix['contextual_links'])): ?>
<?php print render($title_suffix['contextual_links']); ?>
<?php endif; ?>

<?php



if (strpos(htmlspecialchars($inhalt), htmlspecialchars('>Blau</div>')) === false) {
	print '<div id="content_element_wrapper_white">';
} else {
	print '<div id="content_element_wrapper_blue">';
}

print '<div id="content_element_content_area">';
print $inhalt;
print '</div>';

print '</div>';

?>



<?php if (!empty($drupal_render_children)): ?>
  <?php print $drupal_render_children ?>
<?php endif; ?>
