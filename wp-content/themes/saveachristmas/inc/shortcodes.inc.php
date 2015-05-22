<?php
/**
 * register shortcodes
 */
class sc_shortcodes{
	function __construct(){
		add_shortcode('pledge-summary', array(__CLASS__,'pledge_summary'));
        add_shortcode('share-widget', array(__CLASS__, 'share_frame'));
		add_shortcode('donation-form', array(__CLASS__, 'donation_form'));

	}

	/**
	 * Dynamically build pledge summary
	 */
	function pledge_summary(){
	?>
	<div class="donation-progress-bar">
		<span class="donation-progress-percent">23% Funded</span>
		<span class="donation-progress-funded">$1,800.00 <em>Raised</em></span>

		<span class="donation-progress-togo">0 Days Left</span>

		<div class="donation-progress" style="width: 23%"></div>
	</div>
	<?php
	}



    static function share_frame(){ ?>
        <div>
            <div>
                <div class="share-widget-preview-live">
                    <iframe src="http://<?php echo get_custom_option('social_site'); ?>/campaigns/christian-care-foster-shopping-trip-2015" width="260px" height="260px" frameborder="0" scrolling="no" /></iframe>
                </div>
                <div class="share-widget-preview-code">
                    <strong>Embed Code</strong>

                    <pre>&lt;iframe src="<?php echo get_custom_option('social_site'); ?>/campaigns/christian-care-foster-shopping-trip-2015" width="260px" height="260px" frameborder="0" scrolling="no" /&gt;&lt;/iframe&gt;</pre>
                </div>
            </div>
        </div>
    <?php
    }

    /**
     * create donation form
     */
    static function donation_form(){
	?>
		<form action="" method="post">
		
			<?php
			$args = array(
				'post_type' => 'campaigns',
				'meta_key' => 'is_active',
				'meta_value' => "1",
			);

			$myCampaigns = new WP_Query( $args );
			if( !$myCampaigns->have_posts() ) {
				$campaign_id =  'There Are No Active Campaigns';
				$campaign_title = 'no active campaigns';
				return;
			} else {
				$campaign = $myCampaigns->posts[0];
				setup_postdata($GLOBALS['post'] =& $campaign);
				$campaign_id = get_the_ID();
				$campaign_title = get_the_title();
			}
            ?>

            <input type="hidden" name="post_content" value="Donation for <?php echo $campaign_title; ?>" >
            <input type="hidden" name="meta_annual-donation-campaign-id" value="<?php echo $campaign_id; ?>" >
            <input type="hidden" name="annual-donation-pledge-option-id" value="24"/>
            <strong>First Name</strong>**
            <input type="text" name="post_title" required>
            <strong>Last Name</strong>**
            <input type="text" name="post_title" required/>
            <p></p>
            <strong>Phone Number</strong>**
            <input type="text" name="post_content" required/>
            <strong>Email</strong>**
            <input type="email" name="post_content" required/>
            <p></p>
            <strong>Donation</strong>**
            <label><em>please only check one donation</em></label>
            <p>

            <?php
            /**
             * grab all pledges that match the current campaign's ID
             */
            $arguments = array(
                'numberposts' => -1,  // all the posts
                'post_type'   => 'pledge-options',
                'meta_key' => 'pledge_option_is_active',
                'meta_value' => '1',
            );
            $pledges = get_posts( $arguments );
                foreach ($pledges as $option) {
                    $meta_data = get_post_meta($option->ID, 'pledge_options', true);
                    $html = ' <input type="checkbox" name="meta_annual_donation_pledge_amount" value="' . $meta_data['amount'] . '"> $' . $meta_data['amount'] . '';
                    echo $html;
                }
			?>
            </p>
            **required fields
            <p>
                <input type="submit" />
            </p>
		</form>
	<?php
	}

}
