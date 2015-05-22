<?php 
/**
 * grab all campaigns that are active and most current
 */
$args = array(
	'post_type' => 'campaigns',
	'meta_key' => 'is_active',
	'meta_value' => "1",
);

$myCampaigns = new WP_Query( $args );
if( !$myCampaigns->have_posts() ) {
	return;
} else {
	$campaign = $myCampaigns->posts[0];
	$campaign_id = $campaign->ID;
	$campaign_options = maybe_unserialize(get_post_meta($campaign_id, 'campaign_options', true));
	$goal = $campaign_options['goal'];
	$end_date = $campaign_options['end-date'];
    $fully_booked = $campaign_options['is_fully_booked'];
}

/**
 * checks if the campaign is fully booked or not, and assigns it the proper modal css class
 */
if( $fully_booked == 1) {
    $modal_css_class = get_custom_option('site_fully_booked_modal_css_class');
} else {
    $modal_css_class = get_custom_option("site_featured_modal_css_class");
}


/**
 * set all variables default
 */
$total = 0;
$total_perc_funded = 0;
$days_remaining = 0;
$date = strtotime($end_date);


/**
 * grab all pledges that match the current campaign's ID
 */
$arguments = array(
	'numberposts' => -1,  // a -1 gets all the posts
	'post_type'   => 'pledges',
    'meta_key' => 'annual-donation-campaign-id',
    'meta_value' => $campaign_id,
);
$pledges = get_posts( $arguments );
?>

    <div class="container">
		<h3 class="campaign-widget-title"><?php echo get_custom_option('pledge_options_title');?></h3>

		<div class="campaignify-pledge-boxes campaignify-pledge-boxes-4 expired">

			<?php
            /**
             * grab all pledge-options that are chosen to be displayed
             */
            $arguments = array(
                'post_type' => 'pledge-options',
                'order' => 'asc',
                'meta_key' => 'pledge_option_is_active',
                'meta_value' => '1',

            );
            $the_query = query_posts($arguments);

			if (have_posts()) : while (have_posts()) : the_post();
				global $post;
				$meta = get_post_meta($post->ID,'pledge_options', true);
				$data_price = $meta['amount'];
				$limit = $meta['limit'];
				$sold = '';
				foreach ($pledges as $pledge){
					$pledge_value = get_post_meta($pledge->ID, 'annual_donation_pledge_amount', true);
					if ($pledge_value == $data_price) {
						$sold += $pledge_value;
					} 
				}
				if (!$sold == '') {
					$sold = $sold / $data_price; 
				}

				$remaining = $limit - $sold;
				$percent = ($sold/$limit) * 100;

                /**
                 * if these values have hit their greatest amounts, they will be set to them.
                 */
                if($percent > 100) {
                    $percent = 100;
                }
                if($remaining < 0) {
                    $remaining = 0;
                }
				?>
					<div class="campaignify-pledge-box <?php echo $modal_css_class; ?>" data-price="<?php echo $data_price; ?>-0">
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
			<?php
            /**
             * if there are not pledge-options, this is the message that will appear
             */
                else : echo 'there are no pledges at this time'; ?>
			<?php endif; ?>
		</div>
		<!--end .edd_price_options-->
<!--        <div class="footer-social">-->
<!--<!--            <a class="rss" href="http://saveachristmas.com/feed/"><i class="icon-rss"></i></a>-->-->
<!--            <a href="#" class="btt"><i class="icon-up-open-big"></i></a>-->
<!--        </div>-->
	</div>