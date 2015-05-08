	<footer>
			<span class="logo-footer">
				<a class="logo-link" href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
			</span>
			<span class="about">
				<h2><?php $args = array(
						'theme_location' => 'footer'
					); ?>
					<?php wp_nav_menu($args); ?>
				</h2>
			</span>
			<span class="social-logos">
				<a href="https://instagram.com/"><i class="fa fa-instagram fa-3x"></i></a>
				<a href="https://www.facebook.com/"><i class="fa fa-facebook-official fa-3x"></i></a>
				<a href="https://twitter.com/"><i class="fa fa-twitter fa-3x"></i></a>
			</span>
	</footer>
</body>

</html>