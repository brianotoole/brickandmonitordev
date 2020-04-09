<?php

// custom post type - work
if( ! function_exists( 'monarch_work' ) ) {
	function monarch_work() {



		// athlete
		$labels = array(
			'name'               => _x( 'Work', 'monarchurban' ),
			'singular_name'      => _x( 'Work', 'monarchurban' ),
			'menu_name'          => _x( 'Work', 'monarchurban' ),
			'name_admin_bar'     => _x( 'Work', 'monarchurban' ),
			'add_new'            => _x( 'Add New', 'monarchurban' ),
			'add_new_item'       => __( 'Add New Work', 'monarchurban' ),
			'new_item'           => __( 'New Work', 'monarchurban' ),
			'edit_item'          => __( 'Edit Work', 'monarchurban' ),
			'view_item'          => __( 'View Work', 'monarchurban' ),
			'all_items'          => __( 'All Work', 'monarchurban' ),
			'search_items'       => __( 'Search Works', 'monarchurban' ),
			'parent_item_colon'  => __( 'Parent Works:', 'monarchurban' ),
			'not_found'          => __( 'No Works found.', 'monarchurban' ),
			'not_found_in_trash' => __( 'No Works found in Trash.', 'monarchurban' )
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'work' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => true,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
		);

		register_post_type( 'work', $args );

		// taxonomy - work_category
		$athlete_labels = array(
			'name'              => _x( 'Work Type', 'monarchurban' ),
			'singular_name'     => _x( 'Category', 'monarchurban' ),
			'search_items'      => __( 'Search Work Categories' ),
			'all_items'         => __( 'All Categories' ),
			'parent_item'       => __( 'Parent Category' ),
			'parent_item_colon' => __( 'Parent Category:' ),
			'edit_item'         => __( 'Edit Category' ),
			'update_item'       => __( 'Update Category' ),
			'add_new_item'      => __( 'Add New Category' ),
			'new_item_name'     => __( 'New Category Name' ),
			'menu_name'         => __( 'Work Types' ),
		);

		$athlete_args = array(
			'hierarchical'      => true,
			'labels'            => $athlete_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'work_category' ),
		);

		register_taxonomy( 'work_category', array( 'work' ), $work_args );


		// taxonomy - work_city_category
		$athlete_labels = array(
			'name'              => _x( 'Work City', 'taxonomy general name' ),
			'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Work City Categories' ),
			'all_items'         => __( 'All Categories' ),
			'parent_item'       => __( 'Parent Category' ),
			'parent_item_colon' => __( 'Parent Category:' ),
			'edit_item'         => __( 'Edit Category' ),
			'update_item'       => __( 'Update Category' ),
			'add_new_item'      => __( 'Add New Category' ),
			'new_item_name'     => __( 'New Category Name' ),
			'menu_name'         => __( 'Work Cities' ),
		);

		$athlete_args = array(
			'hierarchical'      => true,
			'labels'            => $athlete_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'work_city_category' ),
		);

		register_taxonomy( 'work_city_category', array( 'work' ), $work_args );


		// taxonomy - work_tag_category
		$work_labels = array(
			'name'              => _x( 'Work Tags', 'taxonomy general name' ),
			'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
			'search_items'      => __( 'Search athlete Tag Categories' ),
			'all_items'         => __( 'All Categories' ),
			'parent_item'       => __( 'Parent Category' ),
			'parent_item_colon' => __( 'Parent Category:' ),
			'edit_item'         => __( 'Edit Category' ),
			'update_item'       => __( 'Update Category' ),
			'add_new_item'      => __( 'Add New Category' ),
			'new_item_name'     => __( 'New Category Name' ),
			'menu_name'         => __( 'Work Tags' ),
		);

		$work_args = array(
			'hierarchical'      => true,
			'labels'            => $work_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'work_tag_category' ),
		);

		register_taxonomy( 'work_tag_category', array( 'work' ), $work_args );

	}
}
add_action( 'init', 'monarch_work' );



// custom post type - team
if( ! function_exists( 'monarch_team' ) ) {
	function monarch_team() {



		// career
		$labels = array(
			'name'               => _x( 'Team', 'monarchurban' ),
			'singular_name'      => _x( 'Team', 'monarchurban' ),
			'menu_name'          => _x( 'Team', 'monarchurban' ),
			'name_admin_bar'     => _x( 'Team', 'monarchurban' ),
			'add_new'            => _x( 'Add New', 'monarchurban' ),
			'add_new_item'       => __( 'Add New Team', 'monarchurban' ),
			'new_item'           => __( 'New Team', 'monarchurban' ),
			'edit_item'          => __( 'Edit Team', 'monarchurban' ),
			'view_item'          => __( 'View Team', 'monarchurban' ),
			'all_items'          => __( 'All Team Members', 'monarchurban' ),
			'search_items'       => __( 'Search Team Members', 'monarchurban' ),
			'parent_item_colon'  => __( 'Parent Team Members:', 'monarchurban' ),
			'not_found'          => __( 'No Team Members found.', 'monarchurban' ),
			'not_found_in_trash' => __( 'No Team Members found in Trash.', 'monarchurban' )
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'team-member' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => true,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
		);

		register_post_type( 'team', $args );

		// taxonomy - team_category
		$career_labels = array(
			'name'              => _x( 'Team Categories', 'taxonomy general name' ),
			'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Team Categories' ),
			'all_items'         => __( 'All Categories' ),
			'parent_item'       => __( 'Parent Category' ),
			'parent_item_colon' => __( 'Parent Category:' ),
			'edit_item'         => __( 'Edit Category' ),
			'update_item'       => __( 'Update Category' ),
			'add_new_item'      => __( 'Add New Category' ),
			'new_item_name'     => __( 'New Category Name' ),
			'menu_name'         => __( 'Category' ),
		);

		$career_args = array(
			'hierarchical'      => true,
			'labels'            => $carer_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'team_category' ),
		);

		register_taxonomy( 'team_category', array( 'team' ), $career_args );

	}
}
add_action( 'init', 'monarch_team' );
