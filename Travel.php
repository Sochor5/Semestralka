<!DOCTYPE html>
<html>
<?php
session_start();
include "Travel_php/DBpost.php";
include "Travel_php/Post.php";
$db = new DB();

if ($_SESSION['logged']){
    if (isset($_GET['edit']) && isset($_POST['id'])){
        $updatePost = $db->loadOnePost($_POST['id']);
        $updatePost->text = $_POST['text'];
        $updatePost->nazov = $_POST['nazov'];
        $updatePost->strucnyText = $_POST['strucnyText'];
        $db->storePost($updatePost);
        header("Location: ?");
        die();
    }
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
 }
?>

<head>
    <meta charset="UTF-8">
    <title>Travel</title>
    <link rel="stylesheet" href="css/headerAFooter.css" type="text/css">
    <link rel="stylesheet" href="css/Travel.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

<?php  include "headerALL.php"?>
<div class="body">
    <?php
    if (isset($_GET['blog'])){
        include "Travel_php/Blog.php";
    }else {
        if (isset($_GET['New'])) {
            include "Travel_php/new_Blog.php";
        } else {
            if (isset($_GET['edit'])){
                include "Travel_php/edit_Blog.php";
            } else {
                include "Travel_php/post_Blog.php";
            }
        }
    } ?>
</div>
<?php  include "footerALL.php"?>
</body>
</html>