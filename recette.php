<?php
    class recette{

        //Propriétés private
        private $id_;
        private $NomRecette_;
        private $descriptionrecette_;
        private $lienImage_;
        private $MoyenneNote_;




        //Méthode public
        public function __construct($id,$NomRecette,$descriptionrecette,$lienImage,$MoyenneNote_){
            $this->id_ = $id;
            $this->Nomrecette_ = $NomRecette;
            $this->descritpionrecette_ = $descriptionrecette;
            $this->lienImage_ = $lienImage;
            $this->MoyenneNote_ = $MoyenneNote;

        }

        public function saveInBdd()
    {
        //cas si id = null => INSERT
        $NomRecette = addslashes($this->NomRecette_);
        $descriptionrecette = addslashes($this->descriptionrecette_);
        $lienImage = addslashes($this->lienImage_);


        if (is_null($this->id_)) {
            $requetSQL = "INSERT INTO `recette`
            ( `NomRecette`, `descriptionrecette`, `lienImage`) 
            VALUES 
            ('" . $NomRecette . "','" . $descriptionrecette . "','" . $lienImage . "')";
            $resultat = $GLOBALS["pdo"]->query($requetSQL);
            $this->id_ = $GLOBALS["pdo"]->lastInsertId();

            $requetSQL = "INSERT INTO `Note` ( `idUser`, `idrecette`, `note`) 
            VALUES ( '".$_SESSION['id']."', '".$this->id_."', '".$this->MoyenneNote_."');";
            $GLOBALS["pdo"]->query($requetSQL);



        } else {
            //UPDATE
            echo "tu va updater la recette id N°" . $this->id_;



            $requetSQL = "UPDATE `recette` SET 
            `Nomrecette`='" . $NomRecette . "',
            `descriptionrecette`='" . $descriptionrecette . "',
            `lienImage`='" . $lienImage . "' 
            WHERE `id` = '" . $this->id_ . "'";

            $resultat = $GLOBALS["pdo"]->query($requetSQL);
        }
    }

    public function deleteInBdd()
    {
        if (!is_null($this->id_)) {
            $requetSQL = "DELETE FROM `recette`WHERE
            id = '" . $this->id_ . "'";
            $GLOBALS["pdo"]->query($requetSQL);
            echo "La recette " . $this->NomRecette_ . " a été supprimé";
        }
    }

    public function setrecetteById($id)
    {
        $RequetSql = "Select recette.id,recette.NomRecette,recette.descriptionrecette,recette.lienImage, AVG(Note.note) as 'note'
         FROM recette,Note,User
        WHERE
        recette.id = Note.idrecette
        AND
        Note.idUser = User.id
        AND
        recette.id = '" . $id . "'  
        Group By recette.id;";

        $resultat = $GLOBALS["pdo"]->query($RequetSql); //resultat sera de type pdoStatement
        if ($resultat->rowCount() > 0) {
            $tab = $resultat->fetch();
            $this->id_ = $tab['id'];
            $this->NomRecette_ = $tab['NomRecette'];
            $this->descriptionrecette_ = $tab['descriptionrecette'];
            $this->lienImage_ = $tab['lienImage'];
            $this->MoyenneNote_ = $tab['note'];
        }
    }

    public function getAllrecette()
    {
        $Listrecettes = array();
        //chercher en bdd tous les recettes
        $RequetSql = "Select recette.id,recette.NomRecette,recette.descriptionrecette,recette.lienImage, AVG(Note.note) as 'note'
        FROM recette,Note,User
        WHERE
        recette.id = Note.idrecette
        AND
        Note.idUser = User.id
        Group By recette.id;";

        $resultat = $GLOBALS["pdo"]->query($RequetSql); //resultat sera de type pdoStatement
        while ($tab = $resultat->fetch()) {
            $larecette = new recette($tab['id'], $tab['NomRecette'], $tab['descriptionrecette'], $tab['lienImage'], $tab['note']);
            array_push($Listrecettes, $larecette);
        }

        return $Listrecettes;
    }

    public function getNomRecette()
    {
        return $this->NomRecette_;
    }
    public function getId()
    {
        return $this->id_;
    }
    public function getdescriptionrecette()
    {
        return $this->descriptionrecette_;
    }

    public function renderHTML()
    {
    };
?>
    