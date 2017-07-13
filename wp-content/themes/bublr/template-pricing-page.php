<?php
/* Template Name: Pricing */

get_header();

$header = get_posts(array('name' => 'pricing-header', 'post_type' => 'page'));
?>

<div id="pricing-header">
  <div class="image" style="background-image: url(<?php echo wp_get_attachment_url(get_post_thumbnail_id($header[0]->ID)); ?>);"></div>

  <div class="site-width">
    <div class="text">
      <?php the_title('<h1>', '</h1>'); echo do_shortcode('[insert page="'.$header[0]->ID.'" display="content"]'); ?>
    </div>
  </div>
</div>

<script type="text/javascript">
  jQuery(document).ready(function(){
    jQuery('#pricing-content').each(function(){
      var highestBox = 0;

      jQuery(this).find('.pricing').each(function(){
        if(jQuery(this).height() > highestBox) highestBox = jQuery(this).height();
      })

      jQuery(this).find('.pricing').height(highestBox);
    });
  });
</script>

<div id="pricing-content">
  <div class="site-width">
    <?php
    // while ( have_posts() ) : the_post();
    //   the_content();
    // endwhile;
    ?>

    <div class="pricing">
      <h2>ANNUAL PASS</h2>

      <h3>80<span>/ year</span></h3>

      <a href="https://bublrbikes.bcycle.com/join-now" class="button">PURCHASE</a>

      <h4>Unlimited 60-minute rides</h4>

      <div class="additional">
        <h5>ADDITIONAL COSTS</h5>
        $3 every additional 30 minutes
      </div>

      <img src="<?php echo get_template_directory_uri(); ?>/images/fob.png" alt="">

      You'll receive a Bublr Fob
      <hr>
      Good for 365 days of Bublr
      <hr>
      Annual Pass valid in other <a href="https://www.bcycle.com/top-nav-bar/bconnected">cities</a>
      <hr>
      Billed annually
    </div>

    <div class="pricing">
      <h2>MONTHLY PASS</h2>

      <h3>15<span>/ month</span></h3>

      <a href="https://bublrbikes.bcycle.com/join-now" class="button">PURCHASE</a>

      <h4>Unlimited 60-minute rides</h4>

      <div class="additional">
        <h5>ADDITIONAL COSTS</h5>
        $3 every additional 30 minutes
      </div>

      <img src="<?php echo get_template_directory_uri(); ?>/images/fob.png" alt="">

      You'll receive a Bublr Fob
      <hr>
      Good for 30 days of Bublr
      <hr>
      $15/mo reoccurring charge. If you'd only like you use for a month of two, you are able to turn off charges.
    </div>

    <div class="pricing">
      <h2>PAY AS YOU GO</h2>

      <h3>2<span>/ Every 30 Minutes</span></h3>

      <a href="https://bublrbikes.bcycle.com/join-now" class="button">PURCHASE</a>

      <h4>30 Minute Ride</h4>

      <div class="additional">
        <h5>ADDITIONAL COSTS</h5>
        $2 One Time Charge <strong>THEN</strong> $2 every 30 minutes
      </div>

      <img src="<?php echo get_template_directory_uri(); ?>/images/fob.png" alt="">

      You'll receive a Bublr Fob
      <hr>
      Check out a bike at any station
      <hr>
      Trips are billed monthly
    </div>

    <div class="pricing single">
      <h2>SINGLE RIDE</h2>

      <h3>3<span>/ Every 30 Minutes</span></h3>

      <a href="https://bublrbikes.bcycle.com/station-locations" class="button">FIND A STATION</a>

      <h4>30 Minute Ride</h4>

      <div class="additional">
        <h5>ADDITIONAL COSTS</h5>
        $3 every 30 minutes
      </div>

      <img src="<?php echo get_template_directory_uri(); ?>/images/fob.png" alt="">

      Good for single ride
      <hr>
      Pay at any station
      <hr>
      You'll need a credit card
    </div>
  </div>
</div>

<?php get_footer(); ?>