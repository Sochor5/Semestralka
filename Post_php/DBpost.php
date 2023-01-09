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

        ////////////User ////////////
        if (isset($_POST['login'])){
            if (isset($_POST['Heslo'])){
                $this->login($_POST['login'],$_POST['Heslo']);
            }
        }
        if (isset($_GET['odhlas'])){
            $this->logout();
            header("Location: ?");
            die();
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
        if (!$post->idPost) {
            $sql = "INSERT INTO post (nazov,strucnyText,text, file, id_pouzivatela__fk) VALUES (?, ?, ?, ?,?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$post->nazov, $post->strucnyText, $post->text, $post->file, $post->id_uzivatela]);
        }else{
            $sql = "UPDATE post SET nazov = ?, strucnyText = ?, text = ?   where idPost = ?";
            $stmt= $this->pdo->prepare($sql);
            $stmt->execute([$post->nazov, $post->strucnyText, $post->text, $post->idPost]);
        }
        header("Location: ?");
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
    }

    public function editKoment(){
        $sql = "UPDATE komentar SET text_komentu = ? where id_komentu = ?";
        $stmt= $this->pdo->prepare($sql);
        $stmt->execute([$_POST['editTextTomentu'],$_POST['id_komentu']]);
        header("Location: ?");

    }

    ////////////---------------////////////
    ////////////User ////////////
    ////////////---------------////////////
    public  function login($name, $heslo){
        if ($name != null && $heslo != null) {
            $stm = $this->pdo->prepare("SELECT * FROM uzivatel WHERE login= ?");
            $stm->execute([$name]);
            /** @var UserUdaje $meno */
            $meno = $stm->fetchAll(PDO::FETCH_CLASS)[0];
            if ($meno->login == $name && password_verify($heslo, $meno->heslo)){
                $this->isLogged = true;
                $_SESSION['logged'] = true;
                $_SESSION['id_uzivatela'] = $meno->id_uzivatela;
                header("Location: ../index.php");
            } else{
                $this->logout();
            }
        } else{
            $this->logout();
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