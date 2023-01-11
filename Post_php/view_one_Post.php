<?php
/** @var Post $post */
/** @var DB $db */
/** @var Komentar $koment */



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
            <?php
            foreach ($db->getALLAutor() as $autor){
                if ($autor->id_uzivatela == $post->id_pouzivatela__fk && $post->id_pouzivatela__fk != null) {?>
                <p> Autor článku je  <?php echo $autor->meno ?> <?php echo $autor->priezvisko  ?> </p>
                <p> </p>
            <?php } } ?>
            <?php if ($_SESSION['logged']){
            if ($post->id_pouzivatela__fk == $_SESSION['id_uzivatela']){
                ?>
                <a href="?edit=<?php echo $post->idPost ?>&chyba=0&blog1=<?php echo $post->idPost ?>" >
                    <br>
                    Edit
                </a><br><br>
                <a href="?delete=<?php echo $post->idPost ?>" >
                    Vymaz
                </a><br>
            <?php }
                if ($db->getLikePostUser($post->idPost,$_SESSION['id_uzivatela'])) { ?>
                    <form method="post">
                        <input class="loginSize buttonLogRed"  type="submit" name="like" value="Tento článok sa mi už nepáči"><br>
                    </form>
               <?php } else { ?>
                    <form method="post">
                        <input class="loginSize buttonLog"  type="submit" name="like" value="Tento článok sa mi páči"><br>
                    </form>
            <?php    } }  ?>
        </main>
    </div>

            <div class="columnsBlog">
                <main class="mainBlog">

            <h3> Diskusia:
                <?php echo $db->GetLikes($post->idPost,2 )  ?> príspevky</h3>
            <?php
            foreach ($db->getALLKomentFromPost($_GET['blog']) as $koment){
                ?> <main class="komentColor"> <?php
                if (isset($_GET['EditKoment'])){
                    include "Post_php/view_one_Post.php";
                } else {
                foreach ($db->getALLAutor() as $autor){
                    if ($autor->id_uzivatela == $koment->id_uzivatela && $koment->id_uzivatela != null) {?>
                        <p><?php echo $autor->meno ?> <?php echo $autor->priezvisko  ?> </p>
                    <?php } } ?>
                    <p><?php echo $koment->text_komentu ?>  </p>
            <?php if ($_SESSION['logged']){
                if ($koment->id_uzivatela == $_SESSION['id_uzivatela']){
                ?>
                <a href="?EditKoment=<?php echo $koment->id_komentu ?>&blog1=<?php echo $post->idPost ?>" >
                    edit komentar
                </a><br>
                <a href="?deleteKoment=<?php echo $koment->id_komentu ?>&blog1=<?php echo $post->idPost ?>"" >
                    Vymaz komentar
                </a><br>

                <?php }  }} ?></main> <?php } ?>
            <?php if ($_SESSION['logged']){ ?>
            <form method="post">
                <input class="loginSize" type="text" name="textkomentu" placeholder="Napíšte komentár…">
                <input class=" buttonLog" type="submit" value="Uverejniť"><br>
            </form>
            <?php  } ?>



        </main>
    </div>
</div>
