<?php 

if(isset($_GET['dvx']) && isset($_GET['idshs']) && isset($_GET['pasdsf'])){
    $delete_by_id = $_GET['dvx'];
    $delete_by_name = $_GET['idshs'];
    $_delete_by_type = $_GET['pasdsf'];
    $name_id = $delete_by_name . $delete_by_id;

    $userid = $_SESSION['ID'];

    $path = 'views/uploaded_img/' . $userid . '/' . $name_id . "." . $_delete_by_type;

    echo $path;

    if (file_exists($path)) {
        unlink($path);
    }
    $db = new database();
    $db->data_delete("closet", "ID='$delete_by_id'");
    $db->data_end();
    direct_to("/closet");

}   

?>