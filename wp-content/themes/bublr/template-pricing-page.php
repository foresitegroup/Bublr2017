<?php
/* Template Name: Pricing */

get_header();

$header = get_posts(array('name' => 'pricing-header', 'post_type' => 'page'));
?>

<div id="pricing-header">
  <div class="image" style="background-image: url(<?php echo wp_get_attachment_url(get_post_thumbnail_id($header[0]->ID)); ?>);"></div>

  <div class="site-width">
    <div class="text">
      <?php the_title('<h1>', '</h1>'); echo do_shortcode('[insert page="'.$header[0]->ID.'" display="content"]'); ?>
    </div>
  </div>
</div>

<?php
while ( have_posts() ) : the_post();
  the_content();
endwhile;
?>

<?php get_footer(); ?>