<?php
// custom jQuery
function custom_jquery() {
  wp_deregister_script('jquery');
  wp_enqueue_script('jquery', '//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.js', array(), '3.2.1', false);
}
add_action('wp_enqueue_scripts', 'custom_jquery');
?>
