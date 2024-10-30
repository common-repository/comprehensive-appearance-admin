<?php
 /**
  * Plugin Name: Comprehensive Appearance Admin
  * Plugin URI:  http://wpmulti.org/comprehensive-appearance-admin
  * Description: Display a better, comprehensive Appearance Menu in the Dashboard and in the front-end Toolbar.
  * Version:     0.1.4
  * Author:      Martin Robbins
  * Author URI:  http://wpmulti.org
  * License:     GPL2 or later
  * License URI: https://www.gnu.org/licenses/gpl-2.0.html
  */


// Add Dashboard Customize items for Themes, Widgets, Menus,
add_action ( '_admin_menu', 'caa_add_customize_submenus', 999 );
function caa_add_customize_submenus() {
	

	global $submenu;
	global $customize_url;
	
	$customize_url = add_query_arg( 'return', urlencode( wp_unslash( $_SERVER['REQUEST_URI'] ) ), 'customize.php' );
	//$customize_url = site_url() . '/wp-admin/customize.php' ;	

	// add a Customize Themes menu item
	$customize_themes_url = add_query_arg( array( 'autofocus' => array( 'section' => 'themes' ) ), $customize_url );
	$submenu['themes.php']['21.1'] = array( __( 'Customize Themes' ), 'customize', esc_url( $customize_themes_url ), '', 'hide-if-no-customize' );
	
	// Add a Customize Widgets menu item
	if ( current_theme_supports( 'widgets' ) ):
		$customize_widgets_url = add_query_arg( array( 'autofocus' => array( 'panel' => 'widgets' ) ), $customize_url );
		$submenu['themes.php']['21.2'] = array( __( 'Customize Widgets' ), 'customize', esc_url( $customize_widgets_url ), '', 'hide-if-no-customize' );
	endif;

	// Add a Customize Menus menu item
	if ( current_theme_supports( 'menus' ) ) {
		$customize_menus_url = add_query_arg( array( 'autofocus' => array( 'panel' => 'nav_menus' ) ), $customize_url );
		$submenu['themes.php']['21.3'] = array( __( 'Customize Menus' ), 'customize', esc_url( $customize_menus_url ), '', 'hide-if-no-customize' );	
	}

}


// Add Dashboard Old School items for Header, Background
add_action ( '_admin_menu', 'caa_add_old_school_submenus', 999 );
function caa_add_old_school_submenus() {

	global $submenu;

	// Add a Custom Header menu item
	if ( current_theme_supports( 'custom-header' ) && current_user_can( 'edit_theme_options') ) {
		$submenu['themes.php']['21.4'] = array( __( 'Old-School Custom Header' ), 'edit_theme_options', site_url() . '/wp-admin/themes.php?page=custom-header', '', '' );
	}

	// Add a Custom Background menu item 
	if ( current_theme_supports( 'custom-background' ) && current_user_can( 'edit_theme_options') ) {
		$submenu['themes.php']['21.5'] = array( __( 'Old-School Custom Background' ), 'edit_theme_options', site_url() . '/wp-admin/themes.php?page=custom-background', '', '' );	
	}

}


// Add Toolbar Old School items
add_action( 'admin_bar_menu', 'caa_add_old_school_nodes', 999 );
function caa_add_old_school_nodes( $wp_admin_bar ) {

	if ( current_theme_supports( 'custom-header' ) && current_user_can( 'edit_theme_options') ) {
		$args = array(
			'parent'    => 'appearance',
			'id'    => 'caa-os-header',
			'title' => 'Header',
			'href'  => admin_url( 'themes.php?page=custom-header' ),
			'meta'  => array( 'class' => 'caa-os-header' )
		);		
		$wp_admin_bar->add_node( $args );
	}

	if ( current_theme_supports( 'custom-background' ) && current_user_can( 'edit_theme_options') ) {
		$args = array(
			'parent'    => 'appearance',
			'id'    => 'caa-os-background',
			'title' => 'Background',
			'href'  => admin_url( 'themes.php?page=custom-background' ),
			'meta'  => array( 'class' => 'caa-os-background' )
		);		
		$wp_admin_bar->add_node( $args );
	}

}

?>