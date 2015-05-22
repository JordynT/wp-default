<?php
get_header();
?>

<section id="widget_campaignify_campaign_pledge_levels-2" class="campaign-widget widget_campaignify_campaign_pledge_levels arrowed">
    <div class="container">
        <h3 class="campaign-widget-title"><?php echo get_custom_option('pledge_options_title');?></h3>

        <div class="campaignify-pledge-boxes campaignify-pledge-boxes-4 expired">
              <?php  global $post;
                $meta = get_post_meta($post->ID,'pledge_options', true);
                $data_price = $meta['amount'];
                $limit = $meta['limit'];
                $sold = '';
                if (!$sold == '') {
                    $sold = $sold / $data_price;
                }

                $remaining = $limit - $sold;
                $percent = ($sold/$limit) * 100;

                /**
                 * if these values have hit their greatest amounts, they will be set to them.
                 */
                if($percent > 100) {
                    $percent = 100;
                }
                if($remaining < 0) {
                    $remaining = 0;
                }
                ?>
                <div class="campaignify-pledge-box <?php echo $modal_css_class; ?>" data-price="<?php echo $data_price; ?>-0">
                    <h3><?php the_title(); ?></h3>

                    <div class="donation-progress-bar">
                        <div class="donation-progress" style="width: <?php echo	 $percent; ?>%"></div>
                    </div>

                    <div class="backers">
                        <small class="limit">Limit of <?php
                            if($meta != '') {
                                echo $limit;
                            }else {
                                echo "Can't Display The Content";
                            }?>
                            &mdash;
                            <?php if($meta != '') {
                                echo $remaining;?> remaining
                            <?php
                            }else {
                                echo "Can't Display The Content";
                            }?>

                        </small>
                    </div>

                    <p><?php the_content(); ?></p>

                </div>
                <?php wp_reset_postdata(); ?>
        </div>

    </div>
</section>

<?php get_footer(); ?>