<?php
include "User.php";
class DBuser
{
    public $isLogged = false;
    private $pdo;
    public function __construct()
    {

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

    public  function login($name, $heslo){
        if ($name != null && $heslo != null) {
            $this->pdo = new PDO('mysql:host=localhost;dbname=semestralka', "root","dtb456");
            $stm = $this->pdo->prepare("SELECT * FROM uzivatel WHERE login= ? and heslo= ?");
            $stm->execute([$name, $heslo]);
            /** @var User $meno */
            $meno = $stm->fetchAll(PDO::FETCH_CLASS)[0];
            if ($meno->login == $name && $meno->heslo == $heslo){
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
        $this->pdo = new PDO('mysql:host=localhost;dbname=semestralka', "root","dtb456");
        $stmt= $this->pdo->prepare("INSERT INTO uzivatel (login, heslo, meno,priezvisko) VALUES (?, ?, ?, ?)");
        $stmt->execute([$login, $heslo,$meno,$priezvisko]);
        header("Location: ../index.php");
    }

    public function getALLAutor(){
        $this->pdo = new PDO('mysql:host=localhost;dbname=semestralka', "root","dtb456");
        $stm = $this->pdo->query("SELECT id_uzivatela, meno, priezvisko FROM uzivatel");
        return $stm->fetchAll(PDO::FETCH_CLASS, User::class);
    }
}