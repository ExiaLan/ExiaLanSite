<?php
if(isset($_SESSION)){
		session_start();		
}

include("conf_paypal.php");

$connection = mysql_connect("mysql51-46.perso","exiareimpress","exiaexia51");
//$connection = mysql_connect("127.0.0.1","root","");
$mabasededonnee="exiareimpress";
$login=FALSE;
mysql_select_db($mabasededonnee);

/*******************
 * Debut programme *
 *******************/

if (isset($_POST["conn_pseudo"]) && isset($_POST["conn_passwd"]) && $connection){
		$result = mysql_query('SELECT mdp,Payer,id_joueur FROM inscription where pseudo=\''.mysql_real_escape_string($_POST["conn_pseudo"]).'\'');
$result = mysql_fetch_assoc($result);
$login = ($result["mdp"] == md5($_POST["conn_passwd"]))?TRUE:FALSE;
if ($login){
		$_SESSION["conn_as"] = mysql_real_escape_string($_POST["conn_pseudo"]);

}
}else{
include("form.php");
}
if ($login){
		if($result["Payer"] < 10){
?>
		<h2 style="color:#FF0000;" align="center">Vous n'avez pas encore payé la Lan. Il vous reste <?php echo (10-$result["Payer"]); ?>€ à payer.</h2>
		<form action="<?= $site_paypal ?>" method="post">
				<input type='hidden' value="<?= (10-$result["Payer"]) ?>" name="amount" />
				<input name="currency_code" type="hidden" value="EUR" />
				<input name="shipping" type="hidden" value="0.00" />
				<input name="tax" type="hidden" value="0.00" />
				<input name="return" type="hidden" value="http://exiagame.exia-reims.fr/merci.php" />
				<input name="cancel_return" type="hidden" value="http://exiagame.exia-reims.fr/inscription.php" />
				<input name="notify_url" type="hidden" value="http://exiagame.exia-reims.fr/paypal_payment.php" />
				<input name="cmd" type="hidden" value="_xclick" />
				<input name="business" type="hidden" value="<?= $cmpt_paypal ?>" />
				<input name="item_name" type="hidden" value="Place eXiaGame" />
				<input name="no_note" type="hidden" value="1" />
				<input name="lc" type="hidden" value="FR" />
				<input name="bn" type="hidden" value="PP-BuyNowBF" />
				<input name="custom" type="hidden" value="<?= $result["id_joueur"] ?>" />
				<input alt="Effectuez vos paiements via PayPal : une solution rapide, gratuite et sécurisée" name="submit" src="https://www.paypal.com/fr_FR/FR/i/btn/btn_buynow_LG.gif" type="image" /><img src="https://www.paypal.com/fr_FR/i/scr/pixel.gif" border="0" alt="" width="1" height="1" />
				</form>
<a href="merci.php">Merci</a>
<?php
		}else{
?>
<a href="merci.php"><h2>Merci d'avoir payé.</h2></a>
<?php
		}
}else{
echo "<h3 style=\"color: #FF0000;\" align=\"center\" >Mauvais Pseudo ou Mot de passe</h3>";
include("form.php");
}

?>
