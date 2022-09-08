 <?php include("../../session.php");
    $recette = new recette(null,null,null,null,0);
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
                }

                if(isset($_POST["Updaterecette"])){
                    $recette->setrecetteById($_POST["id"]); //id vient du champ hidden
                    $recette->setNomrecette($_POST["Nomrecette"]);
                    $recette->setdescriptionrecette($_POST["descriptionrecette"]);
                    $recette->setLienImage($_POST["lienImage"]);
                    $recette->saveInBdd();
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

            <form action="" method="Post" >
                Nomrecette : <input type="text" name="Nomrecette" maxlength="100" value="<?=  $recette->getNomrecette() ?>" >
                descriptionrecette :<input type="text" name="descriptionrecette"  value="<?= $recette->getdescriptionrecette()?>">
                lienImage : <input type="text" name="lienImage"  value="<?= $recette->getLienImage()?>">
                <input type="Hidden" name="id"  value="<?= $recette->getID()?>">
                <input type="submit" name="Updaterecette" value="Mettre à jour" >
            </form>

            <?php
            }else{
                echo "vous etes un simple visiteur vous n'avez pas acces au crud";
            }
        ?>

    <?php
    }
   
    //affichage des recette
    ?>
        <div class="contener">
            <section class="py-5">
                <div class="container px-4 px-lg-5 mt-5">
                    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                        <?php foreach ($tabrecettes as $larecette) {
                            $larecette->renderHTML();
                        }
                        ?></div>
                </div>
            </section>
</body>
</html>

