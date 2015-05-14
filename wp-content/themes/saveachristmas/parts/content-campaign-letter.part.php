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

$myCampaigns->the_post();
?>
	<?php 
	$campaign_options = get_post_meta(get_the_ID(), 'campaign_options', true);
	$fully_booked = $campaign_options['is_fully_booked'];
	if( $fully_booked == 1) {
		echo '<h1 style="color:red;">The Campign Is Fully Booked This Year! No More Pledges Will Be Accepted, Sorry! Please Check Back Next Year!</h1>';
	}

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