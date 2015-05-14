<?php 
	
?>

<div class="container">
		<h3 class="campaign-widget-title"><?php echo get_custom_option('pledge_options_title');?></h3>

		<div class="campaignify-pledge-boxes campaignify-pledge-boxes-4 expired">

			<?php
			//$the_query = new WP_Query('pledge-options_id=' . get_custom_option('pledge_option_one'));
			//$the_query = query_posts('post_type=pledge-options&p='. get_custom_option('pledge-option-one'));
			$the_query = query_posts('post_type=pledge-options&orderby=date&order=ASC');
			$sold = 3;
			if (have_posts()) : while (have_posts()) : the_post();

//				$pledge_donation = query_posts('post_type=pledges');
//				if (have_posts()) : while (have_posts()) : the_post();
//						if($pledge_donation->)

				global $post;
				$meta = get_post_meta($post->ID,'pledge_options', true);
				$data_price = $meta['amount'];
				$limit = $meta['limit'];
				$remaining = $limit - $sold;
				$percent = ($sold/$limit) * 100;
				$fully_booked = 0;

				// $campaign_options = get_post_meta(get_the_ID(), 'campaign_options', true);
				// $fully_booked = $campaign_options['is_fully_booked'];
				?>
					<!-- <div class="campaignify-pledge-box <?php ($fully_booked == 1 ? ' get_custom_option("site_fully_booked_modal_css_class") ' : get_custom_option('site_featured_modal_css_class')) ?>" data-price="<?php echo $data_price; ?>-0"> -->
					<div class="campaignify-pledge-box <?php echo get_custom_option('site_featured_modal_css_class'); ?>" data-price="<?php echo $data_price; ?>-0">
						<h3><?php the_title(); ?></h3>

						<div class="donation-progress-bar">
							<div class="donation-progress" style="width: <?php echo	 $percent; ?>%"></div>
						</div>

						<div class="backers">
							<small class="limit">Limit of <?php
								if($meta != '') {
									echo $limit;
								}else {
									echo "Can't Display The Content";
								}?>
								&mdash;
								<?php if($meta != '') {
									echo $remaining;?> remaining
								<?php
								}else {
									echo "Can't Display The Content";
								}?>

							</small>
						</div>

						<p><?php the_content(); ?></p>

					</div>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			<?php else : ?>
			<?php endif; ?>
		</div>
		<!--end .edd_price_options-->
	</div>