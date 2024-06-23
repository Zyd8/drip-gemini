<?php 

function direct_to($path, $var = ""){
    header("Location: " . $path . $var);
}

function validate_input($input){
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

?>