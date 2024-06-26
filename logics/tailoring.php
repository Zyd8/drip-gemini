<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['tailoring_form'])) {

        $prompt = validate_input($_POST["prompt"]);
        $user_id = $_SESSION['ID'];
        echo "User ID: $user_id<br>";
        $db = new Database();
        $image_paths = $db->getUserData('closet', 'path', $user_id);

        $python_api_url = 'http://127.0.0.1:5000/tailoring';

        $ch = curl_init($python_api_url);

        $post_fields = json_encode(['prompt' => $prompt, 'image_paths' => $image_paths]);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['prompt' => $prompt]));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($ch);

        if ($response === false) {
            $error = curl_error($ch);
            echo "cURL Error: $error";
        } else {
            $data = json_decode($response, true);
            echo "Response from Python API: ";
            print_r($data);
        }
        curl_close($ch);
    }
}
?>

