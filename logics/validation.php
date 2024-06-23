<?php

if(!isset($_SESSION["ID"])) {
    direct_to("/login");
}

?>