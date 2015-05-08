<?php get_header(); ?>
<div id="main" class="site-main">

	<header class="page-header arrowed">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header>

	<div class="container">
		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">
				<?php get_template_part('parts/content','default.part'); ?>

				<!-- #post -->
				<div id="comments" class="comments-area">


				</div>
				<!-- #comments -->

			</div>
			<!-- #content -->
		</div>
		<!-- #primary -->

		<?php get_sidebar('page'); ?>
		<!-- #tertiary -->    </div>


</div><!-- #main -->
</div><!-- #page -->
<?php get_footer(); ?>

