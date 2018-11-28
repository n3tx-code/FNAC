<?php
session_start();
if(isset($_SESSION['ID']) AND $_SESSION['ID'] == 1)
{
    include ("../includes/style.php");
    include ("../includes/bdd.php");
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>Admin add</title>
    </head>
    <body>
    <h1 class="text-center">Administration du site FNEC</h1>
    <div clas="container">
        <div class="col-md-6 col-md-offset-3">
            <?php
            if(isset($_GET['type']) AND isset($_GET['error']) AND isset($_GET['name']))
            {
                $type['product'] = "Le produit ";
                $type['partner'] = "Le partner ";
                $type['categorie'] = "La catégorie ";
                $type['promo'] = "La promotion ";
                $type['shop'] = "La boutique ";
                if($_GET['error'] == 'img')
                {
                    echo "<div class=\"erreur\">Erreur dans l'import de l'image : " . htmlspecialchars($_GET['name']) .
                        "!</div>";
                }
                elseif ($_GET['error'] == "missing")
                {
                    echo "<div class=\"erreur\"> Merci de remplir tous les champs</div>";
                }
                if($_GET['type'] == "stock")
                {
                    echo "<div class=\"good\"> Le stock a été mis à jour</div>";
                }
                else
                {
                    echo "<div class=\"good\">" . $type[htmlspecialchars($_GET['type'])] . htmlspecialchars($_GET['name']) .
                        " a été ajouté !</div>";
                }



            }

            include("includes/templates/form_add_product.php");
            include("includes/templates/form_add_partenaires.php");
            include("includes/templates/form_add_categories.php");
            include("includes/templates/form_add_promo.php");
            include("includes/templates/form_add_shop.php");
            include("includes/templates/form_stock.php");
            include("includes/templates/form_stats.php");
            ?>
        </div>
    </div>

    </body>
    <script>
        //search.init('search_ref_promo', 'search_result');

        $(".add-admin-title").click(function () {
           var form = $(this.nextElementSibling);
           form.toggle();
        });
    </script>

    </html>

    <?php
}
else
{
    header("location: /");
}
?>