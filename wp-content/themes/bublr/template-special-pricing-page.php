<?php
/* Template Name: Special Pricing */

get_header();
?>

<div id="special-pricing-content">
  <div class="site-width">
    <?php
    while ( have_posts() ) : the_post();
      the_title('<h1>', '</h1>');

      the_content();
    endwhile;
    ?>
  </div>
</div>

<?php $footer = get_posts(array('name' => 'faq-footer', 'post_type' => 'page')); ?>
<div id="page-footer" style="background-image: url(<?php echo wp_get_attachment_url(get_post_thumbnail_id($footer[0]->ID)); ?>);">
  <div class="site-width">
    <?php echo do_shortcode('[insert page="'.$footer[0]->ID.'" display="content"]'); ?>
  </div>
</div>

<?php get_footer(); ?>