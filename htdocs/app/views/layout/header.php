<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Jetsy</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
            crossorigin="anonymous"></script>

    <link href="/public/css/style.css" rel="stylesheet">

</head>
<body>
<div class="container-fluid">
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/home/index"><?= _('Logo') ?></a>


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/home/index"><?= _('Home') ?></a>
                    </li>

                
            </ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"> <?= _('Language') ?></li>
           
            <ul><?php
            global $localizations;
            foreach ($localizations as $locale){
                echo "<li class=nav-item><a href='?lang=$locale'>". \Locale::getDisplayName($locale,$locale) . "</a></li>";
            }
            ?>
            </ul>

                </ul>
                <div class="d-flex">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php if (empty($_SESSION['is_logged_in'])){ ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                   aria-expanded="false">
                                   <?= _('Register') ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="/Register/buyer"><?= _('As a Buyer') ?></a></li>
                                    <li><a class="dropdown-item" href="/Register/seller"><?= _('As a Seller') ?></a></li>
                                </ul>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                   aria-expanded="false">
                                   <?= _('Login') ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="/Login/buyer"><?= _('As a Buyer') ?></a></li>
                                    <li><a class="dropdown-item" href="/Login/seller"><?= _('As a Seller') ?></a></li>
                                </ul>
                            </li>
                        <?php }
                        else{
                        ?>

                        <?php if ($_SESSION['is_logged_in'] == "seller") { ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                   aria-expanded="false">
                                   <?= _('Seller Panel') ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="/SellerProduct/index"><?= _('Products') ?></a></li>
                                    <li><a class="dropdown-item" href="/Order/seller"><?= _('Orders') ?></a></li>
                                </ul>
                            </li>
                            <?php }
                            else{ ?>
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="/Cart/index"><?= _('Carts') ?></a>
                                </li>

                                <?php if (is_null($_SESSION['secret_key2'])) { ?> 
                                <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/Login/setup2fa"><?= _('Setup 2fa') ?></a>
                                    
                                      <?php } ?>
                                

                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                       aria-expanded="false">
                                        Buyer Panel
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="/Order/myorders"><?= _('My Orders') ?></a></li>
                                    </ul>
                                </li>
                                <?php } ?>

                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="/Login/logout"><?= _('Logout') ?></a>
                            </li>
                        <?php } ?>


                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>




