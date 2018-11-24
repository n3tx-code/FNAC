<?php
session_start();
if(isset($_SESSION['ID'])) {
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <?php
        include("../../includes/style.php");
        include("../../includes/bdd.php");
        ?>
    </head>
    <body>

    <div class="container">
        <?php
        include("../../includes/templates/navbar.php");
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "true")
            {
                ?>
                <div class="erreur">Une erreur est arrivée</div>
                <?php
            }
            else
            {
                ?>
                <div class="good">Adresse ajoutée</div>
                <?php
            }

        }
        ?>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form action="../../includes/scripts/add_adress.php" method="post">
                    <h4>Adresse*</h4>
                    <div class="form-group">
                        <label for="nom-prenom">Nom et Prénom :</label>
                        <input type="text" class="form-control" id="nom-prenom" name="nom-prenom" required>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="n-rue">N° :</label>
                                <input type="text" class="form-control" id="n-rue" name="n-rue" required>
                            </div>
                        </div>

                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="rue">Rue :</label>
                                <input type="text" class="form-control" id="rue" name="rue" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="CP">Code postal :</label>
                                <input type="text" class="form-control" id="CP" name="CP" required>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="ville">Ville :</label>
                                <input type="text" class="form-control" id="ville" name="ville" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="titre">Titre de l'adresse</label>
                        <input type="text" name="titre" id="titre" class="form-control" placeholder="Titre de l'adresse"
                               required>
                    </div>
                    <button type="submit" class="btn btn-default btn-inscription">Ajouter adresse</button>
                </form>
            </div>
        </div>
        <?php
        include("../../includes/templates/footer.php");
        ?>
    </div>
    </body>
    </html>
    <?php
}
else
{
    header("Location: /");
}
?>