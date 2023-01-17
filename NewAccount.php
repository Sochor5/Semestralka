<?php
include "Post_php/DBpost.php";
$auth = new DB();
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="css/headerAFooter.css" type="text/css">
    <link rel="stylesheet" href="css/Travel.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php include "head_foot/headerALL.php" ?>
<div class="columnsBlog">
    <div class="mainBlog">
        <h1>Registrácia
        </h1>
        <h4>Je to rýchle a jednoduché.</h4>
        <?php
        if (isset($_SESSION['Existuje'])){
        ?> Užívateľ s daným emailom už existuje. Zadajte iný email   <?php
        }?>
        <form method="post" onsubmit="return validateForm()">
            <input class="loginSizeNEW" type="text" name="newMeno" placeholder="meno" id="kontrolaMena"><br>
            <input class="loginSizeNEW" type="text" name="newPriezvisko" placeholder="priezvisko" id="kontrolaPriezvisko"><br>
            <input class="loginSizeNEW" type="text" name="email" placeholder="email" id="kontrolaemail" ><br>
            <input class="loginSizeNEW" type="password" name="newHeslo" placeholder="heslo"  id="pw1"><br>

            <input class="loginSizeNEW" type="password" name="newHeslo" placeholder="Zopakujte prosím heslo" id="pw2">
            <span id = "message2" style="color:red"> </span><br>
            <input class="loginSize buttonLog" type="submit"  value="Registrácia"><br>
        </form>
    </div>
</div>
<?php include "head_foot/footerALL.php" ?>
<script>
    function validateForm() {
        var usernameRegex = /^[a-zA-Z]+$/;
        var username = document.getElementById("kontrolaMena").value;
        var validUsername = document.getElementById("kontrolaMena").value.match(usernameRegex);
        var userSurname = document.getElementById("kontrolaPriezvisko").value;
        var validUserSurname = document.getElementById("kontrolaPriezvisko").value.match(usernameRegex);
        if (validUsername == null) {
            alert("Vaše uživateľské meno nie je validné! Jediné povolené charaktery sú A-Z, a-z.");
            return false;
        }
        if (username.length >= '20') {
            alert("Vaše meno je moc dlhé! Maximálny počet znakov je 20.");
            return false;
        }
        if (validUserSurname == null) {
            alert("Vaše uživateľské priezvisko nie je validné! Jediné povolené charaktery sú A-Z, a-z.");
            return false;
        }
        if (userSurname.length >= '30') {
            alert("Vaše priezvisko je moc dlhé! Maximálny počet znakov je 30.");
            return false;
        }
        var emailRegex = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
        var validEmail = document.getElementById("kontrolaemail").value.match(emailRegex);
        if (validEmail == null) {
            alert("Váš mail je chybný. Správny tvar: mail@domena.domena");
            return false;
        }
        var lowerCaseLetters = /[a-z]/g;
        var upperCaseLetters = /[A-Z]/g;
        var numbers = /[0-9]/g;
        var specialCharacter = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/g;
        var pw1LC  = document.getElementById("pw1").value.match(lowerCaseLetters);
        var pw1UC  = document.getElementById("pw1").value.match(upperCaseLetters);
        var pw1NU  = document.getElementById("pw1").value.match(numbers);
        var pw1SC  = document.getElementById("pw1").value.match(specialCharacter);
        var pw1  = document.getElementById("pw1").value;
        var pw2 = document.getElementById("pw2").value;
        if (pw1LC == null || pw1UC == null||pw1NU == null ||pw1SC == null ) {
            alert("Vaše heslo nespĺňa podmienky silného hesla. Skontrolujete si ci obsahuje: malé písmeno, veľké písmeno, číslo a špeciálny znak");
            return false;
        }
        if(pw1.length < 8) {
            alert ("Dĺžka hesla musí byť aspoň 8 znakov ");
            return false;
        }
        if(pw1.length > 15) {
            alert ("Dĺžka hesla nesmie presiahnuť 25 znakov");
            return false;
        }
        if(pw1 != pw2) {
            document.getElementById("message2").innerHTML = "**Passwords are not same";
            return false;
        } else {
            alert ("Your password created successfully");
        }
    }
</script>
</body>
</html>