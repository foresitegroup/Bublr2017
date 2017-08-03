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

<div class="tabs">
  <?php
  $tab1 = get_posts(array('name' => 'tab-volunteer', 'post_type' => 'page'));
  $tab2 = get_posts(array('name' => 'tab-events', 'post_type' => 'page'));
  $tab3 = get_posts(array('name' => 'tab-promotions', 'post_type' => 'page'));
  $tab4 = get_posts(array('name' => 'tab-team-pass-program', 'post_type' => 'page'));
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

<div id="get-involved-prefooter">
  <div class="site-width">
    <?php echo do_shortcode('[insert page="get-involved-prefooter" display="content"]'); ?>
  </div>
</div>

<?php $footer = get_posts(array('name' => 'get-involved-footer', 'post_type' => 'page')); ?>
<div id="page-footer" class="get-involved-footer" style="background-image: url(<?php echo wp_get_attachment_url(get_post_thumbnail_id($footer[0]->ID)); ?>);">
  <div class="site-width">
    <?php echo do_shortcode('[insert page="'.$footer[0]->ID.'" display="content"]'); ?>
  </div>
</div>

<?php get_footer(); ?>