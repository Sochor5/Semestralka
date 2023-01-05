<?php
/** @var DBuser $auth */
?>
<div class="columns">
    <div class="main">
        <?php /** @var DB $db */
        foreach ($db->getALLPosts() as $post){ ?>
        <a href="?blog=<?php echo $post->idPost ?>">
            <div class="block">
                <h2> <?php echo $post->nazov  ?></h2>
                <p><?php echo $post->strucnyText  ?> </p>
                <?php
                foreach ($auth->getALLAutor() as $autor){
                    if ($autor->id_uzivatela == $post->id_pouzivatela__fk && $post->id_pouzivatela__fk != null) {?>
                        <p>Autor: <?php echo $autor->meno ?> <?php echo $autor->priezvisko  ?> </p>
                        <p> </p>
                    <?php } } ?>


                Tento článok sa páči
                <?php echo $db->GetLikes($post->idPost,1)  ?>
                čitateľom
            </div>

        </a><?php } ?>

        <?php if ($_SESSION['logged']){ ?>
            <a  href="?New">
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
                    $pocet++; ?>
        <a href="?blog=<?php echo $post->idPost ?>" ><p> <?php echo $post->nazov  ?> </p></a>
        <?php }}}?>
    </aside>
</div>