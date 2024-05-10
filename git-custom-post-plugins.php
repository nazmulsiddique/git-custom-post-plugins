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
function gitcp_custom_post_settings_page() {
    add_menu_page('Custom Post for new feature', 'Custom Post', 'manage_options', 'gitcp-plugin-option', 'gitcp_create_page', 'dashicons-embed-post
    ', '50');
}
add_action('admin_menu', 'gitcp_custom_post_settings_page');

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


function gitcp_create_page(){ ?>
    <div class="gitcu-main-area">
        <div class="gitcu-main-area-content">
            <div class="gitcu-left-side">
                <h2>Test</h2>
            </div>
            <div class="gitcu-right-side">
                <div class="developer-info">
                    <h2>Developer Info</h2><hr>
                    <h4>Md. Nazmul Siddique</h4>
                    <p>Web Developer</p>
                    <p>nazmulit92@gmail.com</p>
                </div>
            </div>
        </div>
    </div>

<?php
}

?>