<?php include("./session.php");

include("classes/User.php");



try {
    // .............Connexion à la base de donné et récupération et traitement du formulaire

    $pdo = new PDO ('mysql:host=mysql-godefroy2022.alwaysdata.net;dbname=godefroy2022_recette_cuisine', 'godefroy2022', 'Bmw60000@');
    echo "connexion : ok";
}   catch (Exeption $error) {
    $error->getMessage();
}


if(isset($_POST['connexion'])){
    //traitement du formulaire
    echo "vous avez saisie le login : " .$_POST['login']."et".$_POST['pass']."password";
    // on va vérifier en base que le login et le pas sont bien en BDD
    $RequetSql = "SELECT * FROM 'User
                WHERE
                'login' = '".$_POST['login']."'
                AND
                'pass' = '".$_POST['pass']."';";

    $resultat = $pdo->query($RequetSql); //resultat sera de type pdoStatement
    if ($resultat->rowCount()>0){
         //echo "on a trouver le bon login";
        $_SESSION['Connexion']= true;
        return true;
    }else{
        //echo "le login ".$_POST['Login']." et le pass".$_POST['pass']." n'est pas bon";
        return false;
    }
    
    if (isset($_SESSION['Deconexion'])){
        echo "vous étes déconnecter";
        session_unset();
        session_destroy();
    }

    if (isset($_SESSION['Connexion'])){
        echo "Vous étes déja connecter";
    }
}
?>