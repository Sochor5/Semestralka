<?php
session_start();
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="css/headerAFooter.css" type="text/css">
    <link rel="stylesheet" href="css/home.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="header" >
    <a  href="http://localhost:58849/semestralka/HTML.html?_ijt=kj6h6rt8bb1r2dmij1j3h62h0a&_ij_reload=RELOAD_ON_SAVE" class="aktual" >HOME</a>
    <a href="Travel.php">TRAVEL</a>
    <?php if ($_SESSION['logged']){ ?>
        <a class="rightHeader" href="login/login.php?odhlas">ODHLASIT</a>
    <?php }  else {?>
        <a class="rightHeader" href="login/login.php">LOGIN</a>
    <?php  } ?>
    <a  href="#home" class="fa fa-search"></a>
</div>
<div class="body">
    <div class="columns">
        <main class="main">
            <h2>Lorem Ipsum</h2><br>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam luctus elit vel vulputate rhoncus.
                Nunc dictum mauris in leo pretium, et pellentesque purus volutpat. Integer vestibulum lobortis mi,
                vel rutrum quam. Sed imperdiet consectetur neque in fringilla. Aenean placerat hendrerit laoreet.
                Ut blandit condimentum augue feugiat semper. Maecenas a enim elit. Vestibulum hendrerit est eget
                nisi porttitor, et blandit urna tempor. In hac habitasse platea dictumst. Fusce ligula quam,
                consectetur vel sapien in, faucibus tristique erat. Aliquam ultricies lorem eget quam hendrerit pulvinar.
                Nulla pharetra leo in lobortis consectetur. Nullam a purus quis ligula vehicula scelerisque in ut purus.
                Mauris dictum leo ac orci faucibus, a hendrerit nisl placerat.
            </p><br>
            <p>
                Vivamus dapibus est et libero porttitor, ornare tincidunt lacus viverra.
                Aenean ullamcorper efficitur nisi, id tristique ligula tristique id. Nulla
                facilisi. Mauris dictum faucibus arcu, sed luctus enim sollicitudin vitae. Aenean gravida a
                sem vitae convallis. Quisque euismod, leo ac mollis eleifend, felis ipsum commodo lacus, id vestibulum dolor ipsum a
                lacus. Donec bibendum porta dolor id aliquet. Aenean fermentum consequat pharetra.
            </p><br>
            <p>
                Aliquam velit diam, convallis nec rhoncus vitae, mollis vitae diam.
                Ut pulvinar lectus et porta laoreet. Suspendisse aliquam finibus magna, nec
                posuere nisi hendrerit ut. Aenean accumsan ut tortor ut laoreet. Pellentesque
                habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                Mauris molestie augue quis aliquet mattis. Cras et consequat nunc. In gravida feugiat nibh.
                Nam tincidunt dapibus dolor at malesuada. Pellentesque tincidunt nibh elit, ut consectetur risus
                ultricies eu. Morbi in arcu eu nisl rutrum condimentum. Proin eget pulvinar nulla.
                Etiam sagittis lobortis risus, quis tempor arcu elementum in.
            </p><br>
            <p>
                Interdum et malesuada fames ac ante ipsum primis in faucibus. Nam et tempor est.
                Praesent dapibus, dui eget varius porta, est purus iaculis urna, nec convallis felis
                lorem a neque. Curabitur a maximus augue. Class aptent taciti sociosqu ad litora torquent
                per conubia nostra, per inceptos himenaeos. Ut quis libero fermentum, fringilla leo sit amet,
                venenatis eros. Ut ac diam at ex ullamcorper auctor. Nam finibus elementum libero pulvinar tempor.
                Vivamus at posuere eros. Donec accumsan nunc at sodales placerat. Nullam nec tortor quis velit aliquet
                mattis et sit amet est. Duis vulputate tortor eleifend nunc scelerisque, tempor finibus dolor interdum.
                Morbi quis odio lacus. Morbi non vestibulum tellus, vitae aliquam mauris. Etiam a tellus tincidunt,
                pharetra mi auctor, finibus purus. Vestibulum ultricies semper malesuada.
            </p><br>
            <p>
                Nunc facilisis mauris porta semper ultrices. Sed sed erat consectetur,
                semper leo non, feugiat metus. Phasellus tempor ante a magna lobortis,
                eget aliquam neque sollicitudin. Sed id feugiat enim. Aliquam nec feugiat dui.
                Aenean finibus lacinia odio, in auctor nisl cursus non. Cras vestibulum ex id velit laoreet fringilla.
                Mauris sit amet lacus sit amet quam ullamcorper consectetur eget ac quam.
                Pellentesque consectetur elementum condimentum.
            </p><br>
        </main>
        <div class="aboutme">
            <h3> ABOUT ME</h3>
            <img alt="" src="1634331496115.jpg">
            <p>Nunc lobortis orci diam, eu laoreet quam consectetur vitae. Curabitur vitae lectus
                lacinia, eleifend dui ac, vehicula sapien. Nullam eleifend varius orci in sagittis.
                Duis sit amet fermentum lacus, sed luctus velit. Aliquam sodales vel augue eu suscipit.
                Maecenas neque felis, ornare in neque at, posuere pellentesque eros. Phasellus fringilla,
                ipsum sed tempus semper, ante augue luctus lorem, id ultricies sem nunc eget sem. Phasellus
                porta massa ac eros volutpat mollis et at justo. Suspendisse viverra eros eu velit lobortis egestas
                nec nec diam. Fusce viverra molestie nulla non suscipit. Donec sit amet
                condimentum orci. Vestibulum quis ipsum commodo, iaculis leo sed, auctor mauris.</p>
        </div>
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
