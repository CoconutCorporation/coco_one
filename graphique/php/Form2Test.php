<!doctype html>
<html>
    <head><title>Guess the coco </title></head>
    <body>

<!------------------------------------------------------------------------------->    
<!----------------SAISIE, CONNEXION, ENREGISTREREMENT, AFFICHAGE----------------->
<!------------------------------------------------------------------------------->

        <h1> Bienvenus dans Guess The Coco !</h1>
        <h2>Entrez votre pseudo et votre mot de passe :</h2>
        
<!------------------------------FORMULAIRE DE SAISIE------------------------------>
		
		<form name="poster" method="post" action="Form2Test.php">
            Pseudo: <input type="text" name="pseudo" /> <br />
            Email: <input type="text" name="email" /> <br />
            Mot de passe: <input type="text" name="mdp" /> <br />
            <input type="submit" name="valider" value="OK"/>
            </form>

<!--------------------------------DEBUT DU CODE PHP--------------------------------->		
        <?php
	
///////////////////////////CONNEXION SERVEUR + SELECTION BD//////////////////////////

			// Déclaration des variables pour la connexion
			$serveur = 'localhost';
			$nom_base = 'guess_the_correlation';
			$login = 'root';		//utilisateur par défaut
			$motdepasse = '';		//mot de passe par défaut pour "root" (pas de pwd)
		
			// connexion à MySQL
			$id_con = mysql_connect($serveur, $login, $motdepasse);

			// sélection de la base de données
			$stat_con = mysql_select_db ($nom_base, $id_con);
		
//////////////////////////////////ENREGISTREMENT EN BDD//////////////////////////////////
		
    
            //On récupère les valeurs entrées par l'internaute :
            $pseudo=$_POST['pseudo'];
            
            
            $email=$_POST['email'];
            
            
            $motdepasse=$_POST['mdp'];
            
                            
            //On prépare la commande sql d'insertion
            $req = 'INSERT INTO infos (Pseudo, Email, Mdp) VALUES("'.$pseudo.'","'.$motdepasse.'","'.$email.'")'; 
                            
            //on lance la commande (mysql_query) 
            mysql_query($req) ;
            
		

			
            // on ferme la connexion
            mysql_close();
        
        ?>
<!------------------------------FIN DU CODE PHP------------------------------>			
    </body>
</html>
