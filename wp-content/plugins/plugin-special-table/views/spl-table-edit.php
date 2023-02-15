<h3>Post Data</h3>
<?php 
    $postDetails = get_post($postId);
    global $wpdb;
    global $table_prefix;
    if($action === 'spl-table-delete') {
        $wpdb->delete($table_prefix .'posts', array("id" => $postId));
        return true;
    }
    if(isset($_POST['txt_name'])) {
        $rowUpdated = $wpdb->update($table_prefix .'posts', array(
            "post_title" => $_POST['txt_name'],
            "post_content" => $_POST['txt_content'],
            "post_name" => $_POST['txt_slug'],
        ), array(
            "id" => $postId
        ));
        if($rowUpdated && $rowUpdated > 0) {
            $postDetails = get_post($postId);
            print_r($postDetails);
        }
    }
?>
<form method="post" action="">
<p>
    <label>Title</label>
    <input type="text"  name="txt_name" value="<?php echo $postDetails->post_title ?>"/>
</p>
<p>
    <label>Content</label>
    <textarea name="txt_content"><?php echo $postDetails->post_content ?></textarea>
</p>
<p>
    <label>Post Slug</label>
    <input type="text"  name="txt_slug" value="<?php echo $postDetails->post_name ?>"/>
</p>
<p>
    <button type="submit" name="btnsubmit"> Submit Details</button>
</p>
</form>