<?php 

function link_set($links){
    $new = explode(".", $links);
    return end($new);
}

?>