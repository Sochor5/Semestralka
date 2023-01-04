<?php

class DB
{
        private $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=semestralka',"root", "dtb456");
        if (isset($_GET['like'])){
                $this->storeLike();
        }

    }

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
    public function GetLikes($id){ //////nejde
        $stm = $this->pdo->prepare("SELECT COUNT(*) FROM likes WHERE id_postu = ?");
        $stm->execute([$id]);
        return  $stm->fetchColumn();
    }

    public function storeLike(){
        if ($_SESSION['id_uzivatela'] != -1){
            $id_aktualneho_postu = $_GET['like'];
            $id_aktualneho_uzivatela = $_SESSION['id_uzivatela'];
            $stm = $this->pdo->prepare("SELECT * FROM likes WHERE id_postu= ? and id_uzivatela= ?");
            $stm->execute([$id_aktualneho_postu,$id_aktualneho_uzivatela]);
            /** @var Like $meno */
            $meno = $stm->fetchAll();
            if ($meno != null){


                $sql = "DELETE FROM likes WHERE id_postu = ?";
                $stmt= $this->pdo->prepare($sql);
                $stmt->execute([$id_aktualneho_postu]);
                header("Location: ?");
            } else {
                $sql = "INSERT INTO likes (id_postu,id_uzivatela) VALUES (?, ?)";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([$id_aktualneho_postu,$id_aktualneho_uzivatela ]);
            }
        }
    }
}