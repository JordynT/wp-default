<?php
get_header();
?>
<div id="main-content" class="main-content">
	<?php #assert( "locate_template( array('$name-$slug.php', '$name.php'), true, false )" ); ?>
	<?php
	//var_export(get_template_directory()); exit;
	//folder,filename(without php)
	get_template_part('partials/static-home-temp');
	?>
</div><!-- #main-content -->
<?php
get_footer();
