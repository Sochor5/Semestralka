<div class="body">
    <div class="columnsBlog">
        <main class="mainBlog">
            <?php if ($_GET['chyba'] == 1) {
                ?>   Zadali ste príliš dlhí názov
                <?php
            } else {
                if ($_GET['chyba'] == 2) {
                    ?>   Zadali ste príliš dlhí stručný popis
                <?php }else {
                    if ($_GET['chyba'] == 3 ) {
                        ?>   Nezadali ste názov článku
                        <?php
                    }}}?>
            <div>
                <form method="post" enctype="multipart/form-data">
                    <input class="nadpis"  name="nazov" placeholder="Nadpis článku"><br>
                    <input class="strucnyText"  name="strucnyText" placeholder="Struční popis od čom je článok"><br>
                    <input class="text" name="text" placeholder="Hlavný obsah článku"><br>
                    <input type="file" name="img"><br>
                    <input type="submit" value="odoslat">

                </form>
            </div>
        </main>
    </div>
</div>
