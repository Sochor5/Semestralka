<?php
/** @var Komentar $koment */
/** @var DB $db */
$koment = $db->getKoment($_GET['EditKoment']);
?>
<div class="body">
    <div class="columnsBlog">
        <main class="mainBlog">
            <div>
                <form method="post">

                    <textarea class="text" name="editTextTomentu"><?php echo $koment->text_komentu; ?></textarea>
                    <input type="hidden" name="id_komentu" value="<?php echo  $koment->id_komentu ?>">
                    <input type="submit" value="Uloz">
                </form>
            </div>
        </main>
    </div>
</div>