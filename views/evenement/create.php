<form method="POST">
<div class="form-group">

	<label for="equipe1">Équipe 1:</label>
	<select class="form-control" name="equipe1" id="equipe1">
	<?php foreach ($equipe as $value):?>

		<option value="<?= $value['nom'] ?>"><?= $value['nom'] ?></option>

	<?php endforeach; ?>
	</select>

	<label for="cote1">Côte 1:</label>
	<input type="number" step="0.01" min="1" name="cote1" id="cote1" required="Required">

	<br>
	<button type="button" class="btn btn-info col-md-offset-6">Contre</button>
	<br>

	<label for="equipe2">Équipe 2:</label>
	<select class="form-control" name="equipe2" id="equipe2">
	<?php foreach ($equipe as $value):?>

		<option value="<?= $value['nom'] ?>"><?= $value['nom'] ?></option>
		
	<?php endforeach; ?>
	</select>


	<label for="cote2">Côte 2:</label>
	<input type="number" step="0.01" min="1" name="cote2" id="cote2" required="Required">

	<br>
	<br>

	<label for="competition">Compétition:</label>
	<select class="form-control" name="competition" id="competition">
	<?php foreach ($compet as $value):?>

		<option value="<?= $value['nom'] ?>"><?= $value['nom'] ?></option>
		
	<?php endforeach; ?>
	</select>

	<br>

	<input type="date" name="date" required="Required"><input type="time" name="time" required="Required">

	<br>
</div>
<input type	="submit" name="submit" class="btn btn-success btn-send" value="Create">
</form>