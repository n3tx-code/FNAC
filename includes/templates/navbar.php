<!-- todo : responsive https://www.w3schools.com/bootstrap/tryit.asp?filename=trybs_navbar_collapse&stacked=h -->
<div class="header-navbar">
    <div class="row">
        <a href="/" style="color: inherit; text-decoration: none;">
            <h1 class="site-title text-center">FNEC</h1><br>
            <h6 class="site-second-title text-center">Fédération Nationale Electroménager Cool</h6>
        </a>
    </div>
    <div class="row">
        <div class="nav-logo col-md-1">
            <a href="/"><img src="/img/logo.png" class="img-responsive"></a>
        </div>
        <div class="col-md-7">
            <span class="categorie">Informatique</span>
            <span class="categorie">Téléphonie</span>
            <span class="categorie">Télévision</span>
            <span class="categorie">Billet</span>
            <span class="categorie">Electroménager</span>
            <span class="categorie">Musique</span>
            <span class="categorie">Lecture</span>

        </div>
        <div class="nav-search col-md-3">
            <div class="input-group stylish-input-group">
                <input type="text" class="form-control"  placeholder="Recherche" >
                <span class="input-group-addon">
                    <button>
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </div>
        <div class="col-md-1">
            <div class="row">
                <div class="nav-user col-md-4">
                    <?php
                        $color = "inherit";
                        if(isset($_SESSION['ID']))
                        {
                            $color = "#FFBE14";
                        }
                    ?>
                    <a href="/profil" style="color : <?= $color ?>"><i class="fas fa-user-alt"></i></a>
                </div>
                <div class="nav-basket col-md-4">
                    <i class="fas fa-shopping-cart"></i>
                </div>
            </div>

        </div>
    </div>
</div>