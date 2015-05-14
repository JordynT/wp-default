<?php
//$myCampaigns = new WP_Query();
//$myCampaigns->query('showposts=1&post_type=campaigns');
//
//while ( $myCampaigns->have_posts() ) :
//$myCampaigns->the_post();

	$args = array(
		'post_type' => 'campaigns',
		'meta_key' => 'is_active',
		'meta_value' => "1",
	);

	$myCampaigns = new WP_Query( $args );
	if( !$myCampaigns->have_posts() ) {
		echo '<h2>There Are No Active Campaigns</h2>';
		return;
	} else {
		$campaign = $myCampaigns->posts[0];
		setup_postdata($GLOBALS['post'] =& $campaign);
		$campaign_id = get_the_ID();
		$campaign_options = maybe_unserialize(get_post_meta($campaign_id, 'campaign_options', true));
		$goal = $campaign_options['goal'];
		$end_date = $campaign_options['end-date'];
		echo $goal;?><br>
<?php		echo $end_date;
	}

//$campaign_options = maybe_unserialize(get_post_meta($post->ID, 'campaign_options', true));

$date = 12312313; //strtotime($campaign_options['end_date']);
$total = 0;
$total_perc_funded = 0;
$days_remaining = 0;
//echo $goal;

//


$arguments = array(
	'numberposts' => -1,  // all the posts
	'post_type'   => 'pledges',
    'meta_key' => 'annual-donation-campaign-id',
    'meta_value' => $campaign_id,
);
$pledges = get_posts( $arguments );
$total = 0;
foreach( $pledges as $donation ) {
    //var_export($donation);
    $post_meta = get_post_meta($donation->ID,'annual-donation-campaign-id', true );
    $total += $post_meta;
echo '<h2>' . $total . '</h2>';


//    $meta_data = get_post_meta($donation->ID, 'annual_donation_pledge_amount', true);
//    $meta_data .= doubleval($meta_data);
//    echo '<li>' . $meta_data . '</li>';
}

echo '<b>' . $total . '</b>';

////$total_pledged = 100; //sum(); //the total sum of the donations so far
//$total_perc_funded = floor(($total / $goal) * 100); //the percentage of funding of the goal
//
//
//
//$remaining = $date - time();
//$days_remaining = floor($remaining / 86400);
?>
<div class="campaign-hero loading has-slideshow">
	<div class="campaign-hero-donate-options animated fadeInDown">
		<div class="donation-progress-bar">
			<span class="donation-progress-percent"><?php echo $total_perc_funded; ?> %</span>
			<span class="donation-progress-funded"><?php echo $total; ?> <em> Pledges Raised</em></span>

			<span class="donation-progress-togo"><?php echo $days_remaining; ?> Days left</span>

			<div class="donation-progress" style="width: 23%"></div>
		</div>
<!--	--><?php // endwhile; ?>

		<div class="donation-donate">
			<a href="#" class="button button-primary contribute <?php echo get_custom_option('site_featured_modal_css_class'); ?>"><?php echo get_custom_option('site_featured_hero_button'); ?></a>
		</div>

		<div class="donation-share">
			<span class="donation-share-text"><?php echo get_custom_option('social_title'); ?></span>
			<span class="donation-share-buttons">
			<?php
			$str = get_custom_option('social_text');
			$social_array = explode(" ", $str);
			$social_text = implode("+", $social_array);
			$social_site = get_custom_option('social_site');
			//			print_r($social_text);

			if ( get_option(SM_SITEOP_PREFIX . 'social_facebook') == 'true' ) {
//				$html = '<a href="http://www.facebook.com"><i class="icon-facebook"></i></a>';


				$html = "<a href=\"http://www.facebook.com/sharer.php?u=" . $social_text . "+http%3A%2F%2F" . $social_site . "\"
					 target=\"_blank\" onclick=\"javascript:window.open('http://www.facebook.com/sharer.php?u=" . $social_text . "+http%3A%2F%2F" . $social_site . "','',
  				 	'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;\"><i class=\"icon-facebook\"></i></a>";

				echo $html;
			}

			//			if(get_option(SM_SITEOP_PREFIX.'social_twitter') != 'true')
			if ( get_option(SM_SITEOP_PREFIX . 'social_twitter') == 'true' ) {
				$html = "<a href=\"https://twitter.com/intent/tweet?text=" . $social_text . "+http%3A%2F%2F" . $social_site . "\"
					target=\"_blank\" onclick=\"javascript:window.open('https://twitter.com/intent/tweet?text=" . $social_text . "+http%3A%2F%2F" . $social_site . "','',
	  				'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;\"><i class=\"icon-twitter\"></i></a>";

				echo $html;
			}

			if ( get_option(SM_SITEOP_PREFIX . 'social_googleplus') == 'true' ) {
//				$html = '<a href="http://www.googleplus.com"><i class="icon-gplus"></i></a>';

				$html = "<a href=\"https://plus.google.com/share?url=http://" . $social_site . "content=" . $social_text . "+http%3A%2F%2F" . $social_site . "\"
					target=\"_blank\" onclick=\"javascript:window.open('https://plus.google.com/share?url=http://" . $social_site . "content=" . $social_text . "+http%3A%2F%2F" . $social_site . "','',
	  				'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;\"><i class=\"icon-gplus\"></i></a>";

				echo $html;
			}
			?>
<a href="#share-widget" class="fancybox" target="_blank"><i class="icon-code"></i></a></span>
		</div>


		<div id="share-widget" class="modal-share modal">
			<h2 class="modal-title">Share this Campaign</h2>

			<p>Help raise awareness for this campaign by sharing this widget. Simply paste the following
				HTML code most places on the web.</p>

			<div class="share-widget-preview">
				<div class="share-widget-preview-live">
					<iframe
						src="http://saveachristmas.com/campaigns/christian-care-foster-shopping-trip-2014/?widget=1"
						width="260px" height="260px" frameborder="0" scrolling="no"/>
					</iframe>
				</div>

				<div class="share-widget-preview-code">
					<strong>Embed Code</strong>

					<pre>&lt;iframe src="http://saveachristmas.com/campaigns/christian-care-foster-shopping-trip-2014/?widget=1" width="260px" height="260px" frameborder="0" scrolling="no" /&gt;&lt;/iframe&gt;</pre>
				</div>
			</div>
		</div>
	</div>
	<div class="campaign-hero-slider">
		<ul class="slides">
			<li class="campaign-hero-slider-item">
				<div class="campaign-hero-slider-info">
					<h2 class="campaign-hero-slider-title animated fadeInDown"><?php echo get_custom_option('site_featured_hero_title'); ?></h2>

					<p class="campaign-hero-slider-desc animated fadeInDown"></p>
				</div>

				<img src="<?php echo get_custom_option('site_featured_hero_image'); ?>">
			</li>
		</ul>
	</div>
