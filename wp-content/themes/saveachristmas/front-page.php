<?php get_header(); ?>

	<div id="main" class="site-main">
		<div id="primary" class="content-area">
			<div id="content" class="campaign-content" role="main">
				<?php
				get_template_part('parts/content','featured-header.part');
				?>

				<section id="widget_campaignify_hero_contribute-2" class="campaign-widget widget_campaignify_hero_contribute arrowed">
						<?php get_template_part('parts/content', 'hero-campaign.part'); ?>
				</section>
				<section id="widget_campaignify_campaign_pledge_levels-2"
						 class="campaign-widget widget_campaignify_campaign_pledge_levels arrowed">

							<?php get_template_part('parts/content', 'pledges.part');?>
				</section>
				<section class="campaign-widget widget_campaignify_campaign_content arrowed">
					<div class="container">
						<?php
						get_template_part('parts/content', 'campaign-letter.part');
						?>
					</div>
				</section>

			</div>
			<!-- #content -->
		</div>
		<!-- #primary -->


	</div><!-- #main -->

<?php get_footer(); ?>