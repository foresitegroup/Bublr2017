<?php
/* Template Name: Get Involved */

get_header();

$header = get_posts(array('name' => 'get-involved-header', 'post_type' => 'page'));
?>

<div id="page-header" class="get-involved-header">
  <div class="image" style="background-image: url(<?php echo wp_get_attachment_url(get_post_thumbnail_id($header[0]->ID)); ?>);"></div>

  <div class="site-width">
    <div class="text">
      <?php echo do_shortcode('[insert page="'.$header[0]->ID.'" display="content"]'); ?>
    </div>
  </div>
</div>

<div id="get-involved-content">
  <div class="site-width">
    <?php
    while ( have_posts() ) : the_post();
      the_content();
    endwhile;
    ?>
  </div>
</div>

<div id="get-involved-events">
  <div class="site-width">
    <?php echo do_shortcode('[insert page="events" display="title"]'); ?>
    <?php echo do_shortcode('[insert page="events" display="content"]'); ?>
  </div>
</div>

<?php $footer = get_posts(array('name' => 'get-involved-footer', 'post_type' => 'page')); ?>
<div id="page-footer" class="get-involved-footer" style="background-image: url(<?php echo wp_get_attachment_url(get_post_thumbnail_id($footer[0]->ID)); ?>);">
  <div class="site-width">
    <?php echo do_shortcode('[insert page="'.$footer[0]->ID.'" display="content"]'); ?>
  </div>
</div>

<?php get_footer(); ?>