<?php
include "phpClass/UserUdaje.php";
include "phpClass/Like.php";
class DB
{
        private $pdo;
    public $isLogged = false;
    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=semestralka',"root", "dtb456");

        ////////////User ////////////
        if (isset($_POST['login'])){
            if (isset($_POST['Heslo'])){
                $this->login($_POST['login'],$_POST['Heslo']);
            }
        }
        if (isset($_GET['odhlas'])){
            $this->logout();

            $_GET['zle'] = 0;
            header("Location: ../index.php");
        }
        if (isset($_SESSION['logged']) == null){
            $this->isLogged = false;
            $_SESSION['id_uzivatela'] = true;
            $_SESSION['logged'] = false;
        }
        if (isset($_POST['email'])){
            if (isset($_POST['newHeslo'])){
                if (isset($_POST['newMeno'])){
                    if (isset($_POST['newPriezvisko'])){
                        $this->createUser($_POST['email'],$_POST['newHeslo'],$_POST['newMeno'],$_POST['newPriezvisko']);
                    }
                }
            }
        }

        ////////////POST ////////////
        if (isset($_POST['id']) == false)
        if (isset($_POST['text'])) {
            if (isset($_POST['nazov'])) {
                if (isset($_POST['strucnyText'])){
                    $newPost = new Post();
                    $newPost->text = $_POST['text'];
                    $newPost->nazov = $_POST['nazov'];
                    $newPost->strucnyText = $_POST['strucnyText'];
                    $newPost->id_uzivatela = $_SESSION['id_uzivatela'];
                    if (isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK) {
                        $newName = "img" . DIRECTORY_SEPARATOR . time() . "_" . $_FILES["img"]["name"];
                        if (move_uploaded_file($_FILES["img"]["tmp_name"], $newName)) {
                            $newPost->file = $newName;
                        }
                    }
                    $this->storePost($newPost);
                }
            }
        }
        if (isset($_GET['delete'])){
            $this->remove($_GET['delete']);
        }
        if ($_SESSION['logged']){
            if (isset($_GET['edit']) && isset($_POST['id'])){
                $updatePost = $this->loadOnePost($_POST['id']);
                $updatePost->text = $_POST['text'];
                $updatePost->nazov = $_POST['nazov'];
                $updatePost->strucnyText = $_POST['strucnyText'];
                $this->storePost($updatePost);

            }
        }

        ////////////LIKE ////////////
        if (isset($_POST['like'])){
                $this->storeLike();
        }

        ////////////KOMENTARE ////////////
        if (isset($_GET['textKoment'])){
            if (isset($_GET['newKoment'])){
                $this->newKoment();
            }
        }
        if (isset($_GET['deleteKoment'])){
            $this->deleteKomentar();
        }
        if (isset($_POST['id_komentu'])){
            if (isset($_POST['editTextTomentu'])){
                $this->editKoment();
            }
        }
        if (isset($_POST['textkomentu'])){
            $this->newKoment($_POST['textkomentu']);
        }

    }
    ////////////---------------////////////
    ////////////Post ////////////
    ////////////---------------////////////
    /**
     * @return Post[]
     */
    public function getALLPosts(){
        $stm = $this->pdo->query("SELECT * FROM post");
        return $stm->fetchAll(PDO::FETCH_CLASS, Post::class);
    }

    public function storePost(Post $post){
if (strlen($post->nazov) < 100 && strlen($post->nazov) > 0 && strlen($post->strucnyText) < 200) {
    if (!$post->idPost) {
        $sql = "INSERT INTO post (nazov,strucnyText,text, file, id_pouzivatela__fk) VALUES (?, ?, ?, ?,?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$post->nazov, $post->strucnyText, $post->text, $post->file, $post->id_uzivatela]);
        header("Location: ?");
    }else{
        $sql = "UPDATE post SET nazov = ?, strucnyText = ?, text = ?   where idPost = ?";
        $stmt= $this->pdo->prepare($sql);
        $stmt->execute([$post->nazov, $post->strucnyText, $post->text, $post->idPost]);
        $id = $_GET['blog1'];
        header("Location: ?blog=$id");
        die();
    }

} else {
    if (strlen($post->nazov) > 100) {
        $_GET['chyba'] = 1;
    }
    if (strlen($post->nazov) == 0) {
        $_GET['chyba'] = 3;
    }
    if (strlen($post->strucnyText) > 200) {
        $_GET['chyba'] = 2;
    }
    if($post->idPost){

        header("Post_php/edit_Post.php");

    }
}

    }


    public function loadOnePost($id) : Post{

        $stm = $this->pdo->prepare("SELECT * FROM post WHERE idPost = ?");
        $stm->execute([$id]);
        /** @var Post $vysledok */
        return $vysledok =  $stm->fetchAll(PDO::FETCH_CLASS, Post::class)[0];
    }

    public function remove($id)
    {
        $vysledok = $this->loadOnePost($id);
        if ($vysledok->file){
            unlink($vysledok->file);
        }
        $sql = "DELETE FROM post WHERE idPost = ?";
        $stmt= $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        header("Location: ?");
    }

    ////////////---------------////////////
    ////////////LIKE ////////////
    ////////////---------------////////////
    public function GetLikes($id,$co){
        if ($co == 1) {
            $stm = $this->pdo->prepare("SELECT COUNT(*) FROM likes WHERE id_postu = ?");
        }else {
            $stm = $this->pdo->prepare("SELECT COUNT(*) FROM komentar WHERE id_postu = ?");
        }
        $stm->execute([$id]);
        return  $stm->fetchColumn();
    }

    public function getLikePostUser($id_postLike, $id_UserLike){
        $stm = $this->pdo->prepare("SELECT * FROM likes WHERE id_postu= ? and id_uzivatela= ?");
        $stm->execute([$id_postLike,$id_UserLike]);
        return  $stm->fetchAll(PDO::FETCH_CLASS, Like::class);
    }


    public function storeLike(){
        if ($_SESSION['id_uzivatela'] != -1){
            $id_aktualneho_postu = $_GET['blog'];
            $id_aktualneho_uzivatela = $_SESSION['id_uzivatela'];
            $stm = $this->pdo->prepare("SELECT * FROM likes WHERE id_postu= ? and id_uzivatela= ?");
            $stm->execute([$id_aktualneho_postu,$id_aktualneho_uzivatela]);
            /** @var Like $meno */
            $meno = $stm->fetchAll();
            if ($meno != null){
                $sql = "DELETE FROM likes WHERE id_postu = ?";
                $stmt= $this->pdo->prepare($sql);
                $stmt->execute([$id_aktualneho_postu]);

            } else {
                $sql = "INSERT INTO likes (id_postu,id_uzivatela) VALUES (?, ?)";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([$id_aktualneho_postu,$id_aktualneho_uzivatela ]);
            }
        }
    }

    ////////////---------------////////////
    ////////////KOMENTARE ////////////
    ////////////---------------////////////


    public function getALLKomentFromPost($id){
        $stm = $this->pdo->prepare("SELECT * FROM komentar WHERE id_postu= ?");
        $stm->execute([$id]);
        return  $stm->fetchAll(PDO::FETCH_CLASS, Komentar::class);
    }
    public function getKoment($id){
        $stm = $this->pdo->prepare("SELECT * FROM komentar WHERE id_komentu= ?");
        $stm->execute([$id]);
        return  $stm->fetchAll(PDO::FETCH_CLASS, Komentar::class)[0];
    }
    public function newKoment($text){
        $sql = "INSERT INTO komentar (text_komentu,id_postu,id_uzivatela) VALUES (?, ?,?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$text,$_GET['blog'],$_SESSION['id_uzivatela'] ]);
    }

    public function deleteKomentar(){
        $sql = "DELETE FROM komentar WHERE id_komentu = ?";
        $stmt= $this->pdo->prepare($sql);
        $stmt->execute([$_GET['deleteKoment']]);
        $id = $_GET['blog1'];
        header("Location: ?blog=$id");
    }

    public function editKoment(){
        $sql = "UPDATE komentar SET text_komentu = ? where id_komentu = ?";
        $stmt= $this->pdo->prepare($sql);
        $stmt->execute([$_POST['editTextTomentu'],$_POST['id_komentu']]);
        $id = $_GET['blog1'];
        header("Location: ?blog=$id");

    }

    ////////////---------------////////////
    ////////////User ////////////
    ////////////---------------////////////
    public  function login($name, $heslo){
        if ($name != null && $heslo != null) {
            $stm = $this->pdo->prepare("SELECT * FROM uzivatel WHERE login= ?");
            $stm->execute([$name]);
            $pocet = $stm->fetchColumn();
            if ($pocet > 0 ) {
                $stm = $this->pdo->prepare("SELECT * FROM uzivatel WHERE login= ?");
                $stm->execute([$name]);
                /** @var UserUdaje $meno */
                $meno = $stm->fetchAll(PDO::FETCH_CLASS)[0];
                if ($meno->login == $name && password_verify($heslo, $meno->heslo)){
                    $this->isLogged = true;
                    $_SESSION['logged'] = true;
                    $_SESSION['id_uzivatela'] = $meno->id_uzivatela;
                    header("Location: ../index.php");
            } else {
                    $this->logout();
                    $_GET['zle'] = 1;
                    header("http://localhost/login.php");
                }
            } else{
                $this->logout();
                $_GET['zle'] = 1;
                header("http://localhost/login.php");
            }
        } else{
            $this->logout();
            $_GET['zle'] = 1;
            header("http://localhost/login.php");
        }
    }

    public function logout(){
        $this->isLogged = false;
        $_SESSION['logged'] = false;
        $_SESSION['id_uzivatela'] = -1;
    }

    public function createUser($login, $heslo,$meno,$priezvisko){
        $stm = $this->pdo->query("SELECT login FROM uzivatel");
        /** @var UserUdaje $meno */
        $userDB = $stm->fetchAll(PDO::FETCH_CLASS, UserUdaje::class);
        $pomoc = 0;
        foreach ($userDB as $autor){
            if ($autor->login == $login) {
                $pomoc++;
                $_SESSION['Existuje'] = true;
                header("http://localhost/NewAccount.php");
            }
        }
        if ($pomoc == 0) {
            $stmt= $this->pdo->prepare("INSERT INTO uzivatel (login, heslo, meno,priezvisko) VALUES (?, ?, ?, ?)");
            $hashed_password = password_hash($heslo, PASSWORD_DEFAULT);
            $stmt->execute([$login, $hashed_password,$meno,$priezvisko]);
            $_SESSION['Existuje'] = false;
            header("Location: ../index.php");
        }

    }

    public function getALLAutor(){
        $stm = $this->pdo->query("SELECT id_uzivatela, meno, priezvisko FROM uzivatel");
        return $stm->fetchAll(PDO::FETCH_CLASS, UserUdaje::class);
    }
}