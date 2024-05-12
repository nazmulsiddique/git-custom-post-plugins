<?php
/**
 * Plugin Name: Custom Post
 * Description: Wordpress custom post plugins.
 * Version: 1.0
 * Requires at least: 5.5
 * Requires PHP:      7.4
 * Author: Nazmul Siddique 
 * Author URI: www.ghatailit.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * text Domain: gitcp
 */

/*
* Plugins Option Page Function
 */
// Add Menu in Dashboard
// function gitcp_custom_post_settings_page() {
//     add_menu_page('Custom Post for new feature', 'Custom Post', 'manage_options', 'gitcp-plugin-option', 'gitcp_create_page', 'dashicons-embed-post
//     ', '50');
// }
// add_action('admin_menu', 'gitcp_custom_post_settings_page');

/* Loading Css File for Frontend*/
function gitcp_custom_post_enqueue_style() {
    wp_enqueue_style('gitcp-main-style', plugins_url('css/gitcp-main-style.css', __FILE__ ));
}
add_action('wp_enqueue_scripts', 'gitcp_custom_post_enqueue_style');

/* Loading JS File for Frontend */
function gitcp_custom_post_enqueue_script() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('gitcp-main-script', plugins_url('js/gitcp-main-script.js', __FILE__ ));
}
add_action('wp_enqueue_scripts', 'gitcp_custom_post_enqueue_script');

/* Loading Css File for admin panel */
function gitcp_custom_post_admin_enqueue_style() {
    wp_enqueue_style('gitcp-admin-style', plugins_url('css/gitcp-admin-style.css', __FILE__ ));
}
add_action('admin_enqueue_scripts', 'gitcp_custom_post_admin_enqueue_style');

/* Register Custom Post Type */
if ( ! function_exists('gitcu_custom_post_type') ) {
    function gitcu_custom_post_type() {       
        $labels = array(
            'name'                  => _x( 'My Custom Post', 'Post Type General Name', 'gitcu' ),
            'singular_name'         => _x( 'My Custom Post', 'Post Type Singular Name', 'gitcu' ),
            'menu_name'             => __( 'My Custom Post', 'gitcu' ),
            'name_admin_bar'        => __( 'Post Type', 'gitcu' ),
            'archives'              => __( 'Item Archives', 'gitcu' ),
            'attributes'            => __( 'Item Attributes', 'gitcu' ),
            'parent_item_colon'     => __( 'Parent Item:', 'gitcu' ),
            'all_items'             => __( 'All Items', 'gitcu' ),
            'add_new_item'          => __( 'Add New Item', 'gitcu' ),
            'add_new'               => __( 'Add New', 'gitcu' ),
            'new_item'              => __( 'New Item', 'gitcu' ),
            'edit_item'             => __( 'Edit Item', 'gitcu' ),
            'update_item'           => __( 'Update Item', 'gitcu' ),
            'view_item'             => __( 'View Item', 'gitcu' ),
            'view_items'            => __( 'View Items', 'gitcu' ),
            'search_items'          => __( 'Search Item', 'gitcu' ),
            'not_found'             => __( 'Not found', 'gitcu' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'gitcu' ),
            'featured_image'        => __( 'Featured Image', 'gitcu' ),
            'set_featured_image'    => __( 'Set featured image', 'gitcu' ),
            'remove_featured_image' => __( 'Remove featured image', 'gitcu' ),
            'use_featured_image'    => __( 'Use as featured image', 'gitcu' ),
            'insert_into_item'      => __( 'Insert into item', 'gitcu' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'gitcu' ),
            'items_list'            => __( 'Items list', 'gitcu' ),
            'items_list_navigation' => __( 'Items list navigation', 'gitcu' ),
            'filter_items_list'     => __( 'Filter items list', 'gitcu' ),
        );
        $args = array(
            'label'                 => __( 'My Custom Post', 'gitcu' ),
            'description'           => __( 'My Custom Post For new type post upload and show', 'gitcu' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail' ),
            'taxonomies'            => array( 'category', 'post_tag' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 25,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
            'show_in_rest'          => true,
        );
        register_post_type( 'git_custom_post_type', $args );       
    }
    add_action( 'init', 'gitcu_custom_post_type');
} 

/* Custom Post Type Loop show */
function gitcu_custom_post_type_loop() {
    $args = array(
        'post_type'      => array( 'git_custom_post_type' ),
        'post_status'    => array( 'publish' ),
    );
    $gitcu_query = new WP_Query( $args );
    if ( $gitcu_query->have_posts() ) {
        while ( $gitcu_query->have_posts() ) {
            $gitcu_query->the_post(); ?>

            <h2><?php the_title(); ?></h2>

            <?php
        }
    } else {
        // No posts found
    }
    wp_reset_postdata();
}
/* Custom Post Type show by Shortcode */
function gitcu_custom_post_short_code() {
    ob_start();
    gitcu_custom_post_type_loop();
    return ob_get_clean();
}
add_shortcode( 'git-my-custom-post-show', 'gitcu_custom_post_short_code' );