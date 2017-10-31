<?php
/* Template Name: Portal */

get_header(); ?>

<?php if ( has_post_thumbnail() ) { ?>
<div id="page-header" class="portal-header" style="background-image: url(<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>);"></div>
<?php } ?>

<div class="content-page portal-page">
	<div class="site-width">
		<?php
		while ( have_posts() ) : the_post();

			the_content();

		endwhile; // End of the loop.
		?>
	</div>
</div>

<?php get_footer(); ?>