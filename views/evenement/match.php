<h2 class="bg-info">FEUILLE DE MATCH:</h2>

<div class="text-center">                     
	<div>
	    <span><?=$match['date'] ?></span>
	</div>
	<div>
		<span><?=$match['compet'] ?></span>
    </div>
                    
    <div>
	    <div><?=$match['heure'] ?></div>

		<a href="#"><?=$match['equipe1'] ?> / <?=$match['equipe2'] ?></a>                        

		<div><a><?= $match['cote1'] ?> / <?= $match['cote2'] ?></a></div>

	</div>
	<hr>
	<?php if(isset($_SESSION['id'])){?>
	<form method="POST">
		<label for="equipe">Équipe :</label>
		<select class="form-control col-md-6" name="equipe" id="equipe">
			<option value="<?= $match['equipe1'] ?>"><?= $match['equipe1'] ?></option>
			<option value="<?= $match['equipe2'] ?>"><?= $match['equipe2'] ?></option>
		</select>
		<br>

		<label for="mise">Mise :</label>
		<br>
		<input type="number" step="0.1" min="0.5" name="mise" id="mise" required="Required">

		<br><br>

		<input type="submit" name="submit" class="btn btn-success" value="VALIDER">
	</form>
	<hr>
	<?php } ?>
</div>