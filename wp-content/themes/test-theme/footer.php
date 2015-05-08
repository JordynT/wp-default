	<footer class="site-footer">
		<nav class="site-nav footer-nav">
			<?php
			$args = array(
				'theme_location' => 'footer'
			);


			?>
			<?php wp_nav_menu( $args ); ?>
		</nav>
		<p><?php bloginfo('name');?> - &copy; <?php echo date('Y');?></p>
	</footer>
</div>
<!--div.container-->
<?php wp_footer();?>


</body>
</html>
