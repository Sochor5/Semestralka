<!DOCTYPE html>
<html>
<?php
session_start();
include "Post_php/DBpost.php";
include "phpClass/Post.php";
include "phpClass/Komentar.php";
$db = new DB();
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
                } else{
                    if (isset($_GET['view_Page_Authors'])){
                        include "Post_php/view_Page_Authors.php";
                    } else {
                        if (isset($_GET['autorID'])){
                            include "Post_php/view_Page_Posts.php";
                        } else {
                            $_GET['autorID'] = "all";
                            include "Post_php/view_Page_Posts.php";
                        }

                    }
                }
            }
        }
    } ?>
</div>
<?php include "head_foot/footerALL.php" ?>
</body>
</html>