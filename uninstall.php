<?php
/**
 * Fired when the plugin is uninstalled.
 *
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Helprace Feedback
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit; // If uninstall not called from WordPress, then exit.
}

$option_name = 'helprace_options';
 
if ( is_multisite() ) {
    global $wpdb;
    $blogs = $wpdb->get_results("SELECT blog_id FROM {$wpdb->blogs}", ARRAY_A);
    if ($blogs) {
        foreach($blogs as $blog) {
            switch_to_blog($blog['blog_id']);
            delete_option($option_name);
        }
        restore_current_blog();
    }
} else {
    delete_option($option_name);
}