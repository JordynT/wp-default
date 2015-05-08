<?php

get_header();

if(have_posts()) :
	while(have_posts()): the_post(); ?>
		<div class="post">
			<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
			<p class="content"><?php the_content(); ?></p>
		</div>
<?php
	endwhile;
else:
	echo "no content found";
endif;

get_footer();

?>