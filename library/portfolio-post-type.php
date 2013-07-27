<?php
/* Bones Custom Post Type Example
This page walks you through creating 
a custom post type and taxonomies. You
can edit this one or copy the following code 
to create another one. 

I put this in a separate file so as to 
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.

Developed by: Eddie Machado
URL: http://themble.com/bones/
*/


// let's create the function for the custom type
function portfolio_type() { 
	// creating (registering) the custom type 
	register_post_type( 'portfolio-piece', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Portfolio Pieces', 'blerchin'), /* This is the Title of the Group */
			'singular_name' => __('Piece', 'blerchin'), /* This is the individual type */
			'all_items' => __('All Portfolio Pieces', 'blerchin'), /* the all items menu item */
			'add_new' => __('Add New', 'blerchin'), /* The add new menu item */
			'add_new_item' => __('Add New Portfolio Piece', 'blerchin'), /* Add New Display Title */
			'edit' => __( 'Edit', 'blerchin' ), /* Edit Dialog */
			'edit_item' => __('Edit Portfolio Piece', 'blerchin'), /* Edit Display Title */
			'new_item' => __('New Portfolio Piece', 'blerchin'), /* New Display Title */
			'view_item' => __('View Portfolio Piece', 'blerchin'), /* View Display Title */
			'search_items' => __('Search Portfolio Pieces', 'blerchin'), /* Search Custom Type Title */ 
			'not_found' =>  __('No Portflio Pieces found in the Database.', 'blerchin'), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __('Nothing found in Trash', 'blerchin'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Work to showcase', 'blerchin' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'portfolio', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'portfolio', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'revisions')
	 	) /* end of options */
	); /* end of register post type */
	
	
} 

	// adding the function to the Wordpress init
	add_action( 'init', 'portfolio_type');
	
	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	// now let's add custom categories (these act like categories)
    register_taxonomy( 'portfolio-type', 
    	array('portfolio-piece'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
    	array('hierarchical' => true,     /* if this is true, it acts like categories */             
    		'labels' => array(
    			'name' => __( 'Types', 'blerchin' ), /* name of the custom taxonomy */
    			'singular_name' => __( 'Type', 'blerchin' ), /* single taxonomy name */
    			'search_items' =>  __( 'Search Types', 'blerchin' ), /* search title for taxomony */
    			'all_items' => __( 'All Types', 'blerchin' ), /* all title for taxonomies */
    			'parent_item' => __( 'Parent Type', 'blerchin' ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Parent Type:', 'blerchin' ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Type', 'blerchin' ), /* edit custom taxonomy title */
    			'update_item' => __( 'Update Type', 'blerchin' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Add Type', 'blerchin' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Type Name', 'blerchin' ) /* name title for taxonomy */
    		),
    		'show_admin_column' => true, 
    		'show_ui' => true,
    		'query_var' => true,
    		'rewrite' => array( 'slug' => 'type' ),
    	)
    );   

    
    /*
    	looking for custom meta boxes?
    	check out this fantastic tool:
    	https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
    */
	

?>
