<?php
/* Template Name: About*/

get_header();

$header = get_posts(array('name' => 'about-header', 'post_type' => 'page'));
?>

<div id="page-header" class="about-header">
  <div class="image" style="background-image: url(<?php echo wp_get_attachment_url(get_post_thumbnail_id($header[0]->ID)); ?>);"></div>

  <div class="site-width">
    <div class="text">
      <?php the_title('<h1>', '</h1>'); echo do_shortcode('[insert page="'.$header[0]->ID.'" display="content"]'); ?>
    </div>
  </div>
</div>

<div id="about-postheader">
  <div class="site-width">
    <?php echo do_shortcode('[insert page="about-postheader" display="content"]'); ?>
  </div>
</div>

<script type="text/javascript">
  jQuery(document).ready(function(){
    jQuery("dd").hide();

    jQuery("dl dt").click(function(){
      jQuery(this).next('dd').slideToggle();
      return false;
    });
  });
</script>

<div id="about-content">
  <div class="site-width">
    <?php
    while ( have_posts() ) : the_post();
      the_content();
    endwhile;
    ?>
  </div>
</div>

<div class="tabs">
  <?php
  $tab1 = get_posts(array('name' => 'tab-who-wins', 'post_type' => 'page'));
  $tab2 = get_posts(array('name' => 'tab-local-business', 'post_type' => 'page'));
  $tab3 = get_posts(array('name' => 'tab-individuals', 'post_type' => 'page'));
  $tab4 = get_posts(array('name' => 'tab-community', 'post_type' => 'page'));
  ?>
  <input id="tab1" type="radio" name="tabs" checked>
  <label for="tab1"><?php echo do_shortcode('[insert page="'.$tab1[0]->ID.'" display="title"]'); ?></label>
  <input id="tab2" type="radio" name="tabs">
  <label for="tab2"><?php echo do_shortcode('[insert page="'.$tab2[0]->ID.'" display="title"]'); ?></label>
  <input id="tab3" type="radio" name="tabs">
  <label for="tab3"><?php echo do_shortcode('[insert page="'.$tab3[0]->ID.'" display="title"]'); ?></label>
  <input id="tab4" type="radio" name="tabs">
  <label for="tab4"><?php echo do_shortcode('[insert page="'.$tab4[0]->ID.'" display="title"]'); ?></label>

  <div id="tab-content1" class="tab-content">
    <div class="site-width">
      <div class="text">
        <?php echo do_shortcode('[insert page="'.$tab1[0]->ID.'" display="content"]'); ?>
      </div>
    </div>

    <div class="image" style="background-image: url(<?php echo wp_get_attachment_url(get_post_thumbnail_id($tab1[0]->ID)); ?>);"></div>
  </div>

  <div id="tab-content2" class="tab-content">
    <div class="site-width">
      <div class="text">
        <?php echo do_shortcode('[insert page="'.$tab2[0]->ID.'" display="content"]'); ?>
      </div>
    </div>

    <div class="image" style="background-image: url(<?php echo wp_get_attachment_url(get_post_thumbnail_id($tab2[0]->ID)); ?>);"></div>
  </div>

  <div id="tab-content3" class="tab-content">
    <div class="site-width">
      <div class="text">
        <?php echo do_shortcode('[insert page="'.$tab3[0]->ID.'" display="content"]'); ?>
      </div>
    </div>

    <div class="image" style="background-image: url(<?php echo wp_get_attachment_url(get_post_thumbnail_id($tab3[0]->ID)); ?>);"></div>
  </div>

  <div id="tab-content4" class="tab-content">
    <div class="site-width">
      <div class="text">
        <?php echo do_shortcode('[insert page="'.$tab4[0]->ID.'" display="content"]'); ?>
      </div>
    </div>

    <div class="image" style="background-image: url(<?php echo wp_get_attachment_url(get_post_thumbnail_id($tab4[0]->ID)); ?>);"></div>
  </div>
</div>

<div id="about-prefooter">
  <div class="site-width">
    <?php echo do_shortcode('[insert page="about-prefooter" display="content"]'); ?>
  </div>
</div>

<?php $footer = get_posts(array('name' => 'about-footer', 'post_type' => 'page')); ?>
<div id="page-footer" class="about-footer" style="background-image: url(<?php echo wp_get_attachment_url(get_post_thumbnail_id($footer[0]->ID)); ?>);">
  <div class="site-width">
    <?php echo do_shortcode('[insert page="'.$footer[0]->ID.'" display="content"]'); ?>
  </div>
</div>

<?php get_footer(); ?>