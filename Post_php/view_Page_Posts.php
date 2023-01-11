<?php
/** @var DB $db */
?>
<div class="columns">
    <div class="main">
        <?php /** @var DB $db */
        foreach ($db->getALLPosts() as $post){
            if ($_GET['autorID'] == "all") { ?>
                <a href="?blog=<?php echo $post->idPost ?>">
                    <div class="block">
                        <h2> <?php echo $post->nazov  ?></h2>
                        <p><?php echo $post->strucnyText  ?> </p>
                        <?php
                        foreach ($db->getALLAutor() as $autor){
                            if ($autor->id_uzivatela == $post->id_pouzivatela__fk && $post->id_pouzivatela__fk != null) {?>
                                <p>Autor: <?php echo $autor->meno ?> <?php echo $autor->priezvisko  ?> </p>
                        <?php } } ?>
                        Tento článok sa páči <?php echo $db->GetLikes($post->idPost,1)  ?> čitateľom
                    </div>
                </a>
                <?php } else {
                if ($_GET['autorID'] == $post->id_pouzivatela__fk){?>
                    <a href="?blog=<?php echo $post->idPost ?>">
                        <div class="block">
                            <h2> <?php echo $post->nazov  ?></h2>
                            <p><?php echo $post->strucnyText  ?> </p> <?php
                            foreach ($db->getALLAutor() as $autor){
                                if ($autor->id_uzivatela == $post->id_pouzivatela__fk && $post->id_pouzivatela__fk != null) {?>
                                    <p>Autor: <?php echo $autor->meno ?> <?php echo $autor->priezvisko  ?> </p>

                                <?php } } ?>
                             Tento článok sa páči <?php echo $db->GetLikes($post->idPost,1)  ?> čitateľom
                        </div>
                    </a>
                <?php } }} ?>
        <?php if ($_SESSION['logged']){ ?>
            <a  href="?New&chyba=0">
                <div class="block newPost">
                    <h2> Novy post</h2>
                </div>
            </a>
        <?php } ?>
</div>
    <aside class="top5">
        <h2> Top blogy</h2>
        <?php $pocet = 0;
        foreach ($db->getALLPosts() as $post){
            if ($post->idPost != 0 ){
                if ($pocet < 5) {
                    ;
                    if ($_GET['autorID'] == "all") {
                        $pocet++?>
                        <a href="?blog=<?php echo $post->idPost ?>" ><p> <?php echo $post->nazov  ?> </p></a>
                    <?php } else {
                        if ($_GET['autorID'] == $post->id_pouzivatela__fk){
                            $pocet++?>
                            <a href="?blog=<?php echo $post->idPost ?>" ><p> <?php echo $post->nazov  ?> </p></a>
                            <?php

                        }}}}}?>
    </aside>
</div>
