<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header();

while ( have_posts() ) : the_post();
  // Randomly select banner image from the page's gallry
  $images = get_children( array(
    'posts_per_page' => 1,
    'orderby'        => 'rand',
    'order' => 'ASC',
    'post_type'      => 'attachment',
    'post_mime_type' => 'image',
    'post_parent'    => get_the_ID(),
    'post_status' => 'inherit'
  ));

  foreach ( $images as $attachment_id => $attachment ) {
    $home_banner = wp_get_attachment_url( $attachment_id);
  }
  ?>

  <div id="home-banner" style="background-image: url(<?php echo $home_banner; ?>);">
    <div class="site-width">
      <?php the_content(); ?>
    </div>
  </div>

  <div id="home-pricing">
    <div class="background-text">MILWAUKEE<br>BIKE<br>SHARE</div>

    <div class="site-width">
      <div class="background-text bottom">BUBLR<br>APP</div>

      <?php echo do_shortcode('[insert page="home-page-pricing" display="content"]'); ?>

      <div class="app-links">
        <a href="https://itunes.apple.com/us/app/bcycle/id371185597"><img src="<?php echo get_template_directory_uri(); ?>/images/apple-store.png" alt="Download on the App Store"></a>
        <a href="https://play.google.com/store/apps/details?id=com.bcycle"><img src="<?php echo get_template_directory_uri(); ?>/images/google-play.png" alt="Get it on Google Play"></a>
      </div>
    </div>
  </div>

  <?php
endwhile;

get_footer();
?>