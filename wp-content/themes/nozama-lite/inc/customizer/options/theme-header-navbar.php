<?php
	$wp_customize->add_setting( 'show-topnav', array(
		'transport'         => 'postMessage',
		'default'           => 0,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'show-topnav', array(
		'type'    => 'checkbox',
		'section' => 'theme_header_topnav',
		'label'   => esc_html__( 'Show/Hide Top Navbar', 'nozama-lite' ),
	) );

	$wp_customize->add_setting( 'navbar_text', array(
		'transport'         => 'postMessage',
		'default'           => '',
		'sanitize_callback' => 'nozama_lite_sanitize_navbar_text',
	) );
	$wp_customize->add_control( 'navbar_text', array(
		'type'    => 'textarea',
		'section' => 'theme_header_topnav',
		'label'   => esc_html__( 'Navbar Text', 'nozama-lite' ),
	) );

	$wp_customize->selective_refresh->add_partial( 'theme_header_layout', array(
		'selector'            => '.header',
		'render_callback'     => 'nozama_lite_header',
		'settings'            => array( 'show-topnav', 'navbar_text' ),
		'container_inclusive' => true,
	) );
