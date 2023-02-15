<h3>Post Data</h3>
<?php 
    global $wpdb;
    global $table_prefix;
    $table = $table_prefix . 'contact_us';
    if($action === 'guest-table-delete') {
        $deleted = $wpdb->delete($table, array("id" => $guestId));
        // echo "delete: ".$deleted;
        // header('Location: https://www.google.com/');
        // header("Location: ?page=".$_GET['page']);
        // wp_redirect( 'https://www.google.com/' );
        return true;
    }
    $guestDetails = $wpdb->get_row("SELECT * FROM $table WHERE id=$guestId");

    if($action === 'guest-table-edit' && isset($_POST['txt_name'])) {
        $rowUpdated = $wpdb->update($table, array(
            "name" => $_POST['txt_name'],
            "message" => $_POST['txt_content'],
            "email" => $_POST['txt_email'],
        ), array(
            "id" => $guestId
        ));
        if($rowUpdated && $rowUpdated > 0) {
            $guestDetails = $wpdb->get_row("SELECT * FROM $table WHERE id=$guestId");
        }
    }
?>
<form method="post" action="">
<p>
    <label>Title</label>
    <input type="text"  name="txt_name" value="<?php echo $guestDetails->name ?>"/>
</p>
<p>
    <label>Message</label>
    <textarea name="txt_content"><?php echo $guestDetails->message ?></textarea>
</p>
<p>
    <label>Email</label>
    <input type="text"  name="txt_email" value="<?php echo $guestDetails->email ?>"/>
</p>
<p>
    <button type="submit" name="btnsubmit"> Update </button>
</p>
</form>