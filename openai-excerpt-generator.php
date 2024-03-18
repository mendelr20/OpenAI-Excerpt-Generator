<?php
/**
 * Plugin Name: Open-AI Excerpt Generator
 * Plugin URI: https://codebludev.com
 * Description: Automatically generates post excerpts using Open AI.
 * Version: 1.0
 * Author: CodeBlu Development
 * Author URI: https://codebludev.com
 */

// Include the settings page and functions.
include_once plugin_dir_path(__FILE__) . 'settings-page.php';
include_once plugin_dir_path(__FILE__) . 'functions.php';

// Hook to add the settings page to the WordPress admin menu.
add_action('admin_menu', 'openai_excerpt_generator_add_admin_menu');
function openai_excerpt_generator_add_admin_menu() {
    add_options_page('OpenAI Excerpt Generator', 'OpenAI Excerpt Generator', 'manage_options', 'openai_excerpt_generator', 'openai_excerpt_generator_settings_page');
}

// Register settings and fields.
add_action('admin_init', 'openai_excerpt_generator_settings_init');

