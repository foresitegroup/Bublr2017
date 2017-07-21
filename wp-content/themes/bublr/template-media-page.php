<?php
/* Template Name: Media */

get_header();
?>

<div class="site-width media">
  <?php
  while ( have_posts() ) : the_post();
    the_title('<h1>', '</h1>');

    the_content();
  endwhile;
  ?>
</div>

<div id="media-prefooter">
  <div class="site-width">
    <?php echo do_shortcode('[insert page="media-prefooter" display="content"]'); ?>
  </div>
</div>

<?php $footer = get_posts(array('name' => 'media-footer', 'post_type' => 'page')); ?>
<div id="page-footer" style="background-image: url(<?php echo wp_get_attachment_url(get_post_thumbnail_id($footer[0]->ID)); ?>);">
  <div class="site-width">
    <?php echo do_shortcode('[insert page="'.$footer[0]->ID.'" display="content"]'); ?>
  </div>
</div>

<?php get_footer(); ?>