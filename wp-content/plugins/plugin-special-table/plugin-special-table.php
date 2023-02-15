<?php

/* 
    *Plugin Name: Demo Table with special features
    *Description: Table with multiple features
    *Author: Milan Kumar
*/
add_action("admin_menu", "wpl_owt_list_table_menu");

function wpl_owt_list_table_menu() { 
    add_menu_page("OWT List Table", "OWT List Table", "manage_options", "owt-list-table", "owt_list_table_fn");
}

function owt_list_table_fn(){
    // echo "simple owt list table fn called";
    $action = isset($_GET["action"]) ? $_GET["action"] : '';
    echo "action $action";
    if($action === 'spl-table-edit') {
        $postId = isset($_GET["post_id"]) ? intval($_GET["post_id"]) : "";
        echo "postId: ".$postId;
        ob_start(); // For
        include_once plugin_dir_path(__FILE__) . 'views/spl-table-edit.php';
        $template = ob_get_contents();
        ob_end_clean();
        echo $template;

    }else {
        ob_start(); // For
        include_once plugin_dir_path(__FILE__) . 'views/owt-table-list.php';
        $template = ob_get_contents();
        ob_end_clean();
        echo $template;
    }
}