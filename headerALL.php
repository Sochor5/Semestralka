<?php?>
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="css/headerAFooter.css" type="text/css">
 </head>
<div class="header" >
    <a href="index.php" class="aktual" >HOME</a>
    <a href="Travel.php">TRAVEL</a>
    <?php if ($_SESSION['logged']){ ?>
        <a class="rightHeader" href="login.php?odhlas">ODHLASIT</a>
    <?php }  else {?>
        <a class="rightHeader" href="login.php">LOGIN</a>
    <?php  } ?>
    <a  href="#home" class="fa fa-search"></a>
</div>