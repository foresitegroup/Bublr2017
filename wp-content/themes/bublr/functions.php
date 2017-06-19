<?php
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
function usm_customize_register( $wp_customize ) {
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
add_action( 'customize_register', 'usm_customize_register' );
remove_action( 'customize_register', 'shiftnav_register_customizers' );

function bublr_sanitize_num($input) {
  $input = preg_replace('/[^0-9]/s', '', $input);
  return $input;
}
?>