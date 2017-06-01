<form method="POST">
    <div class="col-md-6 formu">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="login">Login ou Email</label>
                    <input id="login" type="text" name="login" class="form-control" placeholder="Login/Mail" required="required">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="mdp">Mot de passe</label>
                    <input id="mdp" type="password" name="mdp" class="form-control" placeholder="Mot de passe" required="required">
                </div>
            </div>
        </div>

            <div>
                <input type="submit" name="submit" class="btn btn-success btn-send" value="Connexion">
            </div>
    </div>
</form>