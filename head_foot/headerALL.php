
<div class="header" >
    <a href="../index.php" class="aktual" >HOME</a>
    <a href="../Post.php">POST</a>
    <a href="../Post.php?view_Page_Authors">AUTHORS</a>
    <?php if ($_SESSION['logged']){ ?>
        <a class="rightHeader" href="../login.php?odhlas">ODHLASIT</a>
    <?php }  else {?>
        <a class="rightHeader" href="../login.php">LOGIN</a>
    <?php  } ?>
    <a  href="#home" class="fa fa-search"></a>
</div>