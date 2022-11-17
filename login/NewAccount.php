<?php
?>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="../css/headerAFooter.css" type="text/css">
    <link rel="stylesheet" href="../css/Travel.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>


<div class="header" >
    <a href="../index.php" class="aktual" >HOME</a>
    <a href="../Travel.php">TRAVEL</a>
    <a class="rightHeader" href="login.php">LOGIN</a>
    <a  href="#home" class="fa fa-search"></a>


</div>
<div class="columnsBlog">
    <div class="mainBlog">
        <form method="post">
            <h1>Registrácia
                </h1>
            <h4>Je to rýchle a jednoduché.</h4>
            <input class="loginSize" type="text" name="meno" placeholder="meno"><br>
            <input class="loginSize" type="text" name="priezvisko" placeholder="priezvisko"><br>
            <input class="loginSize" type="text" name="login" placeholder="Username"><br>
            <input class="loginSize" type="text" name="Heslo" placeholder="Heslo"><br>
            <a href="NewAccount.php">
                <button class="loginSize" type="button" class="button2" >Registrácia</button>
            </a>
        </form>
    </div>
</div>


<div class="footer">
    <footer class="footer padding">© 2021-2022 Žilinská univerzita v Žiline, Pavel Sochor.<br>
    <a href="https://www.facebook.com/palo.sochor/" class="fa fa-facebook"></a>
    <a href="https://www.instagram.com/palasssochi/" class="fa fa-instagram"></a>
    </footer>
</div>

</body>
</html>
