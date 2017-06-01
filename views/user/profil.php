<?php if($_SESSION['id'] == $user['id']){ ?>

<a href="<?=WEBROOT?>user/edit" class="btn btn-success">Éditer le profil</a>
<a href="<?=WEBROOT?>jeton/achat" class="btn btn-success">Achat jeton</a>
<span>Nombre de Jeton: </span><button class="btn btn-info"><?=$user['jeton'] ?></button>

<?php } ?>
<h1 class="bg-danger"><?= "Profil de ".$user['prenom']." ".$user['nom']." alias ".$user['login'] ?></h1>

