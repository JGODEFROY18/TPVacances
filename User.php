<?php
    class User{

        //Propriétés private
        private $id_;
        private $isAdmin_ = False;
        private $login_;




        //Méthode public
        public function __construct($id,$isAdmin,$login){
            $this->id_ = $id;
            $this->isAdmin_ = $isAdmin;
            $this->login_ = $login;

        }


        public function seConnecter($login,$pass){
            $RequetSql = "SELECT * FROM 'User
            WHERE 
            'login' = '".$_POST['login']."'
            AND
            'pass' = '".$_POST['pass']."'";

            $resultat = $pdo->query($RequetSql); //resultat sera de type pdoStatement
            if ($resultat->rowCount()>0){
                //echo "on a trouver le bon login";
                $_SESSION['Connexion']= true;
                return true;
            }else{
                //echo "le login ".$_POST['Login']." et le pass".$_POST['pass']." n'est pas bon";
                return false;
            }
        }

    }
?>