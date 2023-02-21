<?php
session_start();

class Userpdo
{

    private $id;
    public $login;
    private $password;
    public $email;
    public $firstname;
    public $lastname;

    protected $bdd;

    public function __construct()
    {
        $servername = 'localhost';
        $username = 'root';
        $password = '';

        try {
            $this->bdd = new PDO("mysql:host=$servername;dbname=classes", $username, $password);
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo 'Connexion réussie';
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

    public function register($login, $password, $email, $firstname, $lastname)
    {
        $insertUser = $this->bdd->prepare("INSERT INTO utilisateurs(login,password,email,firstname,lastname)VALUES(?,?,?,?,?)");
        $insertUser->execute([$login, $password, $email, $firstname, $lastname]);

        $recupUser = $this->bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?");
        $recupUser->execute([$_SESSION['login']]);
        $result = $recupUser->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }



              //FUNCTION CONNECT


            
            //FUNCTION DISCONNECT



            //FUNCTION DELETE



            //FUNCTION UPDATE





            //FUNCTION GETALLINFOS



            //FUNCTION GETLOGIN


            //FUNCTION GETEMAIL


            //FUNCTION GETFIRSTNAME

            //FUNCTION GETLASTNAME



    
}
var_dump($_SESSION);
$newUser = new Userpdo();
$newUser->register("test5", "test5","test5@com","test5","test5");
// $newUser->connect("tes5", "test5");
// $newUser->disconnect();
// $newUser->update("test5","test5","test5@com","test5","test5");
// $newUser->getLogin();
// $newUser->delete();
// $newUser->isConnected();
// $newUser->getAllinfos();
// $newUser->getLogin();
// $newUser->getEmail();
// $newUser->getFirstname();
// $newUser->getLastname();
?>