<?php
if ($_SERVER['QUERY_STRING'] == "cat=0") header("Location: " . home_url('/explore'));
global $BlogInc;
?>
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

  <meta name="viewport" content="width=device-width">
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
      jQuery("a[href^='http']").not("[href*='" + window.location.host + "']").prop('target','new');
      jQuery("a[href$='.pdf']").prop('target', 'new');

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

  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-50523100-1', 'bublrbikes.com');
    ga('send', 'pageview');
  </script>
</head>

<body>

<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 801647568;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/801647568/?guid=ON&amp;script=0"/>
</div>
</noscript>

<div id="shove"> <!-- For mobile menu -->

<div id="header">
  <input type="checkbox" id="show-menu-top" role="button">
  <label for="show-menu-top" id="menu-toggle-top"><span>MENU</span></label>
  <div class="top-bar">
    <?wp_nav_menu( array( 'theme_location' => 'top-menu', 'container_class' => 'top-menu' ) ); ?>

    <div class="site-width">
      <div class="social">
        <?php if (get_theme_mod('bublr_twitter') != "") echo '<a href="' . get_theme_mod('bublr_twitter') . '" class="twitter" aria-label="Twitter"></a>'; ?>
        <?php if (get_theme_mod('bublr_facebook') != "") echo '<a href="' . get_theme_mod('bublr_facebook') . '" class="facebook" aria-label="Facebook"></a>'; ?>
        <?php if (get_theme_mod('bublr_instagram') != "") echo '<a href="' . get_theme_mod('bublr_instagram') . '" class="instagram" aria-label="Instagram"></a>'; ?>
        <?php if (get_theme_mod('bublr_youtube') != "") echo '<a href="' . get_theme_mod('bublr_youtube') . '" class="youtube" aria-label="YouTube"></a>'; ?>
        <?php if (get_theme_mod('bublr_linkedin') != "") echo '<a href="' . get_theme_mod('bublr_linkedin') . '" class="linkedin" aria-label="LinkedIn"></a>'; ?>
      </div>
    </div>
  </div>

  <div class="site-width">
    <a href="<?php echo home_url(); ?>" id="logo" aria-label="Bublr Bikes"></a>

    <?wp_nav_menu( array( 'theme_location' => 'main-menu', 'container_class' => 'main-menu' ) ); ?>

    <a href="https://bublrbikes.bcycle.com/login" class="button">Account Login</a>

    <div class="mobile">
      <a href="#mobile-menu" id="menu-toggle" aria-label="Menu"></a>
    </div>
  </div>
</div>
