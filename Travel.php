<?php
session_start();
include "DB.php";
include "Post.php";

$db = new DB();


if (isset($_GET['delete'])){
    $db->remove($_GET['delete']);
}

if (isset($_POST['text'])) {
    if (isset($_POST['nazov'])) {
        if (isset($_POST['strucnyText'])){
            $newPost = new Post();
            $newPost->text = $_POST['text'];
            $newPost->nazov = $_POST['nazov'];
            $newPost->strucnyText = $_POST['strucnyText'];
            if (isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK) {
                $newName = "img" . DIRECTORY_SEPARATOR . time() . "_" . $_FILES["img"]["name"];
                if (move_uploaded_file($_FILES["img"]["tmp_name"], $newName)) {
                    $newPost->file = $newName;
                }
            }
            $db->storePost($newPost);

        }
    }

}

?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Travel</title>
    <link rel="stylesheet" href="css/headerAFooter.css" type="text/css">
    <link rel="stylesheet" href="css/Travel.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

<div class="header" >
    <a href="index.php" class="aktual" >HOME</a>
    <a href="Travel.php">TRAVEL</a>
    <a href="Travel.php">NIECO</a>
    <a href="#home" class="fa fa-search"></a>
</div>

<div class="body">


    <?php
    if (isset($_GET['blog'])){
        include "blog.php";

    }else {
        if (isset($_GET['New'])) {
            include "new-view.php";
        } else {
            include "post-view.php";
        }
    }
    ?>



</div>

<div class="footer">
    <footer class="footer padding">© 2021-2022 Žilinská univerzita v Žiline, Pavel Sochor.</footer>
    <a href="https://www.facebook.com/palo.sochor/" class="fa fa-facebook"></a>
    <a href="https://www.instagram.com/palasssochi/" class="fa fa-instagram"></a>
</div>

</body>
</html>
