<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['register_form'])) {

        $username = validate_input($_POST["username"]);
        $password1 = validate_input($_POST["password1"]);
        $password2 = validate_input($_POST["password2"]);

        if($password1 == $password2) {

            if (authenticate("users", "username='$username'")) {

                echo "Username is Already taken";

            } else {

                $db = new database();

                $user = [
                    'username' => $username,
                    'password' => $password1
                ];

                $db->data_create("users", $user);
                $db->data_end();
                direct_to("/login");
                die;
            }
        }

        echo "Password Doesn't match";

    }

}

if(isset($_GET["a"]) == "d"){
    echo "Username is Already taken";
}

?>
