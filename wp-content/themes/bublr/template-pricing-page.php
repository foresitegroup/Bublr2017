<?php
/* Template Name: Pricing */

get_header();
?>

<?php
if ( have_posts() ) :
	while ( have_posts() ) : the_post();
    ?>
    
    <?php the_content(); ?>

    <?php
	endwhile;
else : // I'm not sure it's possible to have no posts when this page is shown, but WTH.
	get_template_part( 'template-parts/post/content', 'none' );
endif;
?>

<?php get_footer(); ?>