<?php 

class debug {
    public static function dump ($value) {
        echo "<pre>";
        var_dump($value);
        echo "</pre>";
    }
}

?>