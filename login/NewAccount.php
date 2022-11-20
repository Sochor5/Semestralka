<?php
include "DBuser.php";

$auth = new DBuser();
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
        <h1>Registrácia
        </h1>
        <h4>Je to rýchle a jednoduché.</h4>
        <form method="post" onsubmit="return validateForm()">
            <input class="loginSize" type="text" name="newMeno" placeholder="meno" ><br>
            <input class="loginSize" type="text" name="newPriezvisko" placeholder="priezvisko"><br>
            <input class="loginSize" type="text" name="email" placeholder="email" id="email" ><br>
            <input class="loginSize" type="text" name="newHeslo" placeholder="Heslo"><br>
            <input class="loginSize buttonLog" type="submit"  value="Registrácia"><br>

        </form>
    </div>
</div>


<div class="footer">
    <footer class="footer padding">© 2021-2022 Žilinská univerzita v Žiline, Pavel Sochor.<br>
    <a href="https://www.facebook.com/palo.sochor/" class="fa fa-facebook"></a>
    <a href="https://www.instagram.com/palasssochi/" class="fa fa-instagram"></a>
    </footer>
</div>
<script>
    function validateForm() {
        var emailRegex = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
        var validEmail = document.getElementById("email").value.match(emailRegex);
        if (validEmail == null) {
            alert("Váš mail je chybný. Správny tvar: mail@domena.domena");
            return false;
        }
    }
</script>
</body>
</html>
