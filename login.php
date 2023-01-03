<?php
session_start();
include "login/DBuser.php";
$auth = new DBuser();
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/headerAFooter.css" type="text/css">
    <link rel="stylesheet" href="css/Travel.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>


<?php include "head_foot/headerALL.php" ?>
<div class="columnsBlog">
    <div class="mainBlog login">
        <form method="post">
            <h1> travelan</h1>
            <h3>
                Travelan vám pomáha zdieľať vaše zážitky z cestovania s inými ľuďmi a inspirovať sa zážitkami druhých.</h3>
        </form>
    </div>
    <div class="mainBlog log">
        <form method="post">
            <input class="loginSize" type="text" name="login" placeholder="Username"><br>
            <input class="loginSize" type="text" name="Heslo" placeholder="Heslo"><br>
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
