<?php
/* Template Name: Sponsorship */

get_header();
?>

<div class="site-width sponsorship">
  <?php
  while ( have_posts() ) : the_post();
    the_title('<h1>', '</h1>');

    the_content();
  endwhile;
  ?>
</div>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/inc/slick/slick.css">
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/inc/slick/slick.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/inc/slick/slick.init.sponsor-slider.js"></script>

<div id="sponsor-logos">
  <div class="site-width">
    <?php echo do_shortcode('[insert page="sponsor-logos" display="content"]'); ?>
  </div>
</div>

<?php $image = get_posts(array('name' => 'sponsorship-blue-section', 'post_type' => 'page')); ?>
<div id="sponsorship-blue-section">
  <div class="image" style="background-image: url(<?php echo wp_get_attachment_url(get_post_thumbnail_id($image[0]->ID)); ?>);"></div>

  <div class="site-width">
    <div class="text">
      <?php echo do_shortcode('[insert page="'.$image[0]->ID.'" display="content"]'); ?>
    </div>
  </div>
</div>

<div id="sponsorship-white-section">
  <div class="site-width">
    <?php echo do_shortcode('[insert page="sponsorship-white-section" display="content"]'); ?>
  </div>
</div>

<div class="site-width sponsorship-prefooter">
  <?php echo do_shortcode('[insert page="sponsorship-prefooter" display="content"]'); ?>
</div>

<?php $footer = get_posts(array('name' => 'sponsorship-footer', 'post_type' => 'page')); ?>
<div id="page-footer" class="sponsorship-footer" style="background-image: url(<?php echo wp_get_attachment_url(get_post_thumbnail_id($footer[0]->ID)); ?>);">
  <div class="site-width">
    <?php echo do_shortcode('[insert page="'.$footer[0]->ID.'" display="content"]'); ?>
  </div>
</div>

<?php get_footer(); ?>