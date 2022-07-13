<?php
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
   wp_enqueue_style( 'child-style',
    get_stylesheet_directory_uri() . '/style.css' ,
    array('parent-style'),
    wp_get_theme()->get('Version'));
	wp_enqueue_style( 'astra-child-theme-fonts', 'https://fonts.googleapis.com/css2?family=Alegreya+Sans' );
	wp_dequeue_style('astra-elementor-editor-style');
}




/* filter function that adds "Book Review: " at the start of the title for all posts in MH@H Book Reviews category */
    
function review_titles($title, $id = NULL) {
    if ( in_category("Reviews", $id) ) {
        $title = "Book Review: " . $title;
    }
    return $title;
}    

add_filter('the_title', 'review_titles', 10, 2);


/* remove admin bar */
show_admin_bar(false);



/* remove parent theme functionality, add new functionality */

function astra_child_theme_setup() {

	/* add a tertiary menu */

	register_nav_menus(
		array(
			'tertiary_menu' => __( 'Tertiary Menu', 'astra' ),
		)
	);

	
	/* remove parent theme's widget areas
    remove_action( 'widgets_init', 'astra_widgets_init' );
	*/
}

add_action('after_setup_theme', 'astra_child_theme_setup');
