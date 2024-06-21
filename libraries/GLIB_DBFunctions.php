<?php 
function authenticate ($tablename, $username, $password){
    $user_name = explode("=", $username);
    $pass_word = explode("=", $password);
    $un = $user_name[0];
    $un1 = $user_name[1];
    $pw = $pass_word[0];
    $pw1 = $pass_word[1];
    $db = new database ();
    $arr = ( $db->data_read("*", "$tablename", "$un = $un1 and $pw = $pw1"));
    $db->data_end();
    if(count($arr) >= 1){
        return true;
    } else {
        return false;
    }
}

?>