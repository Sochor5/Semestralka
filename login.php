<?php
session_start();
include "Post_php/DBpost.php";
$auth = new DB();
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/headerAFooter.css" type="text/css">
    <link rel="stylesheet" href="css/Travel.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php include "head_foot/headerALL.php" ?>
<div class="columnsBlogOpacne">
    <div class="login">
        <form method="post">
            <h1> travelan</h1>
            <h3>
                Travelan vám pomáha zdieľať vaše zážitky z cestovania s inými ľuďmi a inspirovať sa zážitkami druhých.</h3>
        </form>
    </div>
    <div class="log">
        <form method="post">
            <?php  if ($_GET['zle'] == 1) { ?>
                <p class="redText"> E-mail alebo heslo, ktoré ste zadali, nie je prepojené s účtom. </p>
            <?php }?>
            <input class="loginSize" type="text" name="login" placeholder="Email"><br>
            <input class="loginSize" type="password" name="Heslo" placeholder="Heslo"><br>
            <input class="loginSize buttonLog" type="submit" value="Prihlásiť sa"><br>
            <a href="NewAccount.php">
                Vytvoriť nový účet<br>
            </a>
        </form>
    </div>
</div>
<?php include "head_foot/footerALL.php" ?>
</body>
</html>