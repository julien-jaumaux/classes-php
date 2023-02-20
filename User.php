<?php

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
        echo "Connexion établie";
        }
        }
    
    
        //FUNCTION REGISTER

        public function register($login, $password, $email, $firstname, $lastname)
        {
        $this->bd->query("INSERT INTO `utilisateurs` (`login`, `password`, `email`, `firstname`, `lastname`) VALUES ('$login', '$password','$email','$firstname' ,'$lastname')");
        }


  

    }

    $User = new User();
    $User->register('ju', 'jjj', "julien@.com", "julien", "jaumaux");

    
    
?>