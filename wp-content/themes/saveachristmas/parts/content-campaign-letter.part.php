<?php

	$myCampaigns = new WP_Query();
	$myCampaigns->query('showposts=1&post_type=campaigns');

	while ( $myCampaigns->have_posts() ) :
		$myCampaigns->the_post();
?>
		<h3 class="campaign-widget-title"><?php the_title(); ?></h3>
		<h3> Start Date:
			<?php
			if ( get_post_meta( get_the_ID(), 'campaign_options', true ) ) {
				$values = maybe_unserialize(get_post_meta(get_the_ID(), 'campaign_options', true));
				echo $values['start-date'];
			}
			?>
		</h3>
		<?php the_content();?>
<?php endwhile;
wp_reset_postdata(); //re-sets everything back to normal
?>
