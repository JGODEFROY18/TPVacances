<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    <?php 

    try {
        // .............Connexion à la base de donné et récupération et traitement du formulaire
        $ipserver = "192.168.65.193";
        $NomBase = "godefroy2022_recette_cuisine";
        $loginPrivilege = "siteWeb";
        $passPrivilege = "siteWeb";

        $pdo new PDO ('mysql:host=mysql-godefroy2022.alwaysdata.net;dbname=godefroy2022_recette_cuisine', 'godefroy2022', 'Bmw60000@');
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
                    'login' = '".$_POST['login]."'
                    AND
                    'pass' = '".$_POST['passs']."';

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
        echo "Vous étes déja connecter"
        ?>
        <form action="" method="post">
            <input type="submit" name="deconnexion" value="se deconnecter">
        </form>
        <a href="page2.php">accés à la page 2</a>
        <?php
    }else{
            
            echo "Veuillez vous identifiez";
            ?>
        <form action="" method="post">
            login : <input type="text" name="login" value="Jules"/>
            Pass : <input type="password" name="pass" value="Jules"/>
            <input type="submit" name="connexion">
        </form>
        <?php
    }
    
    ?>

</body>

