<?php

// On vérifie si la fonction ini_set() a été désactivée...
$desactive = ini_get('disable_functions');
if (preg_match("/ini_set/i", "$desactive") == 0) {
// Si elle n'est pas désactivée, on définit ini_set de manière à n'afficher que les erreurs...
ini_set("error_reporting" , "E_ALL & ~E_NOTICE");
}

// Vérifier que le formulaire a été envoyé...
if (isset($_POST['envoi'])) {

//On commence une session pour enregistrer les variables du formulaire...
session_start();

$connection = mysql_connect("mysql51-46.perso","exiareimpress","exiaexia51");
//$connection = mysql_connect("127.0.0.1","root","");
if ( ! $connection )
die ("connection impossible"); 



$mabasededonnee="exiareimpress";
mysql_select_db($mabasededonnee) or die ("pas de connection"); 


$pseudo 	= mysql_real_escape_string($_POST['champ1']);
$nom 		= mysql_real_escape_string($_POST['champ2']);
$prenom 	= mysql_real_escape_string($_POST['champ3']);
$tel 		= mysql_real_escape_string($_POST['champ4']);
$mdp 		= md5($_POST['champ5']);
$mdp2 		= md5($_POST['champ6']);
$team 		= mysql_real_escape_string($_POST['champ7']);
$mail 		= mysql_real_escape_string($_POST['zone_email1']);
$jour 		= mysql_real_escape_string($_POST['liste1']);
$mois 		= mysql_real_escape_string($_POST['liste2']);
$annee 		= mysql_real_escape_string($_POST['liste3']);
$civilite 	= mysql_real_escape_string($_POST['liste4']);

$_SESSION['champ1'] 	= $pseudo;
$_SESSION['champ2'] 	= $nom;
$_SESSION['champ3'] 	= $prenom;
$_SESSION['champ4'] 	= $tel;
$_SESSION['champ5'] 	= $_POST["champ6"];
$_SESSION['champ6'] 	= $_POST["champ6"];
$_SESSION['champ7'] 	= $team;
$_SESSION['zone_email1']= $mail;
$_SESSION['liste1'] 	= $jour;
$_SESSION['liste2'] 	= $mois;
$_SESSION['liste3'] 	= $annee;
$_SESSION['liste4'] 	= $civilite;

// on crée la requête SQL
$sql = 'SELECT pseudo FROM inscription where pseudo=\''.$pseudo.'\'';

// on envoie la requête
$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());

// on fait une boucle qui va faire un tour pour chaque enregistrement
if(mysql_num_rows($req) > 0)
    {
		// on affiche les informations de l'enregistrement en cours
		echo '<script>alert(\'Ce joueur est déjà inscrit !\');</script>';
    }
else
	{
		$sql = "INSERT INTO inscription VALUES('','$pseudo','$nom','$prenom','$tel','$mdp','$team','$mail','$annee$mois$jour','$civilite',0)";
		$req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error());
	}
// on ferme la connexion à mysql


// Définir l\'icone apparaissant en cas d\'erreur...


  mysql_close(); 

// Définir sur 0 pour afficher un petit x de couleur rouge.
// Définir sur 1 pour afficher l\'image d\'une croix rouge telle que celle utilisée dans l\'assistant
// Si vous utilisez l\'option 1, l\'image de la croix rouge \'icone.gif\' doit se trouver dans le répertoire \'images\',
// ce dernier devant se trouver au même niveau que votre formulaire...
$flag_icone = 1;

// On vérifie si $flag_icone est défini sur 0 ou 1...
if ($flag_icone == 0) {
$icone = "<b><font size=\"3\" face=\"Arial, Verdana, Helvetica, sans-serif\" color=\"#CC0000\">x</font></b>";
} else {
$icone = "<img src=\"images/erreur.gif\"";
}

// Définir l'indicateur d'erreur sur zéro...
$flag_erreur = 0;
// N'envoyer le formulaire que s'il n'y a pas d'erreurs...
if ($flag_erreur == 0) {					




// Addresse de réception du formulaire
$email_dest = "sebastien.loillieux@gmail.com";
$sujet = "Inscription eXia'Lan";
$entetes ="MIME-Version: 1.0 \n";
	$entetes .="From: eXiaGame<exXiaGame@gmail.com>\n";
	$entetes .="Return-Path: eXiaGame<exXiaGame@gmail.com>\n";
	$entetes .="Reply-To: eXiaGame<exXiaGame@gmail.com>\n";
	$entetes .="Content-Type: text/html; charset=iso-8859-1 \n";
	$partie_entete = "<html>\n<head>\n<title>Formulaire</title>\n<meta http-equiv=Content-Type content=text/html; charset=iso-8859-1>\n</head>\n<body bgcolor=#FFFFFF>\n";


//Partie HTML de l'e-mail...
$partie_champs_texte .= "<font face=\"Verdana\" size=\"2\" color=\"#003366\">Pseudo = " . $_SESSION['champ1'] . "</font><br>\n";
$partie_champs_texte .= "<font face=\"Verdana\" size=\"2\" color=\"#003366\">Nom = " . $_SESSION['champ2'] . "</font><br>\n";
$partie_champs_texte .= "<font face=\"Verdana\" size=\"2\" color=\"#003366\">Prénom = " . $_SESSION['champ3'] . "</font><br>\n";
$partie_champs_texte .= "<font face=\"Verdana\" size=\"2\" color=\"#003366\">Tel = " . $_SESSION['champ4'] . "</font><br>\n";
$partie_champs_texte .= "<font face=\"Verdana\" size=\"2\" color=\"#003366\">Mot de passe = " . $_SESSION['champ5'] . "</font><br>\n";
$partie_champs_texte .= "<font face=\"Verdana\" size=\"2\" color=\"#003366\">Mot de passe (confirmation) = " . $_SESSION['champ6'] . "</font><br>\n";
$partie_champs_texte .= "<font face=\"Verdana\" size=\"2\" color=\"#003366\">Team = " . $_SESSION['champ7'] . "</font><br>\n";
$partie_zone_email .= "<font face=\"Verdana\" size=\"2\" color=\"#003366\">Mail = " . $_SESSION['zone_email1'] . "</font><br>\n";
$partie_listes .= "<font face=\"Verdana\" size=\"2\" color=\"#003366\">Jour = " . $_SESSION['liste1'] . "</font><br>\n";
$partie_listes .= "<font face=\"Verdana\" size=\"2\" color=\"#003366\">Mois = " . $_SESSION['liste2'] . "</font><br>\n";
$partie_listes .= "<font face=\"Verdana\" size=\"2\" color=\"#003366\">Année = " . $_SESSION['liste3'] . "</font><br>\n";
$partie_listes .= "<font face=\"Verdana\" size=\"2\" color=\"#003366\">Civilité = " . $_SESSION['liste4'] . "</font><br>\n";
					

					// Fin du message HTML
					$fin = "</body></html>\n\n";
					
					$sortie = $partie_entete . $partie_champs_texte . $partie_zone_email . $partie_listes . $partie_boutons . $partie_cases . $partie_zone_texte . $fin;
					//mail($email_dest,$sujet,$sortie,$entetes);
                    
                   
			    } // Fin du if ($flag_erreur == 0) {
			echo "<html><script> document.location.href=\"merci.php\";</script>";
			exit();
			} // Fin de if POST
?>

<!-- 
Assistant de création de formulaires PHP pour les nuls - Version gratuite 1.6
Auteur : Frédéric Ménard (assistant@f1-fantasy.net)
Site : http://www.f1-fantasy.net/assistant
 -->
<head>
<title>Formulaire</title><script language="JavaScript">


function verifSelection() {


if (document.mail_form.champ1.value == "") {
alert("Veuillez saisir un Pseudo.")
return false
} 

if (document.mail_form.champ2.value == "") {
alert("Veuillez saisir votre nom.")
return false
} 

if (document.mail_form.champ3.value == "") {
alert("Veuillez saisir votre prénom.")
return false
} 

if (document.mail_form.champ5.value == "") {
alert("Veuillez saisir le Mot de passe.")
return false
} 

if (document.mail_form.champ6.value == "") {
alert("Veuillez confirmer le Mot de passe.")
return false
} 

if (document.mail_form.champ5.value != document.mail_form.champ6.value) {
alert("Les mots de passe doivent être similaires")
return false
} 

if (document.mail_form.zone_email1.value == "") {
alert("Veuillez saisir un mail valide.")
return false
}

invalidChars = " /:,;'"

for (i=0; i < invalidChars.length; i++) {	// does it contain any invalid characters?
badChar = invalidChars.charAt(i)

if (document.mail_form.zone_email1.value.indexOf(badChar,0) > -1) {
alert("Votre adresse e-mail contient des caractères invalides. Veuillez vérifier.")
document.mail_form.zone_email1.focus()
return false
}
}

atPos = document.mail_form.zone_email1.value.indexOf("@",1)			// there must be one "@" symbol
if (atPos == -1) {
alert('Votre adresse e-mail ne contient pas le signe "@". Veuillez vérifier.')
document.mail_form.zone_email1.focus()
return false
}

if (document.mail_form.zone_email1.value.indexOf("@",atPos+1) != -1) {	// and only one "@" symbol
alert('Il ne doit y avoir qu\'un signe "@". Veuillez vérifier.')
document.mail_form.zone_email1.focus()
return false
}

periodPos = document.mail_form.zone_email1.value.indexOf(".",atPos)

if (periodPos == -1) {					// and at least one "." after the "@"
alert('Vous avez oublié le point "." après le signe "@". Veuillez vérifier.')
document.mail_form.zone_email1.focus()
return false
}

if (periodPos+3 > document.mail_form.zone_email1.value.length)	{		// must be at least 2 characters after the 
alert('Il doit y avoir au moins deux caractères après le signe ".". Veuillez vérifier.')
document.mail_form.zone_email1.focus()
return false
}

if (document.mail_form.liste1.value == "") {
alert("Veuillez saisir le jour de naissance.")
return false
} 

if (document.mail_form.liste2.value == "") {
alert("Veuillez saisir le mois de naissance.")
return false
} 

if (document.mail_form.liste3.value == "") {
alert("Veuillez saisir l\'année de naissance.")
return false
} 

if (document.mail_form.liste4.value == "") {
alert("Veuillez saisir la civilité.")
return false
} 

} // Fin de la fonction
</script>


</head><body><form width="300" name="mail_form" method="post" action="#" onSubmit="return verifSelection()">
  <div align="center"><font size="6" face="Verdana, Arial, Helvetica, sans-serif, Tahoma"><strong>Formulaire
    d'inscription</strong></font></div>
<div align="center"><font size="1" face="Verdana, Arial, Helvetica, sans-serif, Tahoma" color="#B9121B"><strong>Toute inscription érronée ne sera pas prise en compte.</strong></font></div>	

	<table align="center" width="300" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="16"><div align="center">
  <font color="#CC0000" size="2" face="Verdana, Arial, Helvetica, sans-serif, Tahoma"><strong><?php
if ($erreur_champ1) {
	  echo(stripslashes($erreur_champ1));
	  } else {
if ($erreur_champ2) {
	  echo(stripslashes($erreur_champ2));
	  } else {
if ($erreur_champ3) {
	  echo(stripslashes($erreur_champ3));
	  } else {
if ($erreur_champ4) {
	  echo(stripslashes($erreur_champ4));
	  } else {
if ($erreur_champ5) {
	  echo(stripslashes($erreur_champ5));
	  } else {
if ($erreur_champ6) {
	  echo(stripslashes($erreur_champ6));
	  } else {
if ($erreur_champ7) {
	  echo(stripslashes($erreur_champ7));
	  } else {
if ($erreur_email1) {
	  echo(stripslashes($erreur_email1));
	  } else {
if ($erreur_liste1) {
	  echo(stripslashes($erreur_liste1));
	  } else {
if ($erreur_liste2) {
	  echo(stripslashes($erreur_liste2));
	  } else {
if ($erreur_liste3) {
	  echo(stripslashes($erreur_liste3));
	  } else {
if ($erreur_liste4) {
	  echo(stripslashes($erreur_liste4));
	  } else {
} // Fin du else...
} // Fin du else...
} // Fin du else...
} // Fin du else...
} // Fin du else...
} // Fin du else...
} // Fin du else...
} // Fin du else...
} // Fin du else...
} // Fin du else...
} // Fin du else...
} // Fin du else...
?>
    </strong></font>
    </div></td>
      </tr>
    </table>
	<div style="float: left;">
<table border="0" align="center">
	<table width="300" border="0" align="center"><tr><td width="250" height="40"><div align="center"><font face="Verdana" size="3"><b>Identification Virtuelle</b></font></div></td></tr></table>
	<table width="300" border="0" align="center"><tr>
      <td width="140"><div align="right"><font face="Verdana" size="2">Pseudo</font><font face="Verdana" size="2" style="font-weight:bold;"color="#B9121B">*</font></div></td>
	  <td align="center" valign="middle" width="30">
      <?php
	  if ($erreur_champ1) {
	  echo($icone);
	  }
	  ?>
      </td>
      <td><input name="champ1" type="text" value="<?php stripslashes($_SESSION['champ1']);?>"></td>
    </tr></table>
	
	<table width="300" border="0" align="center"><tr>
      <td width="140"><div align="right"><font face="Verdana" size="2">Team</font></div></td>
	  <td align="center" valign="middle" width="30">
      <?php
	  if ($erreur_champ7) {
	  echo($icone);
	  }
	  ?>
      </td>
      <td><input name="champ7" type="text" value="<?php stripslashes($_SESSION['champ7']);?>"></td>
    </tr></table>
	
	<table width="300" border="0" align="center"><tr>
      <td width="140"><div align="right"><font face="Verdana" size="2">Mot de Passe</font><font face="Verdana" size="2" style="font-weight:bold;"color="#B9121B">*</font></div></td>
	  <td align="center" valign="middle" width="30">
      <?php
	  if ($erreur_champ5) {
	  echo($icone);
	  }
	  ?>
      </td>
      <td><input name="champ5" type="password" value="<?php stripslashes($_SESSION['champ5']);?>"></td>
    </tr></table><table width="300" border="0" align="center"><tr>
      <td width="140"><div align="right"><font face="Verdana" size="2">Confirmation Mdp</font><font face="Verdana" size="2" style="font-weight:bold;"color="#B9121B">*</font></div></td>
	  <td align="center" valign="middle" width="30">
      <?php
	  if ($erreur_champ6) {
	  echo($icone);
	  }
	  ?>
      </td>
      <td><input name="champ6" type="password" value="<?php stripslashes($_SESSION['champ6']);?>"></td>
    </tr></table>
	
	<table width="300" border="0" align="center"><tr><td width="250" height="75"><div align="center"><font face="Verdana" size="3"><b>Identification Réelle</b></font></div></td></tr></table>
	<table width="300" border="0" align="center"><tr>
      <td width="140"><div align="right"><font face="Verdana" size="2">Civilité</font><font face="Verdana" size="2" style="font-weight:bold;"color="#B9121B">*</font></div></td>
      <td width="30" align="center" valign="middle">
	  <?php
	  if ($erreur_liste4) {
	  echo($icone);
	  }
	  ?>
	  </td>
      <td><select name="liste4" style="width:146">
<option value="Mr"<?php
if ($_SESSION['liste4'] == "Mr") {
echo(" selected");
}
?>>Mr</option>
<option value="Mme"<?php
if ($_SESSION['liste4'] == "Mme") {
echo(" selected");
}
?>>Mme</option>
<option value="Mlle"<?php
if ($_SESSION['liste4'] == "Mlle") {
echo(" selected");
}
?>>Mlle</option>
</select></td></tr></table>
	<table width="300" border="0" align="center"><tr>
      <td width="140"><div align="right"><font face="Verdana" size="2">Nom</font><font face="Verdana" size="2" style="font-weight:bold;"color="#B9121B">*</font></div></td>
	  <td align="center" valign="middle" width="30">
      <?php
	  if ($erreur_champ2) {
	  echo($icone);
	  }
	  ?>
      </td>
      <td><input name="champ2" type="text" value="<?php stripslashes($_SESSION['champ2']);?>"></td>
    </tr></table><table width="300" border="0" align="center"><tr>
      <td width="140"><div align="right"><font face="Verdana" size="2">Prénom</font><font face="Verdana" size="2" style="font-weight:bold;"color="#B9121B">*</font></div></td>
	  <td align="center" valign="middle" width="30">
      <?php
	  if ($erreur_champ3) {
	  echo($icone);
	  }
	  ?>
      </td>
      <td><input name="champ3" type="text" value="<?php stripslashes($_SESSION['champ3']);?>"></td>
    </tr></table><table width="300" border="0" align="center"><tr>
      <td width="140"><div align="right"><font face="Verdana" size="2">Tel</font><font face="Verdana" size="2" style="font-weight:bold;"color="#B9121B">*</font></div></td>
	  <td align="center" valign="middle" width="30">
      <?php
	  if ($erreur_champ4) {
	  echo($icone);
	  }
	  ?>
      </td>
      <td><input name="champ4" type="text" value="<?php stripslashes($_SESSION['champ4']);?>"></td>
    </tr></table><table width="300" border="0" align="center"><tr>
      <td width="140"><div align="right"><font face="Verdana" size="2">Mail</font><font face="Verdana" size="2" style="font-weight:bold;"color="#B9121B">*</font></div></td>
      <td width="30" align="center" valign="middle">
	  <?php
	  if ($erreur_email1) {
	  echo($icone);
	  }
	  ?>
	  </td>
      <td><input name="zone_email1" type="email" value="<?php stripslashes($_SESSION['zone_email1']);?>"></td>
    </tr></table><table width="300" border="0" align="center"><tr>
      <td width="140"><div align="right"><font face="Verdana" size="2">Date de naissance</font><font face="Verdana" size="2" style="font-weight:bold;"color="#B9121B">*</font></div></td>
      <td width="30" align="center" valign="middle">
	  <?php
	  if ($erreur_liste1) {
	  echo($icone);
	  }
	  ?>
	  </td>
      <td width="30"><select name="liste1">
<option value="01"<?php
if ($_SESSION['liste1'] == "01") {
echo(" selected");
}
?>>01</option>
<option value="02"<?php
if ($_SESSION['liste1'] == "02") {
echo(" selected");
}
?>>02</option>
<option value="03"<?php
if ($_SESSION['liste1'] == "03") {
echo(" selected");
}
?>>03</option>
<option value="04"<?php
if ($_SESSION['liste1'] == "04") {
echo(" selected");
}
?>>04</option>
<option value="05"<?php
if ($_SESSION['liste1'] == "05") {
echo(" selected");
}
?>>05</option>
<option value="06"<?php
if ($_SESSION['liste1'] == "06") {
echo(" selected");
}
?>>06</option>
<option value="07"<?php
if ($_SESSION['liste1'] == "07") {
echo(" selected");
}
?>>07</option>
<option value="08"<?php
if ($_SESSION['liste1'] == "08") {
echo(" selected");
}
?>>08</option>
<option value="09"<?php
if ($_SESSION['liste1'] == "09") {
echo(" selected");
}
?>>09</option>
<option value="10"<?php
if ($_SESSION['liste1'] == "10") {
echo(" selected");
}
?>>10</option>
<option value="11"<?php
if ($_SESSION['liste1'] == "11") {
echo(" selected");
}
?>>11</option>
<option value="12"<?php
if ($_SESSION['liste1'] == "12") {
echo(" selected");
}
?>>12</option>
<option value="13"<?php
if ($_SESSION['liste1'] == "13") {
echo(" selected");
}
?>>13</option>
<option value="14"<?php
if ($_SESSION['liste1'] == "14") {
echo(" selected");
}
?>>14</option>
<option value="15"<?php
if ($_SESSION['liste1'] == "15") {
echo(" selected");
}
?>>15</option>
<option value="16"<?php
if ($_SESSION['liste1'] == "16") {
echo(" selected");
}
?>>16</option>
<option value="17"<?php
if ($_SESSION['liste1'] == "17") {
echo(" selected");
}
?>>17</option>
<option value="18"<?php
if ($_SESSION['liste1'] == "18") {
echo(" selected");
}
?>>18</option>
<option value="19"<?php
if ($_SESSION['liste1'] == "19") {
echo(" selected");
}
?>>19</option>
<option value="20"<?php
if ($_SESSION['liste1'] == "20") {
echo(" selected");
}
?>>20</option>
<option value="21"<?php
if ($_SESSION['liste1'] == "21") {
echo(" selected");
}
?>>21</option>
<option value="22"<?php
if ($_SESSION['liste1'] == "22") {
echo(" selected");
}
?>>22</option>
<option value="23"<?php
if ($_SESSION['liste1'] == "23") {
echo(" selected");
}
?>>23</option>
<option value="24"<?php
if ($_SESSION['liste1'] == "24") {
echo(" selected");
}
?>>24</option>
<option value="25"<?php
if ($_SESSION['liste1'] == "25") {
echo(" selected");
}
?>>25</option>
<option value="26"<?php
if ($_SESSION['liste1'] == "26") {
echo(" selected");
}
?>>26</option>
<option value="27"<?php
if ($_SESSION['liste1'] == "27") {
echo(" selected");
}
?>>27</option>
<option value="28"<?php
if ($_SESSION['liste1'] == "28") {
echo(" selected");
}
?>>28</option>
<option value="29"<?php
if ($_SESSION['liste1'] == "29") {
echo(" selected");
}
?>>29</option>
<option value="30"<?php
if ($_SESSION['liste1'] == "30") {
echo(" selected");
}
?>>30</option>
<option value="31"<?php
if ($_SESSION['liste1'] == "31") {
echo(" selected");
}
?>>31</option>
</select></td>
      
      <td width="30"><select name="liste2">
<option value="01"<?php
if ($_SESSION['liste2'] == "01") {
echo(" selected");
}
?>>01</option>
<option value="02"<?php
if ($_SESSION['liste2'] == "02") {
echo(" selected");
}
?>>02</option>
<option value="03"<?php
if ($_SESSION['liste2'] == "03") {
echo(" selected");
}
?>>03</option>
<option value="04"<?php
if ($_SESSION['liste2'] == "04") {
echo(" selected");
}
?>>04</option>
<option value="05"<?php
if ($_SESSION['liste2'] == "05") {
echo(" selected");
}
?>>05</option>
<option value="06"<?php
if ($_SESSION['liste2'] == "06") {
echo(" selected");
}
?>>06</option>
<option value="07"<?php
if ($_SESSION['liste2'] == "07") {
echo(" selected");
}
?>>07</option>
<option value="08"<?php
if ($_SESSION['liste2'] == "08") {
echo(" selected");
}
?>>08</option>
<option value="09"<?php
if ($_SESSION['liste2'] == "09") {
echo(" selected");
}
?>>09</option>
<option value="10"<?php
if ($_SESSION['liste2'] == "10") {
echo(" selected");
}
?>>10</option>
<option value="11"<?php
if ($_SESSION['liste2'] == "11") {
echo(" selected");
}
?>>11</option>
<option value="12"<?php
if ($_SESSION['liste2'] == "12") {
echo(" selected");
}
?>>12</option>
</select></td>
      <td width="280"><select name="liste3" style="width:146">
<option value="1970"<?php
if ($_SESSION['liste3'] == "1970") {
echo(" selected");
}
?>>1970</option>
<option value="1971"<?php
if ($_SESSION['liste3'] == "1971") {
echo(" selected");
}
?>>1971</option>
<option value="1972"<?php
if ($_SESSION['liste3'] == "1972") {
echo(" selected");
}
?>>1972</option>
<option value="1973"<?php
if ($_SESSION['liste3'] == "1973") {
echo(" selected");
}
?>>1973</option>
<option value="1974"<?php
if ($_SESSION['liste3'] == "1974") {
echo(" selected");
}
?>>1974</option>
<option value="1975"<?php
if ($_SESSION['liste3'] == "1975") {
echo(" selected");
}
?>>1975</option>
<option value="1976"<?php
if ($_SESSION['liste3'] == "1976") {
echo(" selected");
}
?>>1976</option>
<option value="1977"<?php
if ($_SESSION['liste3'] == "1977") {
echo(" selected");
}
?>>1977</option>
<option value="1978"<?php
if ($_SESSION['liste3'] == "1978") {
echo(" selected");
}
?>>1978</option>
<option value="1979"<?php
if ($_SESSION['liste3'] == "1979") {
echo(" selected");
}
?>>1979</option>
<option value="1980"<?php
if ($_SESSION['liste3'] == "1980") {
echo(" selected");
}
?>>1980</option>
<option value="1981"<?php
if ($_SESSION['liste3'] == "1981") {
echo(" selected");
}
?>>1981</option>
<option value="1982"<?php
if ($_SESSION['liste3'] == "1982") {
echo(" selected");
}
?>>1982</option>
<option value="1983"<?php
if ($_SESSION['liste3'] == "1983") {
echo(" selected");
}
?>>1983</option>
<option value="1984"<?php
if ($_SESSION['liste3'] == "1984") {
echo(" selected");
}
?>>1984</option>
<option value="1985"<?php
if ($_SESSION['liste3'] == "1985") {
echo(" selected");
}
?>>1985</option>
<option value="1986"<?php
if ($_SESSION['liste3'] == "1986") {
echo(" selected");
}
?>>1986</option>
<option value="1987"<?php
if ($_SESSION['liste3'] == "1987") {
echo(" selected");
}
?>>1987</option>
<option value="1988"<?php
if ($_SESSION['liste3'] == "1988") {
echo(" selected");
}
?>>1988</option>
<option value="1989"<?php
if ($_SESSION['liste3'] == "1989") {
echo(" selected");
}
?>>1989</option>
<option value="1990"<?php
if ($_SESSION['liste3'] == "1990") {
echo(" selected");
}
?>>1990</option>
<option value="1991"<?php
if ($_SESSION['liste3'] == "1991") {
echo(" selected");
}
?>>1991</option>
<option value="1992"<?php
if ($_SESSION['liste3'] == "1992") {
echo(" selected");
}
?>>1992</option>
<option value="1993"<?php
if ($_SESSION['liste3'] == "1993") {
echo(" selected");
}
?>>1993</option>
<option value="1994"<?php
if ($_SESSION['liste3'] == "1994") {
echo(" selected");
}
?>>1994</option>
<option value="1995"<?php
if ($_SESSION['liste3'] == "1995") {
echo(" selected");
}
?>>1995</option>
<option value="1996"<?php
if ($_SESSION['liste3'] == "1996") {
echo(" selected");
}
?>>1996</option>
<option value="1997"<?php
if ($_SESSION['liste3'] == "1997") {
echo(" selected");
}
?>>1997</option>
<option value="1998"<?php
if ($_SESSION['liste3'] == "1998") {
echo(" selected");
}
?>>1998</option>
<option value="1999"<?php
if ($_SESSION['liste3'] == "1999") {
echo(" selected");
}
?>>1999</option>
<option value="2000"<?php
if ($_SESSION['liste3'] == "2000") {
echo(" selected");
}
?>>2000</option>
<option value="2001"<?php
if ($_SESSION['liste3'] == "2001") {
echo(" selected");
}
?>>2001</option>
<option value="2002"<?php
if ($_SESSION['liste3'] == "2002") {
echo(" selected");
}
?>>2002</option>
<option value="2003"<?php
if ($_SESSION['liste3'] == "2003") {
echo(" selected");
}
?>>2003</option>
<option value="2004"<?php
if ($_SESSION['liste3'] == "2004") {
echo(" selected");
}
?>>2004</option>
<option value="2005"<?php
if ($_SESSION['liste3'] == "2005") {
echo(" selected");
}
?>>2005</option>
<option value="2006"<?php
if ($_SESSION['liste3'] == "2006") {
echo(" selected");
}
?>>2006</option>
<option value="2007"<?php
if ($_SESSION['liste3'] == "2007") {
echo(" selected");
}
?>>2007</option>
<option value="2008"<?php
if ($_SESSION['liste3'] == "2008") {
echo(" selected");
}
?>>2008</option>
<option value="2009"<?php
if ($_SESSION['liste3'] == "2009") {
echo(" selected");
}
?>>2009</option>
<option value="2010"<?php
if ($_SESSION['liste3'] == "2010") {
echo(" selected");
}
?>>2010</option>
<option value="2011"<?php
if ($_SESSION['liste3'] == "2011") {
echo(" selected");
}
?>>2011</option>
<option value="2012"<?php
if ($_SESSION['liste3'] == "2012") {
echo(" selected");
}
?>>2012</option>
</select></td></tr></table><table width="300" border="0" align="center"><tr height="100" >
<td valign="middle" ><div align="center"> 
            
		  <input type="submit" name="envoi" value="S'inscrire">
</div>
</div></td></tr></table><div align="center"><input name="nbre_fichiers" type="hidden" id="nbre_fichiers" value=""></div></div>
</form>
<div style="float: right;text-align: center;width:300px;">
<form method="post" action="inscription.php">
<font face="Verdana" size="3"><b>Connexion</b></font><br/><br/><br/>
<table>
<tr>
<td width="140"><div align="right"><font face="Verdana" size="2">Pseudo</font><font face="Verdana" size="2" style="font-weight:bold;"color="#B9121B">*</font></div></td>
<td></td>
<td></td>
<td><input type="text" name="conn_pseudo"/></td>
</tr>
<tr>
<td width="140"><div align="right"><font face="Verdana" size="2">Mot de Passe</font><font face="Verdana" size="2" style="font-weight:bold;"color="#B9121B">*</font></div></td>
<td></td>
<td></td>
<td><input type="password" name="conn_passwd"/></td>
</tr>
<tr>
<td></td>
<td></td>
<td></td>
		  <td><input type="submit" name="connect" value="Se connecter">
</td>
</tr>
</table>
</form>
</div>
</div></body></html>
