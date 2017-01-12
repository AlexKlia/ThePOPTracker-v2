<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">

        <title><?= $title ?></title>

        <!-- Google fonts -->
        <link href="https://fonts.googleapis.com/css?family=Cabin+Sketch:700|Luckiest+Guy|Roboto:400,400i,700" rel="stylesheet">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <link rel="stylesheet" href="<?= cssUrl("styles.min"); ?>">
        <link rel="stylesheet" href="<?= cssUrl("font-awesome-4.7.0/css/font-awesome.min"); ?>">

        <script
                src="https://code.jquery.com/jquery-3.1.1.min.js"
                integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
                crossorigin="anonymous">
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <script
                src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
                integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
                crossorigin="anonymous">
        </script>
    </head>
    <body>

    <div class="row">
        <header id="header" class="col col-xs-12 hidden-sm-down text-center">
            <div class="col col-sm-4 nav-right">
                <ul class="nav nav-tabs nav-justified  text-center list-inline col-sm-12 navHeader">
                    <?php if ($logged) : ?>
                        <li class="col col-sm-4"><a href="<?= site_url('Home/index'); ?>" class="h4 hr">Accueil</a></li>
                        <li class="col col-sm-4"><a href="<?= site_url('Categorie') ?>" class="h4 hr">Categorie</a></li>
                        <li class="col col-sm-4"><a href="#" class="h4 hr">Profil</a></li>
                    <?php else : ?>
                        <li class="col col-sm-4"><a href="<?= site_url('Home/index'); ?>" class="h4 hr col col-sm-4">Accueil</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="col col-sm-4">
                <h1 id="title">The<span id="popTitle">POP</span>Tracker</h1>
            </div>
            <div class="col col-sm-4 nav-left">
                <ul class="nav nav-tabs nav-justified  text-center list-inline col-sm-12 navHeader">
                    <?php if (!$logged) : ?>
                        <li class="col col-sm-4"><a href="<?= site_url('Categorie') ?>" class="h4 hr">Categorie</a></li>
                        <li class="col col-sm-4"><a href="<?= site_url('user_authentication/login'); ?>" class="h4 hr">Connexion</a></li>
                        <li class="col col-sm-4"><a href="#" class="h4 hr">Inscription</a></li>
                    <?php else : ?>
                        <li class="col col-sm-4"><a href="#" class="h4 hr">Collection</a></li>
                        <li class="col col-sm-4"><a href="#" class="h4 hr">WishList</a></li>
                        <li class="col col-sm-4"><a href="<?= site_url('user_authentication/logout'); ?>" class="h4 hr">Deconnexion</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </header>

        <nav class="navbar navbar-default hidden-md-up">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?= site_url('Home/index'); ?>">The<span class="popTitle">POP</span>Tracker</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <?php if (!$logged) : ?>
                            <li><a href="<?= site_url('Home/index'); ?>">Accueil</a></li>
                            <li><a href="#">Categorie</a></li>
                            <li><a href="<?= site_url('user_authentication/login'); ?>">Connexion</a></li>
                            <li><a href="#">Inscription</a></li>
                        <?php else : ?>
                            <li><a href="<?= site_url('Home/index'); ?>">Accueil</a></li>
                            <li><a href="#">Categorie</a></li>
                            <li><a href="#">Collection</a></li>
                            <li><a href="#">WishList</a></li>
                            <li><a href="#">Profil</a></li>
                            <li><a href="<?= site_url('user/logout'); ?>">Deconnexion</a></li>
                        <?php endif; ?>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>


        <div class="col col-sm-12 hidden-sm-down">
            <div class="col col-sm-offset-4 col-sm-4">
                <div id="halfCircle">
                    <a href="#">
                        <?= img('logo.png','Logo ThePOPTracker','col col-sm-12 img-circle logo') ?>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row text-center">
        <form action="#" method="POST" class="form-inline">
            <input type="hidden" id="url_hidden" value="#" >
            <div class="form-group global col-sm-4 col-sm-offset-4" >
                <div class="form-group">
                    <label>Recherche : </label>
                    <input id="allPopSearch" type="text" name="search" class="form-control" placeholder="Nom du pop ...">
                </div>
                <button type="submit" name="submit" class="btn btn-default">Rechercher</button>
            </div>
        </form>
    </div>

    <div class="container main-container">