<?php
// the query
$the_query = new WP_Query('page_id=' . get_custom_option('site_featured_header_post_id'));

if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
	<!-- pagination here -->
	<section id="widget_campaignify_campaign_feature-2"
			 class="campaign-widget widget_campaignify_campaign_feature arrowed">
		<div class="container campaign-feature alignleft">
			<div class="campaign-feature-image">
				<?php echo get_the_post_thumbnail(get_the_ID(),'full'); ?>
			</div>
			<div class="campaign-feature-content">
				<h3><?php the_title(); ?></h3>
				<?php the_content(); ?>
				<p>
					<a href="#widget_campaignify_hero_contribute-2">
						<img src="<?php echo get_custom_option('site_featured_header_button_image'); ?>" alt="saveachristmas-website-getstarted" width="579" height="185" style"width:="" 100%;="" height:="" auto;"="">
					</a>
				</p>
			</div>
		</div>
	</section>
    <!-- end of the loop -->
	<?php endwhile; ?>
	<!-- pagination here -->
	<?php wp_reset_postdata(); ?>
<?php else : ?>
<?php endif; ?>