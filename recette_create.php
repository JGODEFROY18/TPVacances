  <div>
        <?php include("session.php");

        if (isset($_SESSION['Connexion'])) {

            if ($TheUser->isAdmin()) {
                if (isset($_POST["createRecette"])) {
                    $newrecette = new recette(null, $_POST["Nomrecette"], $_POST["descriptionrecette"], $_POST["lienImage"], $_POST["etoile"]);
                    $newrecette->saveInBdd();
                }

        ?>



                <form action="" method="Post" class="stars5">
                    Nomrecette : <input type="text" name="Nomrecette" maxlength="100">
                    descriptionrecette :<input type="text" name="descriptionrecette">
                    lienImage : <input type="text" name="lienImage">

                    <div class="starRating">
                        <input id="s5" type="radio" name="etoile" value="5">
                        <label for="s5">5</label>
                        <input id="s4" type="radio" name="etoile" value="4">
                        <label for="s4">4</label>
                        <input id="s3" type="radio" name="etoile" value="3">
                        <label for="s3">3</label>
                        <input id="s2" type="radio" name="etoile" value="2">
                        <label for="s2">2</label>
                        <input id="s1" type="radio" name="etoile" value="1">
                        <label for="s1">1</label>
                    </div>


                    <input type="submit" name="createRecette">
                </form>

            <?php
            } else {
                echo "vous etes un simple visiteur vous n'avez pas acces au crud";
            }
            ?>

        <?php
        }

        //affichage des recettes
        $recette = new recette(null, null, null, null, 0);
        $tabrecettes = $recette->getAllrecette();
        ?><div class="contener">
            <section class="py-5">
                <div class="container px-4 px-lg-5 mt-5">
                    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                        <?php foreach ($tabrecettes as $larecette) {
                            $larecette->renderHTML();
                        }
                        ?></div>
                </div>
            </section>
            </footer>
            
</body>

</html>