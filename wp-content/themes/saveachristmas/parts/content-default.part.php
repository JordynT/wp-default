<?php
// the query
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<!-- pagination here -->
	<article id="post-189" class="post-189 page type-page status-publish hentry">
		<div class="entry-content">
			<h2><?php the_title(); ?></h2>
			<?php the_content(); ?>
		</div>
	</article>
	<?php endwhile; ?>
	<!-- end of the loop -->
	<!-- pagination here -->
	<?php wp_reset_postdata(); ?>
<?php else : ?>
<?php endif; ?>