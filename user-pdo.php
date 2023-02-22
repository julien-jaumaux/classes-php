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
            echo 'Connexion réussie<br>';
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

            public function connect($login, $password)
            {
                $recupUser = $this->bdd->prepare("SELECT login,password FROM utilisateurs WHERE login = ? AND password = ?");
                $recupUser->execute([$login, $password]);

                if ($recupUser->rowCount() > 0) {
                echo "<br>bienvenue $login <br>'";
                $_SESSION['login'] = $login;
                $_SESSION['password'] = $password;
                
                } else {
                    echo "<br>Mot de passse ou login inconnue<br>";
                }
            }

            //FUNCTION DISCONNECT

            public function disconnect(){
                
                session_destroy();
            }

            //FUNCTION DELETE

            public function delete(){
                $supUser = $this->bdd->prepare("DELETE FROM utilisateurs WHERE login = ?");
                $supUser->execute([$_SESSION['login']]);
                session_destroy();
                echo '<br>votre compte a été supprimer<br>';
            }

            //FUNCTION UPDATE

            public function update($login, $password, $email, $firstname, $lastname){
                $updateUser = $this->bdd->prepare("UPDATE utilisateurs SET login=?, password=?, email=?, firstname=?, lastname=? WHERE login = ?");
                $updateUser->execute([$login, $password, $email, $firstname, $lastname, $_SESSION['login']]);
            }

            //FUNCTION ISCONNECTED

            public function isConnected(){
                if(isset($_SESSION['login'])){
                    return true;
                }
                else{
                    return false;
                }
            }

            //FUNCTION GETALLINFOS

            public function getAllInfos(){

            }

            //FUNCTION GETLOGIN


            //FUNCTION GETEMAIL


            //FUNCTION GETFIRSTNAME

            //FUNCTION GETLASTNAME



    
}

$newUser = new Userpdo();

// $newUser->register("test5", "test5","test5@com","test5","test5");
// $newUser->connect("test5", "test5");
// $newUser->disconnect();
// $newUser->delete();
// $newUser->update("test51","test51","test51@com","test51","test51");
// $newUser->delete();
 $newUser->isConnected();
// $newUser->getAllinfos();
// $newUser->getLogin();
// $newUser->getEmail();
// $newUser->getFirstname();
// $newUser->getLastname();
var_dump($_SESSION);
?>