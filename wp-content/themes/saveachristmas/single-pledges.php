<?php get_header();?>

    <p><strong>Name:</strong> <?php the_title(); ?></p>

    <strong>Email:</strong><?php the_content(); ?>

    <?php  $pledge_amount = get_post_custom_values('annual_donation_pledge_amount');
            $donation_id = get_post_custom_values('annual-donation-campaign-id');
    ?>
    <strong>Pledge Amount:</strong> $<?php echo $pledge_amount[0];?>
    <strong>Campaign ID:</strong><?php echo $donation_id[0]; ?>


<?php get_footer(); ?>