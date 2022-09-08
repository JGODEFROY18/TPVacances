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
    <?php include("./session.php"); ?>

    
        <form action="" method="post">
            <input type="submit" name="deconnexion" value="se deconnecter">
        </form>
        <form action="" method="post">
            login : <input type="text" name="login" value="Jules"/>
            Pass : <input type="password" name="pass" value="Jules"/>
            <input type="submit" name="connexion">
        </form>
    

</body>

