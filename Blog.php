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
            <img alt="" src="https://www.thestoryofacake.sk/wp-content/uploads/2015/04/buda32-1-of-1-1024x682.jpg"><br>
            <a href="?delete=<?php echo $post->idPost ?>" >
            <button type="button button1" class="button1">Vymaz</button>
            </a>
        </main>
    </div>
</div>
<?php

?>






