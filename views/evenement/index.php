<?php if(isset($_SESSION['id']) && $_SESSION['admin'] == "1"){ ?>

<a class="btn btn-success btn-send" href="<?=WEBROOT?>evenement/create">Créer un événement</a>

<?php } ?>

<h2 class="bg-info">MATCH:</h2>
<?php foreach ($match as $value):?>
<div class="text-center">                     
	<div>
	    <span><?=$value['date'] ?></span>
	</div>
	<div>
		<span><?=$value['compet'] ?></span>
    </div>
                    
    <div>
	    <div><?=$value['heure'] ?></div>

		<a href="<?=WEBROOT?>evenement/match/<?= $value['id_event']?>"><?=$value['equipe1'] ?> / <?=$value['equipe2'] ?></a>                       

		<div><a href="<?=WEBROOT?>evenement/match/<?= $value['id_event']?>"><?= $value['cote1'] ?> / <?= $value['cote2'] ?></a></div>
	</div>
	<hr>
</div>
	<?php endforeach; ?>