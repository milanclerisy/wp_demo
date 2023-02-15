<?php

/* 
    *Plugin Name: Guests Table
    *Description: Guest table fetches all registered users
    *Author: Milan Kumar
*/
add_action("admin_menu", "guest_menu");

function guest_menu() { 
    add_menu_page("Guests", "Guests", "manage_options", "guest-list-table", "guest_list_table_fn");
}

function guest_list_table_fn(){
    $action = isset($_GET["action"]) ? $_GET["action"] : '';
    if($action === 'guest-table-edit' || $action === 'guest-table-delete') {
        $guestId = isset($_GET["guest_id"]) ? intval($_GET["guest_id"]) : ""; // It will be used in guest-edit page
        ob_start(); // ....check
        include_once plugin_dir_path(__FILE__) . 'views/guest-edit-delete.php';
        $template = ob_get_contents();
        ob_end_clean();
        echo $template;
    }
    /* else if($action === 'guest-table-delete'){
        $guestId = isset($_GET["guest_id"]) ? intval($_GET["guest_id"]) : ""; // It will be used in guest-edit page
        ob_start(); // For
        include_once plugin_dir_path(__FILE__) . 'views/guest-delete.php';
        $template = ob_get_contents();
        ob_end_clean();
        echo $template;
    } */
    else {
        ob_start(); // For
        include_once plugin_dir_path(__FILE__) . 'views/guest-list.php';
        $template = ob_get_contents();
        ob_end_clean();
        echo $template;
    }
}