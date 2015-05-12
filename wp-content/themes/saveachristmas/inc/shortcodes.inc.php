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
			First Name: <input type="text" name="post_title" required/><br/>
			Donation:
			<input type="text" name="post_content"/>
<!--			<textarea rows="10" name="post_content" cols="20"></textarea>-->
			<input type="checkbox" name="post_category_name[]" value="25.00">$25<br>
			<input type="checkbox" name="post_category_name[]" value="50.00">$50
<!--			<input type="checkbox" name="post_category_name[]" value="100.00">$100<br>-->
<!--			<input type="checkbox" name="post_category_name[]" value="500.00">$200<br>-->
			<input type="submit" />
		</form>
	<?php
	}
}
