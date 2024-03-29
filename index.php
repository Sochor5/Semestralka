<?php
session_start();
include "Post_php/DBpost.php";
include "phpClass/Post.php";
$db = new DB();
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <title>Title</title>
    <link rel="stylesheet" href="css/headerAFooter.css" type="text/css">
    <link rel="stylesheet" href="css/Travel.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php include "head_foot/headerALL.php" ?>
<div class="body">
    <div class="columnsIndex">
        <main class="mainIndex">
            <h2 class="index">Tento blog je pre každého </h2><br>
            <p class="index">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam luctus elit vel vulputate rhoncus.
                Nunc dictum mauris in leo pretium, et pellentesque purus volutpat. Integer vestibulum lobortis mi,
                vel rutrum quam. Sed imperdiet consectetur neque in fringilla. Aenean placerat hendrerit laoreet.
                Ut blandit condimentum augue feugiat semper. Maecenas a enim elit. Vestibulum hendrerit est eget
                nisi porttitor, et blandit urna tempor. In hac habitasse platea dictumst. Fusce ligula quam,
                consectetur vel sapien in, faucibus tristique erat. Aliquam ultricies lorem eget quam hendrerit pulvinar.
                Nulla pharetra leo in lobortis consectetur. Nullam a purus quis ligula vehicula scelerisque in ut purus.
                Mauris dictum leo ac orci faucibus, a hendrerit nisl placerat.
            </p><br>
            <p class="index">
                Vivamus dapibus est et libero porttitor, ornare tincidunt lacus viverra.
                Aenean ullamcorper efficitur nisi, id tristique ligula tristique id. Nulla
                facilisi. Mauris dictum faucibus arcu, sed luctus enim sollicitudin vitae. Aenean gravida a
                sem vitae convallis. Quisque euismod, leo ac mollis eleifend, felis ipsum commodo lacus, id vestibulum dolor ipsum a
                lacus. Donec bibendum porta dolor id aliquet. Aenean fermentum consequat pharetra.
            </p><br>
            <p class="index">
                Aliquam velit diam, convallis nec rhoncus vitae, mollis vitae diam.
                Ut pulvinar lectus et porta laoreet. Suspendisse aliquam finibus magna, nec
                posuere nisi hendrerit ut. Aenean accumsan ut tortor ut laoreet. Pellentesque
                habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                Mauris molestie augue quis aliquet mattis. Cras et consequat nunc. In gravida feugiat nibh.
                Nam tincidunt dapibus dolor at malesuada. Pellentesque tincidunt nibh elit, ut consectetur risus
                ultricies eu. Morbi in arcu eu nisl rutrum condimentum. Proin eget pulvinar nulla.
                Etiam sagittis lobortis risus, quis tempor arcu elementum in.
            </p><br>
            <p class="index">
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
            <p class="index">
                Nunc facilisis mauris porta semper ultrices. Sed sed erat consectetur,
                semper leo non, feugiat metus. Phasellus tempor ante a magna lobortis,
                eget aliquam neque sollicitudin. Sed id feugiat enim. Aliquam nec feugiat dui.
                Aenean finibus lacinia odio, in auctor nisl cursus non. Cras vestibulum ex id velit laoreet fringilla.
                Mauris sit amet lacus sit amet quam ullamcorper consectetur eget ac quam.
                Pellentesque consectetur elementum condimentum.
            </p><br>
        </main>
        <aside class="aboutme">
            <h3 class="index">AUTHORS</h3>
            <img class="index" alt="" src="1634331496115.jpg">
            <?php $pocetAutor = 0;
            foreach ($db->getALLAutor() as $autor){
                $pocet = 0;
                foreach ($db->getALLPosts() as $post){
                    if ($post->idPost != 0){
                        if ($pocet < 1) {
                            if ($post->id_pouzivatela__fk == $autor->id_uzivatela) {
                                $pocet++;
                                if ($pocetAutor < 5) {
                                    $pocetAutor++; ?>
                                    <a href="http://localhost/Post.php?autorID=<?php echo $autor->id_uzivatela ?>" ><p> <?php echo $autor->meno ?> <?php echo $autor->priezvisko  ?> </p></a>
                                <?php }}}}}}?>
        </aside>
    </div>
</div>
    <?php include "head_foot/footerALL.php" ?>
</body>
</html>
