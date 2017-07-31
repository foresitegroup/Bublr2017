<?php
/* Template Name: Donate */

get_header();

$header = get_posts(array('name' => 'donate-header', 'post_type' => 'page'));
?>

<div id="page-header" class="donate-header">
  <div class="image" style="background-image: url(<?php echo wp_get_attachment_url(get_post_thumbnail_id($header[0]->ID)); ?>);"></div>

  <div class="site-width">
    <div class="text">
      <?php the_title('<h1>', '</h1>'); echo do_shortcode('[insert page="'.$header[0]->ID.'" display="content"]'); ?>
    </div>
  </div>
</div>

<div id="donate-content">
  <div class="site-width">
    <?php
    while ( have_posts() ) : the_post();
      the_content();
    endwhile;
    ?>
  </div>
</div>

<div id="donate-amount">
  <div class="site-width">
    <?php echo do_shortcode('[insert page="donate-amount" display="content"]'); ?>
  </div>
</div>

<div id="donate-prefooter">
  <div class="site-width">
    <?php echo do_shortcode('[insert page="donate-prefooter" display="content"]'); ?>
  </div>
</div>

<?php $footer = get_posts(array('name' => 'donate-footer', 'post_type' => 'page')); ?>
<div id="page-footer" class="donate-footer" style="background-image: url(<?php echo wp_get_attachment_url(get_post_thumbnail_id($footer[0]->ID)); ?>);">
  <div class="site-width">
    <?php echo do_shortcode('[insert page="'.$footer[0]->ID.'" display="content"]'); ?>
  </div>
</div>

<?php get_footer(); ?>