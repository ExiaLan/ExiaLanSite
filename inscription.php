<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
  <head>
    <title>ExiaGame</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="title" content="ExiaGame" />
    <meta name="description" content="Exiagame Lan Inscription WebSite" />
    <meta name="keywords" content="lan, exia, exiagame, reims" />
    <meta name="language" content="fr-fr" />
    <meta name="subject" content="ExiaLan" />
    <meta name="robots" content="All" />
    <meta name="copyright" content="ExiaGame" />
    <meta name="MSSmartTagsPreventParsing" content="true" />
    <link id="theme" rel="stylesheet" type="text/css" href="style.css" title="theme" />
	<link rel="shortcut icon" href="favicon.ico">
	
	<script type="text/javascript" src="js/jquery-1.7.2.js"></script>
	<script type="text/javascript" src="js/caroufredsel.js"></script>
  </head>
  <body> 
    <!-- top wrapper -->  
    <div id="topWrapper"> 
      <div id="topBanner"></div> 
    </div>  
	
	<!-- ici le menu --> 
	<?php include('menu.php'); ?>
    
	<!-- end top wrapper -->  
    <div id="wrapper"> 
      <div id="bg"> 
        <div id="header"></div>  
        <div id="page"> 
          <!-- begin container -->  
          <div id="container"> 
            <!--  content -->  
            <div id="content"> 
              <div id="center"> 
                <div id="welcome"> 
				<p style="text-align:center;color:red;"><strong>Les inscriptions en ligne sont désormais closes !</strong></p>
				<!--<a style="text-align:center;color:blue;" href="http://www.facebook.com/events/537696276253888/538033002886882/" target=new>En attendant, visitez notre page Facebook !</a>-->
                  <!--<p style="text-align:center"><strong>Il est également possible de s'inscrire au BDE !</strong></p>-->
				  <?php 					//include(((isset($_POST['conn_pseudo'])))?"login.php":'form.php');					?>
                </div> 
              </div>
              <div id="right"> 
                <div id="sidebar"> 

				<table>
					<tr>
						<td><a href='http://euw.leagueoflegends.com/fr'target=new ><img src="images/games/logo_lol.jpg" /></a></td><td><a href='http://euw.leagueoflegends.com/fr'target=new ><p>League of Legends</p></a></td>
					</tr>
					<tr>
						<td><a href='http://eu.battle.net/sc2/fr/'target=new ><img src="images/games/logo_sc2.jpg" /></a></td><td><a href='http://eu.battle.net/sc2/fr/'target=new ><p>Starcraft II</p></a></td>
					</tr>
					<tr>
						<td><a href='http://store.steampowered.com/app/730/?l=french' target=new><img src="images/games/logo_css.jpg" target=new /></td><td><a href='http://store.steampowered.com/app/730/?l=french' target=new><p>Counter Strike</p></a></td>
					</tr>
				</table>
				  
                  <h3 style="margin-top:40px">News</h3>  					
                  <p>Les inscriptions en ligne sont désormais closes.<br>Il vous est toujours possible de venir à LAN Party et régler les frais d'inscription sur place !</p>  					
                  <div style="text-align:center;margin:20px 0"> 
                    <a href='inscription.php'><img width='150' height='150' src="images/register.png" /> </a>
                  </div> 
                </div> 
              </div>  
              <div class="clear" style="height:40px"></div> 
            </div>  
            <!-- end content --> 
          </div>  
          <!-- end container --> 
        </div>  
        <div id="footerWrapper"> 
          <div id="footer"> 
            <?php include('footer.php'); ?>
          </div> 
        </div> 
      </div> 
    </div> 
  </body>
</html>
