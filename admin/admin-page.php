<?php
function openai_excerpt_generator_settings_page() {
    ?>
    <div class="wrap">
        <h2>OpenAI Excerpt Generator Settings</h2>
        <form method="post" action="options.php">
            <?php
            settings_fields('openai_excerpt_generator_plugin_options');
            do_settings_sections('openai_excerpt_generator');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}
