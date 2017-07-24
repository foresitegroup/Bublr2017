<?php
/* Template Name: How It Works */

get_header();

$header = get_posts(array('name' => 'how-it-works-header', 'post_type' => 'page'));
?>

<div id="how-it-works-header">
  <div class="image" style="background-image: url(<?php echo wp_get_attachment_url(get_post_thumbnail_id($header[0]->ID)); ?>);"></div>

  <div class="site-width">
    <div class="text">
      <?php the_title('<h1>', '</h1>'); echo do_shortcode('[insert page="'.$header[0]->ID.'" display="content"]'); ?>
    </div>
  </div>
</div>

<div id="how" class="steps">
  <div class="site-width">
    <?php echo do_shortcode('[insert page="how-it-works-steps" display="content"]'); ?>
  </div>
</div>

<div id="how-it-works-content">
  <?php
  while ( have_posts() ) : the_post();
    the_content();
  endwhile;
  ?>
</div>

<script type="text/javascript">
  jQuery(document).ready(function(){
    jQuery('#how-it-works-content').each(function(){
      jQuery(this).find('.how-video A').each(function(){
        var href = jQuery(this).attr('href');
        var id = href.split("=");
        jQuery(this).css("background-image", "url(http://img.youtube.com/vi/"+id[1]+"/maxresdefault.jpg)");
      });
    });
  });
</script>

<div id="bike-features">
  <?php echo do_shortcode('[insert page="bike-features" display="content"]'); ?>
</div>

<div id="bike-safety">
  <div class="site-width">
    <?php echo do_shortcode('[insert page="bike-safety" display="title"]'); ?>
    <?php echo do_shortcode('[insert page="bike-safety" display="content"]'); ?>
  </div>
</div>

<div id="how-it-works-prefooter">
  <?php echo do_shortcode('[insert page="how-it-works-prefooter" display="content"]'); ?>
</div>

<?php $footer = get_posts(array('name' => 'how-it-works-footer', 'post_type' => 'page')); ?>
<div id="page-footer" style="background-image: url(<?php echo wp_get_attachment_url(get_post_thumbnail_id($footer[0]->ID)); ?>);">
  <div class="site-width">
    <?php echo do_shortcode('[insert page="'.$footer[0]->ID.'" display="content"]'); ?>
  </div>
</div>

<?php get_footer(); ?>