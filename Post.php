<!DOCTYPE html>
<html>
<?php
session_start();
include "Post_php/DBpost.php";
include "phpClass//Post.php";
include "phpClass//Komentar.php";
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
                $newPost->id_uzivatela = $_SESSION['id_uzivatela'];
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

<?php include "head_foot/headerALL.php" ?>
<div class="body">
    <?php
    if (isset($_GET['blog'])){
        include "Post_php/view_one_Post.php";
    }else {
        if (isset($_GET['New'])) {
            include "Post_php/new_Post.php";
        } else {
            if (isset($_GET['edit'])){
                include "Post_php/edit_Post.php";
            } else {
                if (isset($_GET['EditKoment'])){
                    include "Post_php/edit_Komentar.php";
                } else {
                    include "Post_php/view_Page_Posts.php";
                }
            }


        }
    } ?>
</div>
<?php include "head_foot/footerALL.php" ?>
</body>
</html>