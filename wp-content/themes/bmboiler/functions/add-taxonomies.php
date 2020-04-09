<?php

/**
 * Create a taxonomy
 *
 * @uses  Inserts new taxonomy object into the list
 * @uses  Adds query vars
 *
 * @param string  Name of taxonomy object
 * @param array|string  Name of the object type for the taxonomy object.
 * @param array|string  Taxonomy arguments
 * @return null|WP_Error WP_Error if errors, otherwise null.
 */
function blog_categories() {

	$labels = array(
		'name'                  => _x( 'Categories', 'Taxonomy plural name', 'text-domain' ),
		'singular_name'         => _x( 'Category', 'Taxonomy singular name', 'text-domain' ),
		'search_items'          => __( 'Search Categories', 'text-domain' ),
		'popular_items'         => __( 'Popular Categories', 'text-domain' ),
		'all_items'             => __( 'All Categories', 'text-domain' ),
		'parent_item'           => __( 'Parent Category', 'text-domain' ),
		'parent_item_colon'     => __( 'Parent Category', 'text-domain' ),
		'edit_item'             => __( 'Edit Category', 'text-domain' ),
		'update_item'           => __( 'Update Category', 'text-domain' ),
		'add_new_item'          => __( 'Add New Category', 'text-domain' ),
		'new_item_name'         => __( 'New Category Name', 'text-domain' ),
		'add_or_remove_items'   => __( 'Add or remove Categories', 'text-domain' ),
		'choose_from_most_used' => __( 'Choose from most used Categories', 'text-domain' ),
		'menu_name'             => __( 'Category', 'text-domain' ),
	);

	$args = array(
		'labels'            => $labels,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_admin_column' => false,
		'hierarchical'      => true,
		'show_tagcloud'     => true,
		'show_ui'           => true,
		'query_var'         => true,
		'rewrite'           => true,
		'query_var'         => true,
		'capabilities'      => array(),
	);

	register_taxonomy( 'category', array( 'blog' ), $args );
}

add_action( 'init', 'blog_categories' );

/**
 * Create a taxonomy
 *
 * @uses  Inserts new taxonomy object into the list
 * @uses  Adds query vars
 *
 * @param string  Name of taxonomy object
 * @param array|string  Name of the object type for the taxonomy object.
 * @param array|string  Taxonomy arguments
 * @return null|WP_Error WP_Error if errors, otherwise null.
 */
function blog_tags() {

	$labels = array(
		'name'                  => _x( 'Blog Tags', 'Taxonomy plural name', 'text-domain' ),
		'singular_name'         => _x( 'Blog Tag', 'Taxonomy singular name', 'text-domain' ),
		'search_items'          => __( 'Search Blog Tags', 'text-domain' ),
		'popular_items'         => __( 'Popular Blog Tags', 'text-domain' ),
		'all_items'             => __( 'All Blog Tags', 'text-domain' ),
		'parent_item'           => __( 'Parent Blog Tag', 'text-domain' ),
		'parent_item_colon'     => __( 'Parent Blog Tag', 'text-domain' ),
		'edit_item'             => __( 'Edit Blog Tag', 'text-domain' ),
		'update_item'           => __( 'Update Blog Tag', 'text-domain' ),
		'add_new_item'          => __( 'Add New Blog Tag', 'text-domain' ),
		'new_item_name'         => __( 'New Blog Tag Name', 'text-domain' ),
		'add_or_remove_items'   => __( 'Add or remove Blog Tags', 'text-domain' ),
		'choose_from_most_used' => __( 'Choose from most used Blog Tags', 'text-domain' ),
		'menu_name'             => __( 'Blog Tag', 'text-domain' ),
	);

	$args = array(
		'labels'            => $labels,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_admin_column' => false,
		'hierarchical'      => false,
		'show_tagcloud'     => true,
		'show_ui'           => true,
		'query_var'         => true,
		'rewrite'           => true,
		'query_var'         => true,
		'capabilities'      => array(),
	);

	register_taxonomy( 'blog_tag', array( 'blog' ), $args );
}

add_action( 'init', 'blog_tags' );


/**
 * Create a taxonomy
 *
 * @uses  Inserts new taxonomy object into the list
 * @uses  Adds query vars
 *
 * @param string  Name of taxonomy object
 * @param array|string  Name of the object type for the taxonomy object.
 * @param array|string  Taxonomy arguments
 * @return null|WP_Error WP_Error if errors, otherwise null.
 */
function news_categories() {

	$labels = array(
		'name'                  => _x( 'News Categories', 'Taxonomy plural name', 'text-domain' ),
		'singular_name'         => _x( 'News Category', 'Taxonomy singular name', 'text-domain' ),
		'search_items'          => __( 'Search News Categories', 'text-domain' ),
		'popular_items'         => __( 'Popular News Categories', 'text-domain' ),
		'all_items'             => __( 'All News Categories', 'text-domain' ),
		'parent_item'           => __( 'Parent News Category', 'text-domain' ),
		'parent_item_colon'     => __( 'Parent News Category', 'text-domain' ),
		'edit_item'             => __( 'Edit News Category', 'text-domain' ),
		'update_item'           => __( 'Update News Category', 'text-domain' ),
		'add_new_item'          => __( 'Add New News Category', 'text-domain' ),
		'new_item_name'         => __( 'New News Category Name', 'text-domain' ),
		'add_or_remove_items'   => __( 'Add or remove News Categories', 'text-domain' ),
		'choose_from_most_used' => __( 'Choose from most used News Categories', 'text-domain' ),
		'menu_name'             => __( 'News Category', 'text-domain' ),
	);

	$args = array(
		'labels'            => $labels,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_admin_column' => false,
		'hierarchical'      => true,
		'show_tagcloud'     => true,
		'show_ui'           => true,
		'query_var'         => true,
		'rewrite'           => true,
		'query_var'         => true,
		'capabilities'      => array(),
	);

	register_taxonomy( 'news_category', array( 'news' ), $args );
}

add_action( 'init', 'news_categories' );


/**
 * Create a taxonomy
 *
 * @uses  Inserts new taxonomy object into the list
 * @uses  Adds query vars
 *
 * @param string  Name of taxonomy object
 * @param array|string  Name of the object type for the taxonomy object.
 * @param array|string  Taxonomy arguments
 * @return null|WP_Error WP_Error if errors, otherwise null.
 */
function location_region() {

	$labels = array(
		'name'                  => _x( 'Regions', 'Taxonomy plural name', 'text-domain' ),
		'singular_name'         => _x( 'Region', 'Taxonomy singular name', 'text-domain' ),
		'search_items'          => __( 'Search Regions', 'text-domain' ),
		'popular_items'         => __( 'Popular Regions', 'text-domain' ),
		'all_items'             => __( 'All Regions', 'text-domain' ),
		'parent_item'           => __( 'Parent Region', 'text-domain' ),
		'parent_item_colon'     => __( 'Parent Region', 'text-domain' ),
		'edit_item'             => __( 'Edit Region', 'text-domain' ),
		'update_item'           => __( 'Update Region', 'text-domain' ),
		'add_new_item'          => __( 'Add New Region', 'text-domain' ),
		'new_item_name'         => __( 'New Region Name', 'text-domain' ),
		'add_or_remove_items'   => __( 'Add or remove Regions', 'text-domain' ),
		'choose_from_most_used' => __( 'Choose from most used Regions', 'text-domain' ),
		'menu_name'             => __( 'Region', 'text-domain' ),
	);

	$args = array(
		'labels'            => $labels,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_admin_column' => false,
		'hierarchical'      => true,
		'show_tagcloud'     => true,
		'show_ui'           => true,
		'query_var'         => true,
		'rewrite'           => true,
		'query_var'         => true,
		'capabilities'      => array(),
	);

	register_taxonomy( 'location_region', array( 'locations' ), $args );
}

add_action( 'init', 'location_region' );

?>
