<?php
/* Template Name: Current Sponsors */

get_header();
?>

<div class="site-width current-sponsors">
  <?php
  while ( have_posts() ) : the_post();
    the_title('<h1>', '</h1>');

    the_content();
  endwhile;
  ?>
</div>

<div id="sponsor-list">
  <div class="site-width">
    <?php echo do_shortcode('[insert page="sponsor-list" display="content"]'); ?>
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