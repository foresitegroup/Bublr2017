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

  <script type="text/javascript">
    jQuery(document).ready(function() {
      jQuery('.modal-open').click(function(e){
        if (jQuery(window).width() > 700) {
          e.preventDefault();

          jQuery('.modal').removeClass('show');

          var href = jQuery(this).attr('href');
          var parts = href.split("/");
          var slug = parts[parts.length-1] !== '' ? parts[parts.length-1] : parts[parts.length-2];

          if (jQuery('#'+slug).height() > jQuery(window).height()) {
            jQuery('#modal-wrap').addClass('tall');
            jQuery('#'+slug).addClass('tall');
          }

          jQuery('#'+slug).addClass('show');
        }
      });

      jQuery('.modal-close').click(function(e){
        e.preventDefault();
        var href = jQuery(this).attr('href');
        jQuery(href).removeClass('show tall');
        jQuery('#modal-wrap').removeClass('tall');
      });
    });

    jQuery(window).on("load resize",function(){
      if(jQuery('#annual-pass .modal-right').height() > jQuery('#annual-pass .modal-left').height()) jQuery('#annual-pass .modal-left').css({"height": jQuery('#annual-pass .modal-right').height()-35, "padding-bottom": "0"});
      
      if(jQuery('#monthly-pass .modal-right').height() > jQuery('#monthly-pass .modal-left').height()) jQuery('#monthly-pass .modal-left').css({"height": jQuery('#monthly-pass .modal-right').height()-35, "padding-bottom": "0"});

      if(jQuery('#pay-as-you-go .modal-right').height() > jQuery('#pay-as-you-go .modal-left').height()) jQuery('#pay-as-you-go .modal-left').css({"height": jQuery('#pay-as-you-go .modal-right').height()-35, "padding-bottom": "0"});
    });
  </script>

  <div id="modal-wrap">
    <div class="modal" id="annual-pass">
      <div class="modal-menu">
        <div class="site-width">
          <a href="#annual-pass" class="button modal-close"><i class="fg fg-arrow"></i> BACK</a>

          <a href="https://bublrbikes.bcycle.com/join-now" class="button pass">PURCHASE PASS</a>
        </div>
      </div>

      <?php echo do_shortcode('[insert page="annual-pass" display="content"]'); ?>
    </div>

    <div class="modal" id="monthly-pass">
      <div class="modal-menu">
        <div class="site-width">
          <a href="#monthly-pass" class="button modal-close"><i class="fg fg-arrow"></i> BACK</a>

          <a href="https://bublrbikes.bcycle.com/join-now" class="button pass">PURCHASE PASS</a>
        </div>
      </div>

      <?php echo do_shortcode('[insert page="monthly-pass" display="content"]'); ?>
    </div>

    <div class="modal" id="pay-as-you-go">
      <div class="modal-menu">
        <div class="site-width">
          <a href="#pay-as-you-go" class="button modal-close"><i class="fg fg-arrow"></i> BACK</a>

          <a href="https://bublrbikes.bcycle.com/join-now" class="button pass">PURCHASE PASS</a>
        </div>
      </div>

      <?php echo do_shortcode('[insert page="pay-as-you-go" display="content"]'); ?>
    </div>
  </div>

  <div id="home-pricing">
    <div class="background-text">GREATER<br>MILWAUKEE'S<br>NONPROFIT<br>BIKE<br>SHARE</div>

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

  <div id="how">
    <div class="site-width">
      <?php echo do_shortcode('[insert page="home-page-how-it-works" display="content"]'); ?>
    </div>
  </div>

  <div id="explore" class="cf">
    <div class="main">
      <div class="background-text">COMMUNITY DRIVEN</div>

      <div class="header content-width">
        EXPLORE<br>BY BUBLR
        <a href="explore" class="arrow">EXPLORE ALL</a>
      </div>

      <?php
      $main_post = get_posts(array('posts_per_page' => 1));
      foreach ($main_post as $post) : setup_postdata($post);
      ?>
        <div id="latest-post" style="background-image: url(<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>);">
          <div class="content-width">
            <div class="date">
              <i class="fg fg-clock"></i>
              <?php the_date(); ?>
              &bull;
              <?php
              foreach (get_the_category() as $category) $cat_names[] = $category->name;
              echo implode(', ', $cat_names);
              unset($cat_names);
              ?>
            </div>

            <?php the_title('<h3>', '</h3>'); ?>

            <?php
            $split = preg_split('/(\.|\!|\?)/', strip_tags(get_the_content()), 3, PREG_SPLIT_DELIM_CAPTURE);
            echo implode('', array_slice($split, 0, 4));
            ?><br>

            <a href="<?php the_permalink(); ?>" class="button">READ STORY</a>
          </div>
        </div>
      <?php
      endforeach;
      wp_reset_postdata();
      ?>

      <?php
      $two_posts = get_posts(array('posts_per_page' => 2, 'offset' => 1 ));
      foreach ($two_posts as $post) : setup_postdata($post);
      ?>
        <div class="two-posts">
          <div class="image" style="background-image: url(<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>);"></div>

          <div class="date">
            <i class="fg fg-clock"></i>
            <?php the_date(); ?>
            &bull;
            <?php
            foreach (get_the_category() as $category) $cat_names[] = $category->name;
            echo implode(', ', $cat_names);
            unset($cat_names);
            ?>
          </div>

          <?php the_title('<h3>', '</h3>'); ?>

          <?php
          $split = preg_split('/(\.|\!|\?)/', strip_tags(get_the_content()), 3, PREG_SPLIT_DELIM_CAPTURE);
            echo implode('', array_slice($split, 0, 4));
          ?><br>

          <a href="<?php the_permalink(); ?>" class="button">READ STORY</a>
        </div>
      <?php
      endforeach;
      wp_reset_postdata();
      ?>

      <div style="clear: both;"></div>

      <?php
      $fourth_post = get_posts(array('posts_per_page' => 1, 'offset' => 3 ));
      foreach ($fourth_post as $post) : setup_postdata($post);
        $fourth_post_date = get_the_date();

        foreach (get_the_category() as $category) $cat_names[] = $category->name;
        $fourth_post_cat = implode(', ', $cat_names);
        unset($cat_names);

        $fourth_post_title = get_the_title();

        $split = preg_split('/(\.|\!|\?)/', strip_tags(get_the_content()), 3, PREG_SPLIT_DELIM_CAPTURE);
        $fourth_post_excerpt = implode('', array_slice($split, 0, 4));

        $fourth_post_link = get_the_permalink();
      endforeach;
      wp_reset_postdata();
      ?>

      <div class="fourth-post">
        <div class="date">
          <i class="fg fg-clock"></i>
          <?php echo $fourth_post_date; ?>
          &bull;
          <?php echo $fourth_post_cat; ?>
        </div>

        <h3><?php echo $fourth_post_title; ?></h3>

        <?php echo $fourth_post_excerpt; ?><br>

        <a href="<?php echo $fourth_post_link; ?>" class="button">READ STORY</a>
      </div>
    </div>

    <div class="sidebar">
      <div class="all">
        <a href="explore" class="arrow">EXPLORE ALL</a>
      </div>

      <div class="sidebar-shadow">
        <div id="weather">
          <h5>MILWAUKEE</h5>

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
          <?php echo $hc['summary']; ?><br>
          <br>

          <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/inc/skycons.js"></script>
          <script>
            var icons = new Skycons({"color": "white"}),
            list  = ["clear-day", "clear-night", "partly-cloudy-day", "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind", "fog" ], i;
            for(i = list.length; i--;) icons.set(list[i], list[i]);
            icons.play();
          </script>

          <a href="https://darksky.net/poweredby/">Powered by Dark Sky</a>
        </div> <!-- END #weather -->

        <?php $quote = get_posts(array('name' => 'home-page-quote', 'post_type' => 'page')); ?>
        <div id="home-quote">
          <div class="image" style="background-image: url(<?php echo wp_get_attachment_url(get_post_thumbnail_id($quote[0]->ID)); ?>);"></div>

          <div class="text">
            <?php echo do_shortcode('[insert page="'.$quote[0]->ID.'" display="content"]'); ?>
          </div>
        </div>

        <div class="fourth-post">
          <div class="date">
            <i class="fg fg-clock"></i>
            <?php echo $fourth_post_date; ?>
            &bull;
            <?php echo $fourth_post_cat; ?>
          </div>

          <h3><?php echo $fourth_post_title; ?></h3>

          <?php echo $fourth_post_excerpt; ?><br>

          <a href="<?php echo $fourth_post_link; ?>" class="button">READ STORY</a>
        </div>

      </div> <!-- END .sidebar-shadow -->
    </div> <!-- END .sidebar -->
  </div>

  <div id="burning">
    <div>
      <i class="fg fg-biker"></i>

      <div id="carbon-trigger">
        BURNING CALORIES, NOT CARBON.<br>
        OFFSET TO DATE <?php echo get_theme_mod('bublr_carbon_year'); ?>:
      </div>

      <div id="carbon"><noscript><?php echo number_format(get_theme_mod('bublr_carbon_pounds')); ?> LBS</noscript></div>
    </div>
  </div>

  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/inc/countUp.min.js"></script>
  <script type="text/javascript">
    jQuery(document).ready(function() {
      jQuery("#carbon-trigger").waypoint(function() {
        Carbon.start();
      },{offset: 'bottom-in-view'});
    });

    var Carbon = new CountUp("carbon", 0, <?php echo get_theme_mod('bublr_carbon_pounds'); ?>, 0, 2, { suffix: ' LBS' });
  </script>

  <?php
endwhile;

get_footer();
?>