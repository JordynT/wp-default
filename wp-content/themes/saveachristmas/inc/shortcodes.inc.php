<?php
/**
 * register shortcodes
 */
class sc_shortcodes{
	function __construct(){
		add_shortcode('pledge-summary', array(__CLASS__,'pledge_summary'));
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
}
