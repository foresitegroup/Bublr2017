<?php
/* Template Name: Pricing Modal */

get_header();
?>

<?php
if ( have_posts() ) :
	while ( have_posts() ) : the_post();
    ?>
    
    <div class="modal-page">
      <div class="modal-menu">
        <div class="site-width">
          <?php if ($post->post_name == "single-ride") { ?>
          <a href="https://bublrbikes.bcycle.com/station-locations" class="button pass">FIND A STATION</a>
          <?php } else { ?>
          <a href="https://bublrbikes.bcycle.com/join-now" class="button pass">PURCHASE PASS</a>
          <?php } ?>
        </div>
      </div>

      <?php the_content(); ?>
    </div>

    <?php
	endwhile;
else : // I'm not sure it's possible to have no posts when this page is shown, but WTH.
	get_template_part( 'template-parts/post/content', 'none' );
endif;
?>

<?php get_footer(); ?>