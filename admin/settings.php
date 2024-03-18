<?php
function openai_excerpt_generator_settings_init() {
    register_setting('openai_excerpt_generator', 'openai_excerpt_generator_settings');

    add_settings_section(
        'openai_excerpt_generator_section',
        __('OpenAI Excerpt Generator Settings', 'openai-excerpt-generator'),
        'openai_excerpt_generator_section_callback',
        'openai_excerpt_generator'
    );

    add_settings_field(
        'openai_excerpt_enable',
        __('Enable Excerpt Generator', 'openai-excerpt-generator'),
        'openai_excerpt_generator_enable_render',
        'openai_excerpt_generator',
        'openai_excerpt_generator_section'
    );

    add_settings_field(
        'openai_excerpt_length',
        __('Excerpt Length', 'openai-excerpt-generator'),
        'openai_excerpt_generator_excerpt_length_render',
        'openai_excerpt_generator',
        'openai_excerpt_generator_section'
    );

    add_settings_field(
        'openai_excerpt_prompt',
        __('Custom Prompt', 'openai-excerpt-generator'),
        'openai_excerpt_generator_prompt_render',
        'openai_excerpt_generator',
        'openai_excerpt_generator_section'
    );

    // Add more fields as needed...
}

function openai_excerpt_generator_section_callback() {
    echo __('Customize how the OpenAI Excerpt Generator behaves.', 'openai-excerpt-generator');
}

function openai_excerpt_generator_enable_render() {
    $options = get_option('openai_excerpt_generator_settings');
    ?>
    <input type='checkbox' name='openai_excerpt_generator_settings[enable]' <?php checked(isset($options['enable']) ? $options['enable'] : 0); ?>>
    <?php
}

function openai_excerpt_generator_excerpt_length_render() {
    $options = get_option('openai_excerpt_generator_settings');
    ?>
    <input type='number' name='openai_excerpt_generator_settings[excerpt_length]' value='<?php echo $options['excerpt_length']; ?>' min="1" max="100">
    <?php
}

function openai_excerpt_generator_prompt_render() {
    $options = get_option('openai_excerpt_generator_settings');
    ?>
    <input type='text' name='openai_excerpt_generator_settings[prompt]' value='<?php echo $options['prompt']; ?>'>
    <?php
}

// Initialize settings
add_action('admin_init', 'openai_excerpt_generator_settings_init');
