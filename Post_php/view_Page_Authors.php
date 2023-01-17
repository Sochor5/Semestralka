<?php
/** @var DB $db */
?>
<div class="columns">
    <div class="main">
        <?php /** @var DB $db */
            foreach ($db->getALLAutor() as $autor){ ?>
                <?php $pocet = 0;
                foreach ($db->getALLPosts() as $post){
                    if ($post->idPost != 0 ){
                        if ($pocet < 1) {
                            if ($post->id_pouzivatela__fk == $autor->id_uzivatela) {
                                $pocet++;
                                ?>
                                <a href="?autorID=<?php echo $autor->id_uzivatela ?>">
                                    <div class="block">
                                        <h2><?php echo $autor->meno ?> <?php echo $autor->priezvisko  ?> </h2>
                                    </div>
                                </a>
                                <?php
                            }}}} } ?>
    </div>
    <aside class="top5">
        <h2>5 authors</h2>
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
                    <a href="?autorID=<?php echo $autor->id_uzivatela ?>" ><p> <?php echo $autor->meno ?> <?php echo $autor->priezvisko  ?> </p></a>
                <?php }}}}}}?>
    </aside>
</div>