<?php
    session_start();

    class User
    {
        private $id;
        public $login;
        private $password;
        public $email;
        public $firstname;
        public $lastname;
        public $bd;
        
    
        public function __construct()
        {
         //Variables declareé pour la base de données 

        $host = "localhost";
        $user_name = "root";
        $password = "";
        $database = "classes";
        // this fais référence à l'objet courant

        $this->bd = mysqli_connect("localhost", "root", "", "classes");
        if (!$this->bd) {
        die("Connexion lost");
        } else {
        echo "Connexion établie <br>";
        }
        }
    
    
        //FUNCTION REGISTER

        public function register($login, $password, $email, $firstname, $lastname){
        $this->bd->query("INSERT INTO `utilisateurs` (`login`, `password`, `email`, `firstname`, `lastname`) VALUES ('$login', '$password','$email','$firstname' ,'$lastname')");
        }

              //FUNCTION CONNECT

        public function connect($login, $password){
             $req = $this->bd->query("SELECT * FROM utilisateurs WHERE login = '".$login."' AND password = '".$password."'");
                if(mysqli_num_rows($req) == 1) {
                
                    $_SESSION['login'] = $login;
                    $_SESSION['password'] = $password;
                    echo "bienvenue $login ";

            } else {
            
                echo "vous n'etes pas connecté";
            }
            
            }
            
            //FUNCTION DISCONNECT

            public function disconnect(){
                session_unset();
                session_destroy();
                echo "vous êtes déconnecté <br>";
            }

            //FUNCTION DELETE

            public function delete(){
                $this->bd->query("DELETE FROM utilisateurs WHERE login ='".$_SESSION['login']."'");
                session_destroy();
                echo "utilisateur supprimé";
            }

            //FUNCTION UPDATE

            public function update($login, $password, $email, $firstname, $lastname){
                $this->bd->query("UPDATE utilisateurs SET login = '$login', password = '$password', email = '$email', firstname = '$firstname', lastname = '$lastname' WHERE login = '".$_SESSION["login"]."'");
                echo "votre compte a été modifié";
            }

                //FUNCTION ISCONNECTED
                
            public function isConnected(){
                if(isset($_SESSION['login'])){
                    echo "vous êtes connecté <br>";
                    return true;
                }
                else{
                    echo "vous n'êtes pas conneté <br>";
                    return false;
                }
            }

            //FUNCTION GETALLINFOS

            public function getAllInfos(){
                $req = $this->bd->query("SELECT * FROM utilisateurs WHERE login = '".$_SESSION["login"]."'");
                $req = $req->fetch_all(MYSQLI_ASSOC);
                var_dump($req);
                return $req;    
            }

            //FUNCTION GETLOGIN

            public function getLogin(){
                $req = $this->bd->query("SELECT login FROM utilisateurs WHERE login = '".$_SESSION["login"]."'");
                $req = $req->fetch_all(MYSQLI_ASSOC);
                var_dump($req);
                return $req;    
            }
            //FUNCTION GETEMAIL

            public function getEmail(){
                $req = $this->bd->query("SELECT email FROM utilisateurs WHERE login = '".$_SESSION["login"]."'");
                $req = $req->fetch_all(MYSQLI_ASSOC);
                var_dump($req);
                return $req;    
            }
            //FUNCTION GETFIRSTNAME

            public function getFirstName(){
                $req = $this->bd->query("SELECT firstname FROM utilisateurs WHERE login = '".$_SESSION["login"]."'");
                $req = $req->fetch_all(MYSQLI_ASSOC);
                var_dump($req);
                return $req;    
            }
            //FUNCTION GETLASTNAME

            public function getLastName(){
                $req = $this->bd->query("SELECT lastname FROM utilisateurs WHERE login = '".$_SESSION["login"]."'");
                $req = $req->fetch_all(MYSQLI_ASSOC);
                var_dump($req);
                return $req;    
            }

    }
    
    $User = new User();

    //$User->register('test4', 'test4', 'test4@com', 'test4', 'test4' )
    //$User->connect('test41', 'test41');
    //$User->disconnect();
    //$User->delete();
    //$User->update('test41', 'test41', 'test41@com', 'test41', 'test41');$User->isConnected();
    //$User->isConnected();
    //$User->getLogin();
    //$User->getEmail();
    //$User->getFirstName();
    //$User->getLastName();

    var_dump($_SESSION);

    
    
?>