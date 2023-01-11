<?php
/** @var Post $post */
/** @var DB $db */

$post = $db->loadOnePost($_GET['edit']);
?>
<div class="body">
    <div class="columnsBlog">
        <main class="mainBlog">
             <?php if ($_GET['chyba'] == 1) {
               ?>   Zadali ste príliš dlhí názov
                 <?php
                } else {
                 if ($_GET['chyba'] == 2) {
                     ?>   Zadali ste príliš dlhí stručný popis
                 <?php } else {
                     if ($_GET['chyba'] == 3 ) {
                         ?>   Nezadali ste názov článku
                         <?php
                     }}}?>
            <div>
                <form method="post">
                <textarea class="nadpis" name="nazov"><?php echo $post->nazov; ?></textarea><br>
                <textarea class="strucnyText" name="strucnyText"><?php echo $post->strucnyText; ?></textarea><br>
                <textarea class="text" name="text"><?php echo $post->text; ?></textarea>
                <input type="submit" value="Uloz">
                <input type="hidden" name="id" value="<?php echo  $post->idPost ?>">
                </form>
            </div>
        </main>
    </div>
</div>