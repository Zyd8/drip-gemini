<?php
if($_SERVER['REQUEST_METHOD'] == "POST") {
    if(isset($_POST['closet_form'])) {

        $name = validate_input($_POST['filename']);
        if($_FILES['image']['error'] === 4){
            echo "FILE UPLOAD ERROR: File doesn't exist";

        } else {
            $filename = $_FILES['image']['name'];
            $filesize = $_FILES['image']['size'];
            $tmpname = $_FILES['image']['tmp_name'];

            $valid_input = ['jpg', 'jpeg', 'png', 'webp', '.heic', 'heif'];
            $imgtype = explode(".", $filename);
            $imgtype = strtolower(end($imgtype));

            if(!in_array($imgtype, $valid_input)){

                echo "FILE UPLOAD ERROR: Uploaded file doesn't meet file type requirements.";
            
            } else {

                if($filesize > 10000000) {

                    echo "FILE UPLOAD ERROR: Uploaded file is too large.";

                } else {

                    $db = new database();
                    $generated_id = random_num(10);
                    $user_id = $_SESSION['ID'];

                    $has = authenticate("closet", "id=$generated_id");

                    while($has) {
                        $generated_id = random_num(10);
                        $has = authenticate("closet", "id=$generated_id");
                    }

                    $new_name = $name . $generated_id;
                    $new_name .= "." . $imgtype;

                    $parent_directory = "views/uploaded_img";
                    $full_path = $parent_directory . "/" . $user_id;
                    if(!is_dir($full_path)) {
                        mkdir($full_path, 0755, true);
                    }

                    $pathwithimg = $parent_directory . "/" . $user_id . "/" . $new_name;

                    compress_image_and_move($tmpname, $pathwithimg, 70);

                    $closets = [
                        'ID' => $generated_id,
                        'user_id' => $user_id,
                        'path' => $pathwithimg,
                        'file_name' => $name
                    ];

                    $db->data_create("closet", $closets);
                    $db->data_end();
                    direct_to("/closet");
                }
            }

        }
    }
}

function compress_image_and_move($source, $destination, $quality) {
    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg' || $info['mime'] == 'image/pjpeg') {
        $image = imagecreatefromjpeg($source);
        imagejpeg($image, $destination, $quality);
    } elseif ($info['mime'] == 'image/png') {
        $image = imagecreatefrompng($source);
        imagepng($image, $destination, floor($quality / 9));
    } elseif ($info['mime'] == 'image/webp') {
        $image = imagecreatefromwebp($source);
        imagewebp($image, $destination, $quality);
    } 
     else {
        echo "FILE UPLOAD ERROR: Unsupported image type.";
        return;
    }

    imagedestroy($image);
}

?>