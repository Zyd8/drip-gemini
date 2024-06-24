<?php
require('logics/validation.php'); 
require('logics/closet-form.php');
require('logics/closet-show.php');
require('logics/closet-delete.php');
require('logics/functions.php');
?>

<html>
    <head>
        <title>
            Closet Page
        </title>
        <link rel="stylesheet" type="text/css" href="assets/css/closet.css">
    </head>

    <body>
        <h2 class="login-text">Closet</h2>
        <hr>
        <form method="post" enctype="multipart/form-data">
            <label>Picture Name:</label><br>
            <input type="text" name="filename" required><br>
            <label>Upload here:</label><br>
            <input type="file" name="image" id="image"><br>
            <input type="submit" name="closet_form">
        </form>

        <div style="display: flex">

            <?php foreach($datas as $data): ?>
                <div>
                    <img class="upload-imgs" src="<?php echo $data['path']; ?>" alt="Img-Upload"> <br>
                    <a href="?dvx=<?php echo link_okay($data['ID']); ?>&idshs=<?php echo link_okay($data['file_name']); ?>&pasdsf=<?php echo link_okay(link_set($data['path'])); ?>">Delete</a>
                </div>
            <?php endforeach; ?>

        </div>

    </body>
</html>