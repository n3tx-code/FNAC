<?php
session_start();
if(isset($_SESSION['ID']))
{
    header('location: /profil/');
}
else {
    if(isset($_POST['Inscription']))
    {
        include("../../includes/scripts/inscription.php");
    }
    elseif(isset($_POST['Connexion']))
    {
        include("../../includes/scripts/connexion.php");
    }
?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <?php include("../../includes/style.php");
        include ("../../includes/bdd.php");?>
    </head>
    <body>

    <div class="container">
        <?php
        include("../../includes/templates/navbar.php");
        ?>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-9 col-md-offset-1">
                        <h3 class="text-center">Connexion</h3>
                        <?php
                        if(isset($erreur_connexion)) {
                            ?>
                            <div class="erreur">
                                <?= $erreur_connexion ?>
                            </div>
                            <?php
                        }
                        ?>
                        <form action="." method="post" id="login">
                            <div class="form-group">
                                <label for="email">Email* :</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="mdp">Mot de passe* :</label>
                                <input type="password" class="form-control" id="mpd" name="mdp">
                            </div>
                            <button type="submit" name="Connexion" class="btn btn-default btn-connexion">Connexion
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6" style="border-left: 1px solid #7c7c7c;">
                <div class="row">
                    <div class="col-md-9 col-md-offset-2">
                        <h3 class="text-center">Inscription</h3>

                        <?php
                            if(isset($erreur_inscripiption)) {
                                ?>
                                <div class="erreur">
                                    <?= $erreur_inscripiption ?>
                                </div>
                                <?php
                            }
                            if(isset($good_inscription))
                            {
                                ?>
                                <div class="good">
                                    <?= $good_inscription ?>
                                </div>
                                <?php
                            }
                            ?>

                        <form action="." method="post" id="signin">
                            <div id="inscription-1">
                                <div class="form-group">
                                    <label for="email">Email* :</label>
                                    <input type="email" class="form-control" id="email" name="email1">
                                </div>
                                <div class="form-group">
                                    <label for="email">Confirmation email* :</label>
                                    <input type="email" class="form-control" id="email" name="email2">
                                </div>
                                <div class="form-group">
                                    <label for="mdp">Mot de passe* :</label>
                                    <input type="password" class="form-control" id="mpd" name="mdp1">
                                </div>
                                <div class="form-group">
                                    <label for="mdp">Confirmation mot de passe* :</label>
                                    <input type="password" class="form-control" id="mpd" name="mdp2">
                                </div>
                            </div>

                            <div id="inscription-2" style="display: none;">
                                <h4>Identité</h4>
                                <div class="form-group">
                                    <label for="nom">Nom* :</label>
                                    <input type="text" class="form-control" id="nom" name="nom">
                                </div>
                                <div class="form-group">
                                    <label for="prenom">Préom* :</label>
                                    <input type="text" class="form-control" id="prenom" name="prenom">
                                </div>
                                <div class="form-group">
                                    <label for="tel">Téléphone* :</label>
                                    <input type="text" class="form-control" id="tel" name="tel">
                                </div>
                            </div>

                            <div id="inscription-3" style="display: none;">
                                <h4>Adresse*</h4>
                                <div class="form-group">
                                    <label for="nom-prenom">Nom et Prénom :</label>
                                    <input type="text" class="form-control" id="nom-prenom" name="nom-prenom">
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="n-rue">N° :</label>
                                            <input type="text" class="form-control" id="n-rue" name="n-rue">
                                        </div>
                                    </div>

                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label for="rue">Rue :</label>
                                            <input type="text" class="form-control" id="rue" name="rue">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="CP">Code postal :</label>
                                            <input type="text" class="form-control" id="CP" name="CP">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ville">Ville :</label>
                                            <input type="text" class="form-control" id="ville" name="ville">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-default btn-inscription" name="Inscription">Inscription <i
                                            class="fas fa-check-circle" style="padding-top: 4px"></i></button>
                            </div>
                        </form>
                        <button type="button" class="btn btn-default btn-back-inscription" style="display: none;"><i
                                    class="fas fa-chevron-circle-left" style="padding-top: 4px"></i> Retour
                        </button>
                        <button type="button" class="btn btn-default btn-next-inscription">Suivant <i
                                    class="fas fa-chevron-circle-right" style="padding-top: 4px"></i></button>
                    </div>
                </div>

            </div>
        </div>
    <script src="../../js/inscription.js"></script>
    <?php
    include("../../includes/templates/footer.php");
    ?>
    </div>
    </body>
    </html>
<?php
}
?>