<?php
/**
 * stripedbydonmik Theme Customizer
 *
 * @package stripedbydonmik
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function striped_by_donmik_customize_register( $wp_customize ) {
    // Sidebar position.
    $wp_customize->add_section( 'sidebar_position_section_name' , array(
        'title'      => __( 'Sidebar Position', 'striped' ),
        'priority'   => 35,
        'capability' => 'edit_theme_options',
        'description' => __('Allows you to customize the sidebar position.', 'striped')
    ) );
    $wp_customize->add_setting( 'striped_by_donmik_options[sidebar_position]',
        array(
           'default' => 'left',
           'type' => 'option',
           'capability' => 'edit_theme_options',
           'transport' => 'postMessage',
        ) 
    );    
    $wp_customize->add_control( 'striped_by_donmik_sidebar_position', array(
        'label'      => __( 'Sidebar position', 'striped' ),
        'section'    => 'sidebar_position_section_name',
        'settings'   => 'striped_by_donmik_options[sidebar_position]',
        'type'       => 'select',
        'choices'    => array(
            'left' => 'Left position',
            'right' => 'Right position'
        ),
    ) );
    
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'striped_by_donmik_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function striped_by_donmik_customize_preview_js() {
	wp_enqueue_script( 'striped_by_donmik_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20131030', true );
}
add_action( 'customize_preview_init', 'striped_by_donmik_customize_preview_js' );
