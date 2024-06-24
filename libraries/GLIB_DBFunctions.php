<?php 
function authenticate_both ($tablename, $argument1, $argument2){
    $argument1ex = explode("=", $argument1);
    $argument2ex = explode("=", $argument2);
    $un = $argument1ex[0];
    $un1 = $argument1ex[1];
    $pw = $argument2ex[0];
    $pw1 = $argument2ex[1];
    $db = new database ();
    $arr = ( $db->data_read("*", "$tablename", "$un = $un1 and $pw = $pw1"));
    $db->data_end();
    if(count($arr) >= 1){
        return true;
    } else {
        return false;
    }
}

function authenticate ($tablename, $argument1){
    $argument1ex = explode("=", $argument1);
    $un = $argument1ex[0];
    $un1 = $argument1ex[1];
    $db = new database ();
    $arr = ( $db->data_read("*", "$tablename", "$un = $un1"));
    $db->data_end();
    if(count($arr) >= 1){
        return true;
    } else {
        return false;
    }
}

?>