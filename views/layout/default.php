<!DOCTYPE html>
<html lang="fr">
    <head>
        <title><?= $title ?></title>
        <meta charset="UTF-8">
        <link rel="icon" href="<?=WEBROOT?>assets/images/favicon.png"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?=WEBROOT?>assets/css/style.css" />
    </head>
    <body>
        <div class="example3">
            <nav class="navbar navbar-inverse navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar3">
                        </button>
                        <a class="navbar-brand" href="<?=WEBROOT?>"><img id="logo" src="<?=WEBROOT?>assets/images/test1.png" alt="Logo uBet"></a>
                    </div>
                    <div id="navbar3" class="navbar-collapse collapse">
                        <ul class="nav navbar-nav navbar-right">

                            <li><a href="<?=WEBROOT?>">Accueil</a></li>
                            <li><a href="<?=WEBROOT?>evenement">Paris Sportifs</a></li>

                            <?php if(!isset($_SESSION['id'])){ ?>

                            <li><a href="<?=WEBROOT?>user/connexion">Connexion</a></li>
                            <li><a href="<?=WEBROOT?>user/inscription">S'inscrire</a></li>

                            <?php }else{ ?>

                            <li><a href="<?=WEBROOT?>user/profil/<?=$_SESSION['id']?>">Profil</a></li>
                            <li><a href="<?=WEBROOT?>user/deconnexion">DECO</a></li>
                            
                            <?php } ?>

                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="container">
            <?= $content_for_layout ?>
        </div>
    </body>
</html>