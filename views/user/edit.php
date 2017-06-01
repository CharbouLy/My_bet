<form method="POST">
    <div class="col-md-6 formu">

    	<div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="prenom">Prénom *</label>
                    <input id="prenom" type="text" name="prenom" class="form-control" value="<?= $user['prenom'] ?>" placeholder="Entrez votre Prénom *" pattern=".{2,30}" required title="2 à 30 caractères">
                </div>
            </div>
		</div>

       	<div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nom">Nom *</label>
                    <input id="nom" type="text" name="nom" class="form-control" value="<?= $user['nom'] ?>" placeholder="Entrez votre Nom *" pattern=".{2,30}" required title="2 à 30 caractères">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="login">Login *</label>
                    <input id="login" type="text" name="login" class="form-control" value="<?= $user['login'] ?>" placeholder="Entrez votre Login *" pattern=".{2,20}" required title="2 à 20 caractères">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email *</label>
                    <input id="email" type="email" name="email" class="form-control" value="<?= $user['email'] ?>" placeholder="Entrez votre Email *" required="required">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="mdp">Nouveau mot de passe</label>
                    <input id="mdp" type="password" name="mdp" class="form-control" placeholder="Entrez votre Nouveau mot de passe">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="mdp2">Confirmez votre Mot de passe</label>
                    <input id="mdp2" type="password" name="mdp2" class="form-control" placeholder="Confirmez votre Mot de passe">
                </div>
            </div>
        </div>

            <div>
                <input type="submit" name="submit" class="btn btn-success btn-send" value="Modifier">
            </div>

        <div class="row">
            <div class="col-md-12">
                <p class="text-muted"><strong>*</strong> Champs obligatoires.</p>
            </div>
        </div>
    </div>
</form>