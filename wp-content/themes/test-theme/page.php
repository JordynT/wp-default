<?php

get_header();

if(have_posts()) :
	while(have_posts()): the_post(); ?>
		<div class="post">
			<?php
				$args = array(
					'child_of' =>  get_top_ancestor_id()
				); ?>
			<?php wp_list_pages($args); ?>
			<h2 class="post-title"><?php the_title();?></h2>
			<p class="content"><?php the_content(); ?></p>
		</div>
	<?php
	endwhile;
else:
	echo "no content found";
endif;

get_footer();

?>