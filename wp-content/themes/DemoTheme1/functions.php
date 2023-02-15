<?php 

add_theme_support('menus');

add_theme_support('widgets');

//declaration of function
function addStyleFiles() {
    wp_enqueue_style('style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'addStyleFiles');