<?php

?>
<div class="columns">
    <div class="main">
        <?php /** @var DB $db */
        foreach ($db->getALLPosts() as $post){ ?>
        <a href="?blog=<?php echo $post->idPost ?>">
            <div class="block">
                <h2> <?php echo $post->nazov  ?></h2>
                <p><?php echo $post->strucnyText  ?> </p>
            </div>
        </a><?php } ?>

        <a  href="?New">
            <div class="block newPost">
                <h2> Novy post</h2>
            </div>

        </a>

    </div>

    <aside class="top5">
        <h2> Top blogy</h2>
        <?php $pocet = 0;
        foreach ($db->getALLPosts() as $post){
            if ($post->idPost != 0 ){
                if ($pocet < 5) {
                    $pocet++; ?>
        <a href="Blog.html" ><p> <?php echo $post->nazov  ?> </p></a>
        <?php }}}?>
    </aside>
</div>