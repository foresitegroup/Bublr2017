<?php
// We want Featured Images on Pages and Posts
add_theme_support( 'post-thumbnails' );


// Define menus
function register_my_menus() {
  register_nav_menus(
    array(
      'top-menu' => __( 'Top Menu' ),
      'main-menu' => __( 'Main Menu' ),
      'footer-menu' => __( 'Footer Menu' )
    )
  );
}
add_action( 'init', 'register_my_menus' );


/* Customizer */
function fg_customize_register( $wp_customize ) {
  $wp_customize->remove_section('title_tagline');
  $wp_customize->remove_section('static_front_page');
  $wp_customize->remove_section('custom_css');

  /* Social Media */
  $wp_customize->add_section( 'bublr_social_media', array(
    'title'    => __( 'Social Media', 'bublr' ),
    'priority' => 110
  ));

  $wp_customize->add_setting('bublr_twitter', array('sanitize_callback' => 'sanitize_text_field'));
  $wp_customize->add_control( 'bublr_twitter', array(
    'label'   => __('Twitter', 'social'),
    'section' => 'bublr_social_media',
    'type'    => 'text'
  ));

  $wp_customize->add_setting('bublr_facebook', array('sanitize_callback' => 'sanitize_text_field'));
  $wp_customize->add_control( 'bublr_facebook', array(
    'label'   => __('Facebook', 'social'),
    'section' => 'bublr_social_media',
    'type'    => 'text'
  ));
  
  $wp_customize->add_setting('bublr_instagram', array('sanitize_callback' => 'sanitize_text_field'));
  $wp_customize->add_control( 'bublr_instagram', array(
    'label'   => __('Instagram', 'social'),
    'section' => 'bublr_social_media',
    'type'    => 'text'
  ));

  $wp_customize->add_setting('bublr_youtube', array('sanitize_callback' => 'sanitize_text_field'));
  $wp_customize->add_control( 'bublr_youtube', array(
    'label'   => __('YouTube', 'social'),
    'section' => 'bublr_social_media',
    'type'    => 'text'
  ));

  $wp_customize->add_setting('bublr_linkedin', array('sanitize_callback' => 'sanitize_text_field'));
  $wp_customize->add_control( 'bublr_linkedin', array(
    'label'   => __('LinkedIn', 'social'),
    'section' => 'bublr_social_media',
    'type'    => 'text'
  ));

  /* Carbon Offset */
  $wp_customize->add_section( 'bublr_carbon', array(
    'title'    => __( 'Carbon Offset', 'bublr' ),
    'priority' => 115
  ));

  $wp_customize->add_setting('bublr_carbon_year', array('sanitize_callback' => 'sanitize_text_field'));
  $wp_customize->add_control( 'bublr_carbon_year', array(
    'label'   => __('Year', 'carbon'),
    'section' => 'bublr_carbon',
    'type'    => 'text'
  ));

  $wp_customize->add_setting('bublr_carbon_pounds', array('sanitize_callback' => 'bublr_sanitize_num'));
  $wp_customize->add_control( 'bublr_carbon_pounds', array(
    'label'   => __('Pounds', 'carbon'),
    'section' => 'bublr_carbon',
    'type'    => 'text'
  ));
}
add_action( 'customize_register', 'fg_customize_register' );
remove_action( 'customize_register', 'shiftnav_register_customizers' );

function bublr_sanitize_num($input) {
  $input = preg_replace('/[^0-9]/s', '', $input);
  return $input;
}


// All users get text editor by default
add_filter( 'wp_default_editor', create_function( '', 'return "html";' ) );

// Don't show admin toolbar on front end
add_filter('show_admin_bar', '__return_false');


/* 
 * Change WordPress default gallery output
 * http://wpsites.org/?p=10510/
 */
add_filter('post_gallery', 'FG_post_gallery', 10, 2);
function FG_post_gallery($output, $attr) {
  global $post;

  if (isset($attr['orderby'])) {
    $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
    if (!$attr['orderby']) unset($attr['orderby']);
  }

  extract(shortcode_atts(array(
    'order' => 'ASC',
    'orderby' => 'menu_order ID',
    'id' => $post->ID,
    'itemtag' => 'dl',
    'icontag' => 'dt',
    'captiontag' => 'dd',
    'columns' => 3,
    'size' => 'thumbnail',
    'include' => '',
    'exclude' => ''
  ), $attr));

  $id = intval($id);
  if ('RAND' == $order) $orderby = 'none';

  if (!empty($include)) {
    $include = preg_replace('/[^0-9,]+/', '', $include);
    $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

    $attachments = array();
    foreach ($_attachments as $key => $val) {
      $attachments[$val->ID] = $_attachments[$key];
    }
  }

  if (empty($attachments)) return '';

  // Here's your actual output, you may customize it to your need
  $output = "<div class=\"single-post-gallery gallery-columns-" . $columns . " cf\">\n";

  // Now you loop through each attachment
  foreach ($attachments as $id => $attachment) {
    $img = wp_get_attachment_image_src($id, 'full');

    $output .= "<a href=\"" . $img[0] . "\" rel=\"sb" . $columns . "\" style=\"background-image: url(" . $img[0] . ");\"></a>\n";
  }

  $output .= "</div>\n";

  return $output;
}


add_filter('the_content', 'filter_ptags_on_images');
function filter_ptags_on_images($content){
  return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}


// Excerpt length
function wpdocs_custom_excerpt_length( $length ) {
  return 100; // Number of words
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );


// Break excerpt at sentence end
function end_with_sentence( $excerpt ) {
  $allowed_ends = array('.', '!', '?', '...');
  $number_sentences = 2;
  $excerpt_chunk = $excerpt;

  for($i = 0; $i < $number_sentences; $i++){
    $lowest_sentence_end[$i] = 100000000000000000;
    foreach($allowed_ends as $allowed_end) {
      $sentence_end = strpos( $excerpt_chunk, $allowed_end);
      if ($sentence_end !== false && $sentence_end < $lowest_sentence_end[$i]) {
        $lowest_sentence_end[$i] = $sentence_end + strlen( $allowed_end );
      }
      $sentence_end = false;
    }

    $sentences[$i] = substr( $excerpt_chunk, 0, $lowest_sentence_end[$i]);
    $excerpt_chunk = substr( $excerpt_chunk, $lowest_sentence_end[$i]);
  }

  return implode('', $sentences);
}
add_filter('get_the_excerpt', 'end_with_sentence');


// Search only posts
function SearchFilter($query) {
  if ($query->is_search) $query->set('post_type', 'post');

  return $query;
}

add_filter('pre_get_posts','SearchFilter');


// Format the single post pagination
function FG_post_pagination($args = array()) {
  $prev_link = (get_previous_post_link()) ? get_previous_post_link('%link', "Older Post") : '<a class="prev home-link" href="'.site_urL().'/">Explore</a>';
  $next_link = (get_next_post_link()) ? get_next_post_link('%link', "Newer Post") : '<a class="next home-link" href="'.site_urL().'/">Explore</a>';

  // Only add markup if there's somewhere to navigate to.
  if ( $prev_link || $next_link ) {
    echo _navigation_markup($prev_link . $next_link, ' ', ' ');
  }
}
add_filter('previous_post_link', 'post_link_attributes_prev');
add_filter('next_post_link', 'post_link_attributes_next');
function post_link_attributes_prev($output) { return str_replace('<a href=', '<a class="prev" href=', $output); }
function post_link_attributes_next($output) { return str_replace('<a href=', '<a class="next" href=', $output); }
?>