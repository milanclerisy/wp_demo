<?php

function theme_option_setup()
{
    // add_theme_support('menus');
    // register_nav_menu('primary', 'Primary Header Menu Navigation1');
}
//Showing menus in admin panel
register_nav_menus(
    array('primary-menu' => 'Header Menu') //Admin will see Top menu
);
//declaration of function
function addStyleFiles()
{
    wp_enqueue_style('style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'addStyleFiles');
add_action('init', 'theme_option_setup');
/* 
    Post Type createion: Testimonial
*/

function testimonial_post_type()
{
    $labels = array(
        'name'                => _x('testimonial', 'Post Type General Name', 'acsweb'),
        'singular_name'       => _x('testimonial', 'Post Type Singular Name', 'acsweb'),
        'menu_name'           => __('testimonial', 'acsweb'),
        'parent_item_colon'   => __('Parent testimonial', 'acsweb'),
        'all_items'           => __('All testimonials', 'acsweb'),
        'view_item'           => __('View testimonials', 'acsweb'),
        'add_new_item'        => __('Add New testimonial', 'acsweb'),
        'add_new'             => __('Add New', 'acsweb'),
        'edit_item'           => __('Edit testimonial', 'acsweb'),
        'update_item'         => __('Update testimonial', 'acsweb'),
        'search_items'        => __('Search testimonial', 'acsweb'),
        'not_found'           => __('Not Found', 'acsweb'),
        'not_found_in_trash'  => __('Not found in Trash', 'acsweb'),
    );
    $args = array(
        'label'               => __('testimonial', 'acsweb'),
        'description'         => __('testimonial news and reviews', 'acsweb'),
        'labels'              => $labels,
        'supports'            => array('title', 'editor', 'excerpt', 'author', 'thumbnail',),
        'taxonomies'          => array('genres'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,

        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-admin-users',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
        'taxonomies'          => array('category'),
    );
    register_post_type('testimonial', $args);
}

add_action('init', 'testimonial_post_type', 0);

/*
        * Taximony Creation: Animal
        * Post types included: post, news
    */
function wporg_register_taxonomy_animal()
{
    $labels = array(
        'name'              => _x('Animals', 'taxonomy general name'),
        'singular_name'     => _x('Animal', 'taxonomy singular name'),
        'search_items'      => __('Search Animals'),
        'all_items'         => __('All Animals'),
        'parent_item'       => __('Parent Animal'),
        'parent_item_colon' => __('Parent Animal:'),
        'edit_item'         => __('Edit Animal'),
        'update_item'       => __('Update Animal'),
        'add_new_item'      => __('Add New Animal'),
        'new_item_name'     => __('New Animal Name'),
        'menu_name'         => __('Animals'),
    );
    $args   = array(
        'hierarchical'      => true, // make it hierarchical (like categories)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => ['slug' => 'animal'],
    );
    register_taxonomy('animal', array('post', 'news'), $args);
}
add_action('init', 'wporg_register_taxonomy_animal', 0);

/* 
    * Post Type Creation: News
    */

function news_post_type()
{
    $labels = array(
        'name'                => _x('news', 'Post Type General Name', 'acsweb'),
        'singular_name'       => _x('news', 'Post Type Singular Name', 'acsweb'),
        'menu_name'           => __('news', 'acsweb'),
        'parent_item_colon'   => __('Parent news', 'acsweb'),
        'all_items'           => __('All news', 'acsweb'),
        'view_item'           => __('View news', 'acsweb'),
        'add_new_item'        => __('Add New news', 'acsweb'),
        'add_new'             => __('Add New', 'acsweb'),
        'edit_item'           => __('Edit news', 'acsweb'),
        'update_item'         => __('Update news', 'acsweb'),
        'search_items'        => __('Search news', 'acsweb'),
        'not_found'           => __('Not Found', 'acsweb'),
        'not_found_in_trash'  => __('Not found in Trash', 'acsweb'),
    );
    $args = array(
        'label'               => __('news', 'acsweb'),
        'description'         => __('news news and reviews', 'acsweb'),
        'labels'              => $labels,
        'supports'            => array('title', 'editor', 'excerpt', 'author', 'thumbnail',),
        'taxonomies'          => array('genres'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,

        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-analytics',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
        'taxonomies'          => array('animal', 'category'),
    );
    register_post_type('news', $args);
}

add_action('init', 'news_post_type', 0);

add_action('wp_ajax_contact_us', 'ajax_contact_us'); // ajax_contact_us is the func name
function ajax_contact_us()
{
    $attr = [];
    wp_parse_str($_POST['contact_us'], $attr);
    global $wpdb;
    global $table_prefix;
    $table = $table_prefix . 'contact_us';
    $is_data_inserted = $wpdb->insert($table, [
        "name" => $attr['name'],
        "email" => $attr['email'],
        "message" => $attr['message']
    ]);
    if ($is_data_inserted > 0) {
        wp_send_json_success("Data inserted successfully");
    } else {
        wp_send_json_error("Something went wrong");
    }
}


add_action('wp_ajax_fetch_guests', 'fetch_guest_data'); // ajax_contact_us is the func name
function fetch_guest_data()
{
    global $wpdb;
    global $table_prefix;
    $table = $table_prefix . 'contact_us';
    $guests = $wpdb->get_results("SELECT * FROM {$table}");
    $totalNumberOfGuest = $wpdb->num_rows;
    // $result = $wpdb->get_results( "SELECT * FROM {$table}", OBJECT);
    // echo "totalNumberOfGuest: " . $totalNumberOfGuest;
    /* foreach( $guests as $guest ) {
        echo "\n";
        echo $guest->name;
    } */
    $response_data = array("guests" => $guests, "totalNumberOfGuest" => $totalNumberOfGuest);
    wp_send_json_success($response_data);
    // echo json_encode(array("guests" => $guests, "NumOfGuests" => $totalNumberOfGuest, "status" => true));
    //wp_send_json_success({"guests": $guests, NumOfGuest: $totalNumberOfGuest});
}
