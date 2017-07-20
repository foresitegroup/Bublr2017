<?php
global $EqualHeights;

if (!is_single()) :
  /* ALL THE OTHER PAST POSTS BESIDES THE HERO */
  ?>
  <a href="<?php echo get_permalink(); ?>" class="index-post <?php echo $EqualHeights; ?>">
    <div class="index-post-image" style="<?php echo (wp_get_attachment_url(get_post_thumbnail_id()) != "") ? "background-image: url(" . wp_get_attachment_url(get_post_thumbnail_id()) . ")" : "padding-top: 0; margin-bottom: 0;"; ?>"></div>
    
    <div class="index-post-text">
      <h3>
      <?php
      echo get_the_date('F j, Y') . " &bullet; ";

      echo strip_tags(get_the_category_list(', '));
      ?>
      </h3>

      <?php the_title('<h2>', '</h2>'); ?>

      <?php echo get_the_excerpt(); ?>
    </div>
    
    <div class="index-post-hover">READ MORE</div>
  </a>
  <?php
else :
  /* A SINGLE POST */
  ?>
  <div class="first-post" style="background-image: url(<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>);">
    <div class="site-width">
      <h3>
      <?php
      echo get_the_date('F j, Y') . " &bullet; ";

      echo strip_tags(get_the_category_list(', '));
      ?>
      </h3>
      
      <?php
      the_title('<h1>', '</h1>');
      ?>
    </div>
  </div>

  <div class="site-width single-post">
    <?php the_content(); ?>

    <div class="single-post-share">
      <a href="http://www.facebook.com/sharer.php?u=<?php echo get_permalink(); ?>&picture=<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" target="new" class="facebook"><i class="fg fg-facebook" aria-hidden="true"></i> <span>Share on Facebook</span></a>

      <a href="http://www.twitter.com/share?url=<?php echo get_permalink(); ?>&text=<?php echo str_replace(' ', '+', the_title('','',false)); ?>" target="new" class="twitter"><i class="fg fg-twitter" aria-hidden="true"></i> <span>Share on Twitter</span></a>

      <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_permalink(); ?>&title=<?php echo str_replace(' ', '%20', the_title('','',false)); ?>" target="new" class="linkedin"><i class="fg fg-linkedin" aria-hidden="true"></i></a>

      <a href="http://pinterest.com/pin/create/link/?url=http://foresitegrp.com/news/5-phrases-you-are-probably-saying-incorrectly/&media=<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>&description=<?php echo str_replace(' ', '%20', the_title('','',false)); ?>" target="new" class="pinterest"><i class="fg fg-pinterest" aria-hidden="true"></i></a>

      <a href="http://plus.google.com/share?url=<?php echo get_permalink(); ?>" target="new" class="googleplus"><i class="fg fg-google-plus" aria-hidden="true"></i></a>
    </div>

    <div class="blog-author">
      <?php
      $author_bio_avatar_size = apply_filters( 'twentyseventeen_author_bio_avatar_size', 82 );
      echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
      ?>
      <div>
        <h5>Posted by <?php echo get_the_author(); ?></h5>
        <?php the_author_meta('description'); ?>
      </div>
    </div>
  </div>

  <div class="single-post-nav">
    <div class="site-width">
      <?php
      // Previous/next post navigation.
      $next_post = get_next_post();
      $prev_post = get_previous_post();

      FG_post_pagination(array(
        'next_text' => __($next_post->post_title),
        'prev_text' => __($prev_post->post_title)
      ));
      ?>

      <a href="<?php echo site_url(); ?>/" class="index-link"><i class="fg fg-anchor"></i></a>
    </div>
  </div>
  
  <div class="site-width rec">
    <h4>Stories You Might Like</h4>
    <?php
    $cats = wp_get_post_categories($post->ID);

    if ($cats) {
      $args = array(
        'category__in' => $cats,
        'post__not_in' => array($post->ID),
        'posts_per_page' => 3 // Number of related posts to display.
      );

      $rec_query = new wp_query($args);

      if ($rec_query->post_count > 0) {
        while($rec_query->have_posts()) {
          $rec_query->the_post();
          ?>
          <a href="<?php echo get_permalink(); ?>" class="index-post">
            <div class="index-post-image" style="<?php echo (wp_get_attachment_url(get_post_thumbnail_id()) != "") ? "background-image: url(" . wp_get_attachment_url(get_post_thumbnail_id()) . ")" : "padding-top: 0; margin-bottom: 0;"; ?>"></div>
            
            <div class="index-post-text">
              <h3>
              <?php
              echo get_the_date('F j, Y') . " &bullet; ";

              echo strip_tags(get_the_category_list(', '));
              ?>
              </h3>

              <?php the_title('<h2>', '</h2>'); ?>

              <?php echo get_the_excerpt(); ?>
            </div>
            
            <div class="index-post-hover">READ MORE</div>
          </a>
          <?php
        }
      }
    }
    ?>
    <script type="text/javascript">
      jQuery(window).on("load resize",function(){
        if (window.innerWidth > 800) {
          jQuery('.rec').each(function(){
            var highestBox = 0;
            jQuery(this).find('.index-post').each(function(){
              if(jQuery(this).height() > highestBox) highestBox = jQuery(this).height();
            })
            jQuery(this).find('.index-post').height(highestBox);
          });
        }
      });
    </script>
  </div>

<?php endif; ?>