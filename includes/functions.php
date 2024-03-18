<?php
function openai_generate_excerpt($post_content) {
    $api_key = get_option('openai_excerpt_generator_settings')['api_key']; // Assuming you store your API key in the plugin's settings
    $prompt = get_option('openai_excerpt_generator_settings')['prompt'];
    $max_length = get_option('openai_excerpt_generator_settings')['excerpt_length'];

    // Prepare the data for the API request based on the plugin settings and post content
    $data = [
        'prompt' => $prompt . ' ' . $post_content,
        'max_tokens' => $max_length,
        // Add other parameters as needed
    ];

    // Make the API request to OpenAI
    $response = wp_remote_post('https://api.openai.com/v1/engines/text-davinci-002/completions', [
        'headers' => [
            'Authorization' => 'Bearer ' . $api_key,
            'Content-Type' => 'application/json',
        ],
        'body' => json_encode($data),
    ]);

    // Process the response
    if (is_wp_error($response)) {
        $error_message = $response->get_error_message();
        // Handle error accordingly
    } else {
        $body = wp_remote_retrieve_body($response);
        $result = json_decode($body, true);
        return $result['choices'][0]['text']; // Return the generated excerpt
    }
}


function openai_modify_post_excerpt($post_id, $post, $update) {
    // Check if the excerpt should be auto-generated for this post type or status
    if (get_option('openai_excerpt_generator_settings')['auto_generate'] && suitable_for_generation($post)) {
        $generated_excerpt = openai_generate_excerpt($post->post_content);
        // Update the post excerpt
        wp_update_post([
            'ID' => $post_id,
            'post_excerpt' => $generated_excerpt,
        ]);
    }
}
add_action('save_post', 'openai_modify_post_excerpt', 10, 3);


function suitable_for_generation($post) {
    // Implement checks to determine if the excerpt should be generated
    // This could include checking the post type, length, existing excerpt, etc.
    return true; // Placeholder return value
}
