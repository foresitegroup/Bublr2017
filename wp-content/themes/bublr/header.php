<?php global $BlogInc; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">

  <title>
    <?php
    echo get_bloginfo('name');
    if(!is_home() || !is_front_page()) wp_title('|');
    ?>
  </title>

  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <link rel="profile" href="http://gmpg.org/xfn/11">

  <?php if (isset($BlogInc)) echo $BlogInc; ?>

  <link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png">
  <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon.png">

  <?php wp_enqueue_script("jquery"); ?>
  <?php wp_head(); ?>
  
  <link href="<?php echo get_template_directory_uri(); ?>/inc/jquery.mmenu.all.css" type="text/css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/inc/icons.css?<?php echo filemtime(get_template_directory() . "/inc/icons.css"); ?>">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css?<?php echo filemtime(get_template_directory() . "/style.css"); ?>">

  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/inc/jquery.waypoints.min.js"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/inc/jquery.mmenu.all.js"></script>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/inc/swipebox/swipebox.css">
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/inc/swipebox/jquery.swipebox.min.js"></script>

  <script type="text/javascript">
    jQuery(document).ready(function() {
      jQuery("a[href^='http'], a[href$='.pdf']").not("[href*='" + window.location.host + "']").attr('target','_blank');

      jQuery("#header").waypoint(function(direction) {
        jQuery("#header").toggleClass("sticky", direction == "down");
      },{offset: -165});

      jQuery("#mobile-menu").mmenu({
        "navbar": { "add": false },
        "offCanvas": { "position": "right" },
        "extensions": ["pagedim-black"]
      });

      jQuery(".video").swipebox({autoplayVideos: true});
      jQuery(".sb, .single-post-gallery A").swipebox();
    });
  </script>
</head>

<body>
<div id="shove"> <!-- For mobile menu -->

<div id="header">
  <input type="checkbox" id="show-menu-top" role="button">
  <label for="show-menu-top" id="menu-toggle-top"></label>
  <div class="top-bar">
    <?wp_nav_menu( array( 'theme_location' => 'top-menu', 'container_class' => 'top-menu' ) ); ?>

    <div class="site-width">
      <div class="social">
        <?php if (get_theme_mod('bublr_twitter') != "") echo '<a href="' . get_theme_mod('bublr_twitter') . '" class="twitter"></a>'; ?>
        <?php if (get_theme_mod('bublr_facebook') != "") echo '<a href="' . get_theme_mod('bublr_facebook') . '" class="facebook"></a>'; ?>
        <?php if (get_theme_mod('bublr_instagram') != "") echo '<a href="' . get_theme_mod('bublr_instagram') . '" class="instagram"></a>'; ?>
        <?php if (get_theme_mod('bublr_youtube') != "") echo '<a href="' . get_theme_mod('bublr_youtube') . '" class="youtube"></a>'; ?>
        <?php if (get_theme_mod('bublr_linkedin') != "") echo '<a href="' . get_theme_mod('bublr_linkedin') . '" class="linkedin"></a>'; ?>
      </div>
    </div>
  </div>

  <div class="site-width">
    <a href="<?php echo home_url(); ?>" id="logo"></a>

    <?wp_nav_menu( array( 'theme_location' => 'main-menu', 'container_class' => 'main-menu' ) ); ?>

    <a href="https://bublrbikes.bcycle.com/login" class="button">Account Login</a>

    <div class="mobile">
      <a href="#mobile-menu" id="menu-toggle"></a>
    </div>
  </div>
</div>
