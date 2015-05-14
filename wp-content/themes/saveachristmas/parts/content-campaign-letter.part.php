<?php
	$args = array( 
		'post_type' => 'campaigns',
		'meta_key' => 'is_active',
		'meta_value' => "1",
	);

	$myCampaigns = new WP_Query( $args );
	if( !$myCampaigns->have_posts() ) { 
		echo '<h2>There Are No Active Campaigns</h2>';
		return;
	} else {
		$campaign = $myCampaigns->posts[0];
		setup_postdata($GLOBALS['post'] =& $campaign);
	}

    // while ( $myCampaigns->have_posts() ) :
    //         $myCampaigns->the_post();
?>

        <h3 class="campaign-widget-title"><?php the_title(); ?></h3>
<!--        <h3> Start Date:-->
<!--            --><?php
//
//            if ( get_post_meta( get_the_ID(), 'campaign_options', true ) ) {
//                $values = maybe_unserialize(get_post_meta(get_the_ID(), 'campaign_options', true));
//                echo $values['start-date'];
//            }
//            ?>
<!---->
<!--        </h3>-->

        <?php the_content();?>
<?php 
// endwhile;
wp_reset_postdata(); //re-sets everything back to normal
?>