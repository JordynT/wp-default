<?php $myCampaigns = new WP_Query();
$myCampaigns->query('showposts=1&post_type=campaigns');

while ( $myCampaigns->have_posts() ) :
$myCampaigns->the_post();

$campaign_options = maybe_unserialize(get_post_meta($post->ID, 'campaign_options', true));
$goal = $campaign_options['goal'];
$total_pledged = ''; //sum(); //the total sum of the donations so far
$total_perc_funded = ''; // floor(($total_pledged / $goal) * 100) //the percentage of funding of the goal

$date = strtotime($campaign_options['end_date']);

$remaining = $date - time();
$days_remaining = floor($remaining / 86400);
?>
<div class="campaign-hero loading has-slideshow">
	<div class="campaign-hero-donate-options animated fadeInDown">
		<div class="donation-progress-bar">
			<span class="donation-progress-percent"><?php echo $total_perc_funded; ?></span>
			<span class="donation-progress-funded"><?php echo $total_pledged; ?> <em>Raised</em></span>

			<span class="donation-progress-togo"><?php echo $days_remaining; ?></span>

			<div class="donation-progress" style="width: 23%"></div>
		</div>
	<?php  endwhile; ?>

		<div class="donation-donate">
			<a href="#"
			   class="button button-primary contribute"><?php echo get_custom_option('site_featured_hero_button'); ?></a>
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
