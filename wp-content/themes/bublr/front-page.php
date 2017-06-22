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
  
  <?php $map = get_posts(array('name' => 'home-page-map', 'post_type' => 'page')); ?>
  <div id="home-map" style="background-image: url(<?php echo wp_get_attachment_url(get_post_thumbnail_id($map[0]->ID)); ?>);">
    <div class="site-width">
      <div id="map-left">
        <?php echo do_shortcode('[insert page="'.$map[0]->ID.'" display="content"]'); ?>
      </div>
    </div>
  </div>

  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/inc/swipebox/swipebox.css">
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/inc/swipebox/jquery.swipebox.min.js"></script>
  <script type="text/javascript">
    jQuery(document).ready(function() {
      jQuery(".video").swipebox({autoplayVideos: true});
    });
  </script>

  <div id="how">
    <div class="site-width">
      <?php echo do_shortcode('[insert page="how-it-works" display="content"]'); ?>
    </div>
  </div>

  <div id="explore" class="cf">
    <div class="main">
      <div class="header">
        EXPLORE BY BUBLR
      </div>

      MAIN SECTION
    </div>

    <div class="sidebar">
      <div class="all">
        <a href="#" class="arrow">EXPLORE ALL</a>
      </div>

      <div id="weather">
        <?php
        if (strtotime('-5 minutes') > filemtime('darksky.json')) {
          include_once "inc/fintoozler.php";
          $json = file_get_contents('https://api.darksky.net/forecast/' . $dsapi . '/43.0389,-87.9065?exclude=minutely,daily,alerts,flags', false, stream_context_create(array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false))));
          file_put_contents('darksky.json',$json);
        } else {
          $json = file_get_contents('darksky.json');
        }

        $obj = json_decode($json, true);
        $cc = $obj['currently'];
        $hc = $obj['hourly'];
        ?>
        
        <div class="icon"><canvas id="<?php echo $cc['icon']; ?>"></canvas></div>
        <h3><?php echo round($cc['temperature']); ?>&deg;</h3><br>
        <h4><?php echo $cc['summary']; ?></h4>
        <?php echo $hc['summary']; ?>

        <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/inc/skycons.js"></script>
        <script>
          var icons = new Skycons({"color": "white"}),
          list  = ["clear-day", "clear-night", "partly-cloudy-day", "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind", "fog" ], i;
          for(i = list.length; i--;) icons.set(list[i], list[i]);
          icons.play();
        </script>
      </div>
    </div>
  </div>

  <?php
endwhile;

get_footer();
?>