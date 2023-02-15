<?php

require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
require_once(ABSPATH . 'wp-content/demo-global.php');
class MyTableList extends WP_List_Table
{
    /* function __construct() {

    } */

    public function prepare_items() { 
        //$this means => Class Name: MyTableList, Parent Class Name: WP_List_Table
        $orderBy = isset($_GET['orderby']) ? $_GET['orderby'] : '';
        $order = isset($_GET['order']) ? $_GET['order'] : '';
        $searchTerm = isset($_POST['s']) ? trim($_POST['s']) : '';
        $dataItems = $this->get_wp_list_table_data($orderBy, $order, $searchTerm);
        $perPage = 3;
        $currentPage = $this->get_pagenum();
        $total_items = count($dataItems);
        $this->set_pagination_args(array('total_items' => $total_items, 'per_page' => $perPage));

        $this->items = array_slice($dataItems, ($currentPage - 1)*$perPage, $perPage);
        $columns = $this->get_columns();
        $hiddenColumns = $this->get_hidden_columns();
        $sortableColumns = $this->get_sortable_columns();
        $this->_column_headers = array($columns, $hiddenColumns, $sortableColumns);
    }

    public function get_wp_list_table_data($orderBy = '', $order = '', $searchTerm = '') {
        $all_posts = [];
        global $wpdb; 
        global $table_prefix;
        $table = $table_prefix . 'posts';
        if(!empty($searchTerm)) {
            $all_posts = $wpdb->get_results("SELECT * FROM {$table} WHERE post_type = 'post' AND post_status = 'publish' AND post_title LIKE '%$searchTerm%' ORDER BY post_title DESC");
        }else {
            if($orderBy === 'title' && $order === 'desc') {
                $all_posts = $wpdb->get_results("SELECT * FROM {$table} WHERE post_type = 'post' AND post_status = 'publish' ORDER BY post_title DESC");
            }else {
                $all_posts = $wpdb->get_results("SELECT * FROM {$table} WHERE post_type = 'post' AND post_status = 'publish'");
            }
        }
        $final_posts = array();
        if(count($all_posts) > 0) {
            foreach($all_posts as $post) {
                $final_posts[] = array(
                    "id" => $post->ID,
                    "title" => $post->post_title, // Don't use post['post_title']
                    "slug" => $post->post_name,
                    "content" => substr($post->post_content, 0, 30)
                );
            }
        }
        // $this->display_data($final_posts);
        return $final_posts;       
    }
    

    public function display_data($data) {
        echo "<pre>";
        print_r($data);
    }

    public function display_die($data) {
        echo "<pre>";
        print_r($data);
        die();
    }

    public function get_columns(){
        $columns = array(
            "cb" => "<input type='checkbox' />",
            "id" => "ID",
            "title" => "Title",
            "content" => "Content",
            "slug" => "Slug",
        );
        return $columns;
    }
    public function column_default($item, $column_name) {
        /* echo "\n".$column_name;
        echo "   Value: ".$item[$column_name]; */
        switch($column_name) {
            case 'id':
            case 'title': 
            case 'slug':
            case 'content':
                return $item[$column_name];
            case 'cb':
                return 'checkBox';
            default: 
                return "no value";
        }
    }

    public function get_bulk_actions() {
        return array(
            "edit" => "Modify",
            "delete" => "Remove"
        );
    }

    public function column_cb($item) {
        return sprintf('<input type="checkbox" name="post[]" value="%s" />', $item['id']);
    }

    public function column_title($item) {
        $action = array(
            "edit" => "<a id='edit_post_".$item['id']."' href='?page=".$_GET['page']."&action=spl-table-edit&post_id=".$item['id']."' >Edit</a>",
            "delete" => '<a id="trash_post_'.$item["id"].'" href="?page'.$_GET["page"].'&action=spl-table-delete&post_id='.$item["id"].'">Delete</a>'
        );
        // return sprintf('%1$s %2$s', $item['title'], $this->row_actions($action));
        return sprintf('%s %s', $item['title'], $this->row_actions($action));
    }

    public function get_hidden_columns() {
        // return array('id');
    }

    public function get_sortable_columns() {
        return array(
            'title' => array('title', true),
            // 'email' => array('email', false)
        );
    }

    public function test_fun() {
        return "it is child class Func";
    }
}

/* public function owt_show_list_table_layout() {
    $owt_list_table = new OWTListTableClass();
    $owt_list_table->prepare_items();
    $owt_list_table->display();
} */

function show_page_layout()
{
    $spl_table = new MyTableList();
    $spl_table->prepare_items();
    $url = $_SERVER['PHP_SELF'].'?page=owt-list-table'; 
    echo "<form method='post' name='search_post' action='{$url}'>";
    $spl_table->search_box("Find Post", "search_box_post");
    echo "</form>";
    echo "<h3>This is special table</h3>";
    $spl_table->display();
}

show_page_layout();
