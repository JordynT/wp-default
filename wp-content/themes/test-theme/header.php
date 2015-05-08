<!DOCTYPE html>
<html>

	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width">
		<title><?php bloginfo('name'); ?></title>
		<?php wp_head(); ?>

	</head>
<body <?php body_class(); ?>>
	<div class="container">

		<header class="site-header">
			<h1><a href="<?php echo home_url();?>"><?php bloginfo('name'); ?></a></h1>
			<h5><?php bloginfo('description'); ?></h5>
			<nav class="site-nav primary-nav">
				<?php $args = array(
					'theme_location' => 'primary'
				); ?>
				<?php wp_nav_menu($args); ?>
			</nav>
		</header>

		<div class="options browse">
			<div>Browse All</div>
			<div>See All The Mountains</div>
		</div>
		<a href="http://30andb.com/hikingtrailz/suggest"><div class="options suggest">
				<div>Suggest A Trail</div>
				<div>Send Us What You Wanna See</div>
			</div></a>
		<div class="options randomtrail">
			<div>Random Trail</div>
			<div>Any Random Trail</div>
		</div>
