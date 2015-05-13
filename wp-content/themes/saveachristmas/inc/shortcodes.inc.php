<?php
/**
 * register shortcodes
 */
class sc_shortcodes{
	function __construct(){
		add_shortcode('pledge-summary', array(__CLASS__,'pledge_summary'));
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

static function donation_form(){
	?>
<!--		<form action="">-->
<!--			<label for="donation">Donations</label>-->
<!--				<p><label for="">$25.00 </label><input type="checkbox" name="donation" value="25.00"/>-->
<!--				<label for="">$50.00 </label><input type="checkbox" name="donaton" value="50.00"/></p>-->
<!--			<label>First Name</label>-->
<!--			<p><input type="text" name="first-name" required/></p>-->
<!--			<button>Submit</button>-->
<!--		</form>-->

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
			<input type="hidden" name="post_content" value="Donation for <?php echo $campaign_title; ?>"/>
			<input type="hidden" name="meta_annual-donation-campaign-id" value="<?php echo $campaign_id; ?>"/>
			<input type="hidden" name="annual-donation-pledge-option-id" value="24"/>
			<h4>First Name:</h4>**
			<p><input type="text" name="post_title" required></p>
			<h4>Donation:</h4>**
			<p><input type="checkbox" name="meta_annual_donation_pledge_amount" value="25.00">$25
			<input type="checkbox" name="meta_annual_donation_pledge_amount" value="50.00">$50</p>
<!--			<input type="checkbox" name="post_category_name[]" value="100.00">$100<br>-->
<!--			<input type="checkbox" name="post_category_name[]" value="500.00">$200<br>-->
			**required fields
			<input type="submit" />
		</form>
	<?php
	}
}
