<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>"/>
	<title>Page Title</title>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

	<div class="hero">
		<div class="photo" style="background-image: url(http://30andb.com/hikingtrailz/css/images/Sup2HDR.jpg)">
			<header class="site-header">
				<nav class="site-nav primary-nav">
							<span class="logo">
								<a class="logo-link" href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
							</span>

					<div class="navigation">
						<?php $args = array(
							'theme_location' => 'primary'
						); ?>
						<?php wp_nav_menu($args); ?>
					</div>
						<span class="user-options">
							<a href="/hikingtrailz/auth/register" title="Signup"><i class="fa fa-user-plus scale"></i></a>
							<a href="/hikingtrailz/auth/login" title="Login"><i class="fa fa-sign-in scale"></i></a>
						</span>
				</nav>
			</header>
			<div class="title">
				<h1 class="welcome-message">Welcome <span class="welcome">Hikerz!</span></h1>

				<div class="welcome-message">Check out our amazing Hiking Trails</div>
			</div>
		</div>
	</div>