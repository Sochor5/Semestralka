<?php
/** @var Post $post */
/** @var DB $db */

$post = $db->loadOnePost($_GET['blog']);
    ?>

<div class="body">
    <div class="columnsBlog">
        <main class="mainBlog">
            <h2><?php echo $post->nazov ?></h2><br>
            <p><?php echo $post->text ?></p><br>
            <?php if ($post->file) {?>
            <img src="<?php  echo  $post->file ?>" class="card-img-top" alt="..."><br>
            <?php } ?>



            <a href="?edit=<?php echo $post->idPost ?>" >
                <button type="button" class="button2">Edit</button>
            </a><br>

            <a href="?delete=<?php echo $post->idPost ?>" >
                <button type="button" class="button1">Vymaz</button>
            </a>
        </main>
    </div>
</div>
<?php

?>






