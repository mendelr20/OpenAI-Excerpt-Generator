<?php
/**
 * Plugin Name: Open-AI Excerpt Generator
 * Plugin URI: https://codebludev.com
 * Description: Automatically generates post excerpts using Open AI.
 * Version: 1.0
 * Author: CodeBlu Development
 * Author URI: https://codebludev.com
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

// Include the settings page and core functions.
include_once plugin_dir_path(__FILE__) . 'admin/admin-page.php';
include_once plugin_dir_path(__FILE__) . 'admin/settings.php';
include_once plugin_dir_path(__FILE__) . 'includes/functions.php';

// Hook to add the settings page to the WordPress admin menu.
add_action('admin_menu', 'openai_excerpt_generator_add_admin_menu');
function openai_excerpt_generator_add_admin_menu() {
    add_options_page('OpenAI Excerpt Generator', 'OpenAI Excerpt Generator', 'manage_options', 'openai_excerpt_generator', 'openai_excerpt_generator_settings_page');
}

// Register settings and fields.
add_action('admin_init', 'openai_excerpt_generator_settings_init');

function openai_excerpt_generator_enqueue_admin_styles($hook_suffix) {
    // Check if on the specific settings page for your plugin
    if ('settings_page_openai_excerpt_generator' === $hook_suffix) {
        wp_enqueue_style(
            'openai-excerpt-generator-admin', 
            plugin_dir_url(__FILE__) . 'admin/css/admin-style.css',
            array(), // Dependencies
            '1.0', // Version number of your stylesheet
            'all' // Media type
        );
    }
}
add_action('admin_enqueue_scripts', 'openai_excerpt_generator_enqueue_admin_styles');
