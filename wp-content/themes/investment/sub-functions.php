<?php

add_action( 'init', 'codex_carrier_init' );
/**
 * Register a book post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function codex_carrier_init() {
	$labels = array(
		'name'               => _x( 'Carriers', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Carrier', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Carriers', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Carrier', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'carrier', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Carrier', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Carrier', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Carrier', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Carrier', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Carriers', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Carriers', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Carriers:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No carriers found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No carriers found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
                'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'carrier' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( 'carrier', $args );

}


// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_carrier_taxonomies', 0 );

// create two taxonomies, genres and writers for the post type "book"
function create_carrier_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Carrier Categories', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Carrier Category', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Carrier Categories', 'textdomain' ),
		'all_items'         => __( 'All Carrier Categories', 'textdomain' ),
		'parent_item'       => __( 'Parent Carrier Category', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Carrier Category:', 'textdomain' ),
		'edit_item'         => __( 'Edit Carrier Category', 'textdomain' ),
		'update_item'       => __( 'Update Carrier Category', 'textdomain' ),
		'add_new_item'      => __( 'Add New Carrier Category', 'textdomain' ),
		'new_item_name'     => __( 'New Carrier Category Name', 'textdomain' ),
		'menu_name'         => __( 'Carrier Category', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'carrier-category' ),
	);

	register_taxonomy( 'carrier-category', array( 'carrier' ), $args );

}
function create_training_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Training Categories', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Training Category', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Training Categories', 'textdomain' ),
		'all_items'         => __( 'All Training Categories', 'textdomain' ),
		'parent_item'       => __( 'Parent Training Category', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Training Category:', 'textdomain' ),
		'edit_item'         => __( 'Edit Training Category', 'textdomain' ),
		'update_item'       => __( 'Update Training Category', 'textdomain' ),
		'add_new_item'      => __( 'Add New Training Category', 'textdomain' ),
		'new_item_name'     => __( 'New Training Category Name', 'textdomain' ),
		'menu_name'         => __( 'Training Category', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'training-category' ),
	);

	register_taxonomy( 'training-category', array( 'training' ), $args );

}
?>
