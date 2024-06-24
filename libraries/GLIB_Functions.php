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

function random_num($quantity){
    $number = "";
    if(is_int($quantity) && $quantity >= 1) {
        for($i = 0; $i < $quantity; $i++){
            $number .= random_int(0, 9);
        }
    } else {
        echo "INVALID INPUT: Must be an positive integer greater than or equal to 1.";
    }
    return $number;
}

?>