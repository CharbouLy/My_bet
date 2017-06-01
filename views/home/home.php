<?php if (!isset($_SESSION['id'])){ ?>

<a href="<?=WEBROOT?>user/inscription"><img id="offre" class="img-responsive" src="<?=WEBROOT?>assets/images/offre.png" alt="Offre uBet"></a>

<?php }else{ ?>

<a href="<?=WEBROOT?>evenement" class="btn btn-primary btn-lg btn-block">Match à venir</a>

<?php } ?>