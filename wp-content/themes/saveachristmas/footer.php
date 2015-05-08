		<footer id="colophon" class="site-footer" role="contentinfo">

			<div class="footer-social">
				<a class="rss" href="http://saveachristmas.com/feed/"><i class="icon-rss"></i></a>
				<a href="#" class="btt"><i class="icon-up-open-big"></i></a>
			</div>
			<div class="copyright container">
				<div class="site-info">
					&copy; <?php echo get_custom_option('site_featured_copyright'); ?>
				</div>
				<!-- .site-info -->

				<nav id="site-footer-navigation" class="footer-navigation">
					<?php
					$args = array(
						'theme_location' => 'footer'
					);
					?>

					<?php wp_nav_menu($args); ?>
				</nav>
			</div>
		</footer><!-- #colophon -->
	</div><!-- #page -->


	<script type='text/javascript' src='http://saveachristmas.com/wp-includes/js/masonry.min.js?ver=3.1.2'></script>
	<script type='text/javascript'
			src='http://saveachristmas.com/wp-includes/js/jquery/jquery.masonry.min.js?ver=3.1.2'></script>
	<script type='text/javascript'
			src='http://saveachristmas.com/wp-content/themes/campaignify/js/jquery.flexslider-min.js?ver=2.1'></script>
	<script type='text/javascript'
			src='http://saveachristmas.com/wp-content/themes/campaignify/js/jquery.magnific-popup.min.js?ver=2.1.4'></script>
	<script type='text/javascript'
			src='http://saveachristmas.com/wp-content/themes/campaignify/js/jquery.fittext.js?ver=2.1'></script>
	<script type='text/javascript'>
		/* <![CDATA[ */
		var campaignifySettings = {
			"l10n": [],
			"ajaxurl": "http:\/\/saveachristmas.com\/wp-admin\/admin-ajax.php",
			"page": {"is_campaign": true, "is_single_comments": false, "is_blog": false},
			"campaignWidgets": {
				"widget_campaignify_campaign_feature": true,
				"widget_campaignify_hero_contribute": true,
				"widget_campaignify_campaign_pledge_levels": true,
				"widget_campaignify_campaign_content": true
			},
			"security": {"gallery": "24dbd92fd8"}
		};
		/* ]]> */
	</script>
	<script type='text/javascript'
			src='http://saveachristmas.com/wp-content/themes/campaignify/js/campaignify.js?ver=20130603'></script>
	<?php wp_footer(); ?>
</body>
</html>