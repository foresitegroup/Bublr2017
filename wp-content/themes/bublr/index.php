<?php
if (is_single()) :
  the_post();
  $BlogInc = '
  <meta property="og:title" content="'.get_the_title().'" />
  <meta property="og:image" content="'.wp_get_attachment_url(get_post_thumbnail_id()).'" />
  <meta property="og:url" content="'.get_permalink().'" />
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="'.get_the_title().'">
  <meta name="twitter:description" content="'.get_the_excerpt().'">
  <meta name="twitter:image" content="'.wp_get_attachment_url(get_post_thumbnail_id()).'">
  ';
endif;

get_header();

if (!is_single()) :
  while ( have_posts() ) : the_post();
    ?>

    <div class="first-post" style="background-image: url(<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>);">
      <div class="site-width">
        <h3>
        <?php
        echo get_the_date('F j, Y') . " &bullet; ";

        echo strip_tags(get_the_category_list(', '));
        ?>
        </h3>
        
        <?php
        the_title('<h1>', '</h1>');

        echo get_the_excerpt();
        ?>

        <br><a href="<?php echo get_permalink(); ?>" class="button">READ STORY</a>
      </div>
    </div>

    <?php
    break;
  endwhile;
  ?>

  <div class="site-width index-cats">
    <form action="<?php echo esc_url(home_url('/')); ?>" method="GET" class="cat-form">
      EXPLORE: 
      <div class="select">
        <?php
        $select = wp_dropdown_categories(array('show_option_all' => 'All Categories', 'orderby' => 'name', 'echo' => 0));
        $replace = "<select$1 onchange='return this.form.submit()'>";
        $select  = preg_replace('#<select([^>]*)>#', $replace, $select);
        echo $select;
        ?>
      </div>
    </form>

    <form action="<?php echo esc_url(home_url('/')); ?>"  method="GET" class="search-form">
      <input type="text" class="search-field" placeholder="SEARCH BLOG" value="<?php echo get_search_query(); ?>" name="s">
      <button type="submit" class="search-submit"><i class="fg fg-search"></i></button>
    </form>
  </div>

  <div class="blog-index">
    <div class="site-width">

      <?php
      /* Prep the variables for equal height boxes */
      $counter = 1;
      $iteration = 1;
      $EqualHeightsjQuery = "";

      /* Start the Loop */
      while ( have_posts() ) : the_post();
        
        /* Add the special classes to the boxes that the jQuery needs for equal heights */
        $EqualHeights = "";
        if (($counter == 1) || ($counter == 2)) $EqualHeights = "half" . $iteration;
        if (($counter == 3) || ($counter == 4) || ($counter == 5)) $EqualHeights = "triple1" . $iteration;
        if (($counter == 7) || ($counter == 8) || ($counter == 9)) $EqualHeights = "triple2" . $iteration;
        if (($counter == 4) || ($counter == 8)) $EqualHeights .= " triplemid";
        
        /* ...and set up the jQuery for equal heights */
        if ($counter == 1) {
          $EqualHeightsjQuery .= "var highestBox = 0;
          jQuery(this).find('.half" . $iteration . "').each(function(){
            if(jQuery(this).height() > highestBox) highestBox = jQuery(this).height();
          })
          jQuery(this).find('.half" . $iteration . "').height(highestBox);\n";
        }
        if ($counter == 3) {
          $EqualHeightsjQuery .= "var highestBox = 0;
          jQuery(this).find('.triple1" . $iteration . "').each(function(){
            if(jQuery(this).height() > highestBox) highestBox = jQuery(this).height();
          })
          jQuery(this).find('.triple1" . $iteration . "').height(highestBox);\n";
        }
        if ($counter == 7) {
          $EqualHeightsjQuery .= "var highestBox = 0;
          jQuery(this).find('.triple2" . $iteration . "').each(function(){
            if(jQuery(this).height() > highestBox) highestBox = jQuery(this).height();
          })
          jQuery(this).find('.triple2" . $iteration . "').height(highestBox);\n";
        }
        
        /* Finally display the content */
        get_template_part( 'content', get_post_format() );
        
        /* Increase the counters as needed */
        $counter++;
        if ($counter == 10) { $counter = 1; $iteration++; }

      endwhile;
      ?>

      <script type="text/javascript">
        jQuery(window).on("load resize",function(){
          jQuery('.blog-index .site-width').each(function(){
            <?php echo $EqualHeightsjQuery; ?>
          });
        });

        jQuery(window).on("load",function(){
          jQuery(".index-post").hide();
          jQuery(".index-post").slice(0, 9).show();

          // Don't show button if fewer than max number of posts
          if (jQuery(".index-post:hidden").length == 0) jQuery("#loadmore").fadeOut('fast');

          jQuery("#loadmore").on('click', function (e) {
            e.preventDefault();
            jQuery(".index-post:hidden").slice(0, 9).slideDown();

            // Remove button when we get to the end of the posts
            if (jQuery(".index-post:hidden").length == 0) jQuery("#loadmore").fadeOut('slow');
          });
        });
      </script>

      <div class="loadmore">
        <a href="#" id="loadmore" class="button">LOAD MORE</a>
      </div>

    </div>
  </div>

<?php else : ?>
  <div class="blog-single">
    <?php get_template_part( 'content', get_post_format() ); ?>
  </div>
<?php endif; ?>

<?php $footer = get_posts(array('name' => 'explore-footer', 'post_type' => 'page')); ?>
<div id="page-footer" style="background-image: url(<?php echo wp_get_attachment_url(get_post_thumbnail_id($footer[0]->ID)); ?>);">
  <div class="site-width blog-footer">
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
    ?>
    <div class="icon"><canvas id="<?php echo $cc['icon']; ?>"></canvas></div>
    <h3><?php echo round($cc['temperature']); ?>&deg; <?php echo $cc['summary']; ?></h3>

    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/inc/skycons.js"></script>
    <script>
      var icons = new Skycons({"color": "white"}),
      list  = ["clear-day", "clear-night", "partly-cloudy-day", "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind", "fog" ], i;
      for(i = list.length; i--;) icons.set(list[i], list[i]);
      icons.play();
    </script>

    <?php echo do_shortcode('[insert page="'.$footer[0]->ID.'" display="content"]'); ?>
  </div>
</div>

<?php get_footer(); ?>