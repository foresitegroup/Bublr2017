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

<script type="text/javascript">
  jQuery(document).ready(function(){
    jQuery(window).on("load resize",function(){
      jQuery('#pricing-content').each(function(){
        var highestBox = 0;

        jQuery(this).find('.pricing').each(function(){
          if(jQuery(this).height() > highestBox) highestBox = jQuery(this).height();
        })

        jQuery(this).find('.pricing').height(highestBox);
      });
    });
  });
</script>

<div id="pricing-content">
  <div class="site-width">
    <?php
    while ( have_posts() ) : the_post();
      the_content();
    endwhile;
    ?>
  </div>

  <a href="<?php echo home_url(); ?>/contact/" class="arrow">QUESTIONS? CONTACT US</a>
</div>

<div id="pricing-hacm">
  <div class="site-width">
    <?php echo do_shortcode('[insert page="hacm" display="content"]'); ?>
  </div>
</div>

<?php $footer = get_posts(array('name' => 'pricing-footer', 'post_type' => 'page')); ?>
<div id="page-footer" style="background-image: url(<?php echo wp_get_attachment_url(get_post_thumbnail_id($footer[0]->ID)); ?>);">
  <div class="site-width">
    <?php echo do_shortcode('[insert page="'.$footer[0]->ID.'" display="content"]'); ?>
  </div>
</div>

<?php get_footer(); ?>