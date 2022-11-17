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
        }

        if (isset($_SESSION['logged'])){
            $this->isLogged = true;
        }
       }



    public  function login($name, $heslo){
        $this->pdo = new PDO('mysql:host=localhost;dbname=semestralka', "root","dtb456");
        $stm = $this->pdo->prepare("SELECT * FROM uzivatel WHERE login= ? and heslo= ?");
        $stm->execute([$name, $heslo]);
        /** @var User $meno */
        $meno = $stm->fetchAll(PDO::FETCH_CLASS)[0];
        if ($meno->meno == $name && $meno->heslo == $heslo){
            $this->isLogged = true;
            $_SESSION['logged'] = true;
        } else{
            $this->logout();
        }
    }
    public function logout(){
        $this->isLogged = false;
        unset($_SESSION['logged']);
        header("Location: ?");
    }
}