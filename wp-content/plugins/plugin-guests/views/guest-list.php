<?php

require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
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
        $allUsers = [];
        global $wpdb; 
        global $table_prefix;
        $table = $table_prefix . 'contact_us';
        if(!empty($searchTerm)) {
            $allUsers = $wpdb->get_results("SELECT * FROM {$table} WHERE email LIKE '%$searchTerm%' ORDER BY email DESC");
        }else {
            if($orderBy === 'email' && $order === 'desc') {
                $allUsers = $wpdb->get_results("SELECT * FROM {$table} ORDER BY email DESC");
            }else {
                $allUsers = $wpdb->get_results("SELECT * FROM {$table}");
            }
        }
        $final_posts = array();
        if(count($allUsers) > 0) {
            foreach($allUsers as $user) {
                $final_posts[] = array(
                    "id" => $user->id,
                    "title" => $user->name, // Don't use post['post_title']
                    "email" => $user->email,
                    "message" => substr($user->message, 0, 30)
                );
            }
        }
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
            "email" => "Email",
            "message" => "Message"
        );
        return $columns;
    }
    public function column_default($item, $column_name) {
        /* echo "\n".$column_name;
        echo "   Value: ".$item[$column_name]; */
        switch($column_name) {
            case 'id':
            case 'title': 
            case 'email':
            case 'message':
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
            "edit" => "<a id='edit_post_".$item['id']."' href='?page=".$_GET['page']."&action=guest-table-edit&guest_id=".$item['id']."' >Edit</a>",
            "delete" => '<a id="trash_post_'.$item["id"].'" href="?page='.$_GET["page"].'&action=guest-table-delete&guest_id='.$item["id"].'">Delete</a>'
        );
        // return sprintf('%1$s %2$s', $item['title'], $this->row_actions($action));
        return sprintf('%s %s', $item['title'], $this->row_actions($action));
    }

    public function get_hidden_columns() {
        // return array('id');
    }

    public function get_sortable_columns() {
        return array(
            'email' => array('email', true),
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
    echo "<h3>Registered Guests</h3>";
    $spl_table->display();
}

show_page_layout();
