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
    <div clas="container">
        <div class="col-md-6 col-md-offset-3">
            <?php
            if(isset($_GET['type']) AND isset($_GET['error']) AND isset($_GET['name']))
            {
                $type['product'] = "Le produit ";
                $type['partner'] = "Le partner ";
                $type['categorie'] = "La catégorie ";
                echo "<div class=\"good\">" . $type[htmlspecialchars($_GET['type'])] . htmlspecialchars($_GET['name']) .
                    " a été ajouté !</div>";
            }

            include("includes/templates/form_add_product.php");
            include("includes/templates/form_add_partenaires.php");
            include("includes/templates/form_add_categories.php");
            ?>
        </div>
    </div>

    </body>

    <script src="js/search_ref.js"></script>

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