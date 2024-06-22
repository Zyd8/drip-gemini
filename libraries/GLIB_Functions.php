<?php 

function direct_to($path, $var = ""){
    header("Location: " . $path . $var);
}

?>