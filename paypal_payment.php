<?php
include ("conf_paypal.php");


$connection = mysql_connect("mysql51-46.perso","exiareimpress","exiaexia51");
$mabasededonnee="exiareimpress";
mysql_select_db($mabasededonnee);

    // lire le formulaire provenant du système PayPal et ajouter 'cmd'
    $req = 'cmd=_notify-validate';
    
    foreach ($_POST as $key => $value) {
        $value = urlencode(stripslashes($value));
        $req .= "&$key=$value";
	}

    // renvoyer au système PayPal pour validation
    $header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
	$header .= "Host: www.sandbox.paypal.com:443\r\n";
    $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
    $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
    $fp = fsockopen ($ipn_paypal, 443, $errno, $errstr, 30);

    $item_name = $_POST['item_name'];
    $item_number = $_POST['item_number'];
    $payment_status = $_POST['payment_status'];
    $payment_amount = $_POST['mc_gross'];
    $payment_currency = $_POST['mc_currency'];
    $txn_id = $_POST['txn_id'];
    $receiver_email = $_POST['receiver_email'];
    $payer_email = $_POST['payer_email'];
    $id_user = $_POST['custom'];

		//mail("limason51@gmail.com","payment PAYPAL","Etape 0 Success");

    if (!$fp) {
    // ERREUR HTTP
					mail("limason51@gmail.com","PAYMENT PAYPAL ERREUR HTTP", "Payment de l'utilisateur n°{".$id_user."}, ordre de payment {".$payment_amount."}€");
    } else {
        fputs ($fp, $header . $req);
		//mail("limason51@gmail.com","payment PAYPAL","Etape 1 Success");
        while (!feof($fp)) {
            $res = fgets ($fp, 1024);
		//mail("limason51@gmail.com","payment PAYPAL","Etape 2 Success, result:\n".$res);
            if (strcmp ($res, "VERIFIED") == 0) {
               // vérifier que payment_status a la valeur Completed
                if ( $payment_status == "Completed") {
                    // vérifier que txn_id n'a pas été précédemment traité: Créez une fonction qui va interroger votre base de données
                    if(VerifIXNID($txn_id) == 0) {
                        // vérifier que receiver_email est votre adresse email PayPal principale
                        if ( $cmpt_paypal == $receiver_email) {
                            // vérifier que payment_amount et payment_currency sont corrects
                            // traiter le paiement
					mail("limason51@gmail.com","PAYMENT PAYPAL ACCEPTER", "Payment de l'utilisateur n°{".$id_user."}, ordre de payment {".$payment_amount."}€");
					$result = mysql_query ("SELECT mail,Payer FROM inscription WHERE id_joueur = ".$id_user);
$result = mysql_fetch_assoc($result);
					mysql_query ("UPDATE inscription SET Payer = ".($result["Payer"]+$payment_amount)." WHERE id_joueur = ".$id_user);
					if (($result["Payer"]+$payment_amount) >= 10){
							mail ($result["mail"],"eXiaGame","Merci d'avoir acheté votre place pour la Lan party");
					}
					else{
							mail ($result["mail"],"eXiaGame","Merci d'avoir acheté votre place pour la Lan party mais il manque ".(10-($result["Payer"]+$payment_amount))."Euros");
					}
                         }
			  else {
				// Mauvaise adresse email paypal
					mail("limason51@gmail.com","ERREUR PAYMENT ADRESSE EMAIL PAYPAL", "Erreur avec le payment utilisateur concerner {".$id_user."}, ordre de payment {".$payment_amount."}€ ERREUR AVEC L'ADRESSE EMAIL PAYPAL");
			  }
			}
			else {
				// ID de transaction déjà utilisé
					mail("limason51@gmail.com","ERREUR ID PAYMENT PAYPAL", "Erreur avec le payment utilisateur concerner {".$id_user."}, ordre de payment {".$payment_amount."}€ ID PAYMENT DEJA UTILISER");
					}
			}
		  else {
		        	// Statut de paiement: Echec
					mail("limason51@gmail.com","ERREUR ECHEC PAYMENT PAYPAL", "Erreur avec le payment utilisateur concerner {".$id_user."}, ordre de payment {".$payment_amount."}€ Statuts ECHEC. IPN REPONSSE:\n".$res);
		  }
					
            }
            else if (strcmp ($res, "INVALID") == 0) {
                // Transaction invalide                
					mail("limason51@gmail.com","ERREUR TRANSACTION PAYPAL", "Erreur avec le payment utilisateur concerner {".$id_user."}, ordre de payment {".$payment_amount."}€");
            }
        }
        fclose ($fp);
    }

function VerifIXNID($txn_id)
{
	include "functions/conn.php";
	$req = mysql_query("SELECT txn_id from paypal where txn_id='".$txn_id."'");
	$nbr = mysql_num_rows($req); 
 
	if ($nbr == 0)
	{
		mysql_query("INSERT INTO paypal (txn_id) VALUES ('".$txn_id."')");
		return 0;
	}
	else
	{
		return 1;
	}
}
?>
