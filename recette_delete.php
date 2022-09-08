<?php include("session.php");
    $recette = new recette(null,null,null,null,0);

    if(isset($_POST["Deleterecette"])){
        $recette->setrecetteById($_POST["id"]);
        $recette->deleteInBdd();
    }

    $tabrecettes = $recette->getAllrecette();

    if(isset($_SESSION['Connexion'])){
    ?>
        <h1> Index </h2>
        <div> Bienvenu <?php echo $TheUser->getLogin()?></div>

        <?php
            if($TheUser->isAdmin()){
                echo "vous etes admin"; 
                
                if(isset($_POST["idrecette"])){
                    $recette->setrecetteById($_POST["idrecette"]);
                    $recette->renderHTML(); 
                    ?>
                    <form action="" method="Post" >
                        <input type="Hidden" name="id"  value="<?= $recette->getID()?>">
                        <input type="submit" name="Deleterecette" value="Supprimer la recette <?= $recette->getNomrecette() ?>" >
                    </form>
                   <?php
                }

            
                
            ?>
            <form action="" method="Post" onchange="this.submit()">
                <select id="idrecette" name="idrecette">
                    <option value="null" >Choisi un recette</option>
                <?php
                    foreach ($tabrecettes as  $Therecette) {

                        if($recette->getId() == $Therecette->getId()){
                            $selected = "selected";
                        }else{$selected = "";}

                        echo '<option '.$selected.' value="'.$Therecette->getId().'">'.$Therecette->getNomrecette().'</option>';
                    }
                ?>
                </select>
            </form>
            
            <?php
            }else{
                echo "vous etes un simple visiteur vous n'avez pas acces au crud";
            }
        ?>

    <?php
    }