
<html>
    <head>
        <title>tailoring</title>
    </head>
    <body>
        <h2 class="register-text">tailoring</h2>
        <hr>
        <form method="post">
            <div>
                <label>Prompt:</label><br>
                <input type="text" name="prompt" autocomplete="off" required>
            </div>
            <input type="Submit" name="tailoring_form">
        </form>
    </body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if(isset($_POST['tailoring_form'])) {
            $prompt = validate_input($_POST["prompt"]);
            $user_id = $_SESSION['ID'];

            $python_api_url = 'http://127.0.0.1:5000/tailoring';

            $ch = curl_init($python_api_url);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['prompt' => $prompt, 'user_id' => $user_id]));
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

            $current_directory = getcwd();
            echo "Current working directory: " . $current_directory;

            $response = curl_exec($ch);

            if ($response === false) {
                $error = curl_error($ch);
                echo "cURL Error: $error";
            } else {
                $data = json_decode($response, true);
                echo "<div>";
                echo "<p>{$data['introduction']}</p>";
                foreach ($data['outfits'] as $outfit) {
                    $image_path = "views\\uploaded_img\\{$user_id}\\{$outfit['id']}";
                    echo "<div>";
                    echo "<p><strong>Outfit:</strong> {$outfit['outfit']}</p>";
                    echo "<p>{$outfit['ware']}</p>";
                    echo "<img src='{$image_path}' alt='{$outfit['ware']}' style='max-width: 200px;'>";
                    echo "</div>";
                }
                echo "<p><strong>Reasoning:</strong> {$outfit['reasoning']}</p>";
                echo "<p>{$data['end']}</p>";
                echo "</div>";
            }
            curl_close($ch);
        }
    }
    ?>
</html>

