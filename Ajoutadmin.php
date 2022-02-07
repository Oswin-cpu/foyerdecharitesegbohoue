<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=foyer', 'root', '');
 
if(isset($_POST['forminscription'])) {
   $pseudo = htmlspecialchars($_POST['pseudo']);
   $mail = htmlspecialchars($_POST['mail']);
   $mail2 = htmlspecialchars($_POST['mail2']);
   $mdp = sha1($_POST['mdp']);
   $mdp2 = sha1($_POST['mdp2']);
   if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {
      $pseudolength = strlen($pseudo);
      if($pseudolength <= 255) {
         if($mail == $mail2) {
            if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
               $reqmail = $bdd->prepare("SELECT * FROM membres WHERE mail = ?");
               $reqmail->execute(array($mail));
               $mailexist = $reqmail->rowCount();
               if($mailexist == 0) {
                  if($mdp == $mdp2) {
                     $insertmbr = $bdd->prepare("INSERT INTO membres(pseudo, mail, pass) VALUES(?, ?, ?)");
                     $insertmbr->execute(array($pseudo, $mail, $mdp));
                     $erreur = "Membre ajouté avec succes ";
                    
                  } else {
                     $erreur = "Vos mots de passes ne correspondent pas !";
                  }
               } else {
                  $erreur = "Adresse mail déjà utilisée !";
               }
            } else {
               $erreur = "Votre adresse mail n'est pas valide !";
            }
         } else {
            $erreur = "Vos adresses mail ne correspondent pas !";
         }
      } else {
         $erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
?>
	<html>
   <head>
   <meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<!-- Font awesome cdn CSS-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<!-- Bootstrap core CSS -->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/stylesprog.css" />
      <title>Ajout Administrateur</title>
      <header>
			<?php require_once('Includes/header.php') ?>
		</header>
   </head>
   <body class="order-form" style="background-color:#d6d6d6">
   <section>
  <br>
  <br>
  <br>
  <br>
  <br>
   </section>
      <section >
		<div class="container">
				<h2 class="merriweather text-center mb-4">Ajouter un Administrateur</h2>
				<form method="POST" action="">
               
					
<div class="row">
						<div class="col-md-6 col-sm">
							<div class="input-group mb-3">
                        <input type="text" placeholder="Votre pseudo" class="form-control" id="pseudo" name="pseudo" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>" />
							</div>
						</div>

               
						<div class="col-md-6 col-sm">
							<div class="input-group mb-3">
								<input type="email" placeholder="Votre mail" class="form-control" id="mail" name="mail" value="<?php if(isset($mail)) { echo $mail; } ?>" />
							</div>	
						</div>
               </div>

               <div class="row">
                  <div class="col-md-6 col-sm">
							<div class="input-group mb-3">
                     <input type="email" placeholder="Confirmez votre mail" class="form-control" id="mail2" name="mail2" value="<?php if(isset($mail2)) { echo $mail2; } ?>" />
                     </div>
                  </div>
					
               
                  <div class="col-md-6 col-sm">
							<div class="input-group mb-3">
                     <input type="password" placeholder="Votre mot de passe" class="form-control" id="mdp" name="mdp" />
							</div>
                  </div>	
				   </div>

               <div class="row">
                  <div class="col-md-12 col-sm">
							<div class="input-group mb-3" style="display:flex; justify-content:center; align-items:center">
                     <input type="password" placeholder="Confirmez votre mdp" class="form-control" id="mdp2" name="mdp2" />
							</div>	
						</div>
					</div>

               <div class="row">
               <div class="col-md-6 col-sm">
                           <div class="input-group mb-3" style="display:flex; justify-content:right;align-items:center;">
							         <a href="admin.php"  class="btn btn-secondary btn-lg text-light" style="display:flex; justify-content:center;align-items:center;height: 50px;width:95px;font-size:15px;"> <strong>Retour</strong></a>
							      </div>
					   </div>

                  <div class="col-md-6 col-sm">
							<div class="input-group mb-3" style="display:flex; justify-content:left; align-items:center;">
                     <input type="submit" name="forminscription" class="btn btn-warning btn-lg" style="height: 50px; width:95px; font-size:15px; font-weight:bold;" value="Ajouter" />		
						   </div>
                  </div>
                  
               </div>
      

               
         <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
      </div>
      </section>
      
      <footer class="bg-dark text-light text-left ">
		<?php require_once('Includes/footer.php') ?>
	</footer>

		<script src="assets/js/bootstrap.bundle.min.js"></script>
   
   </body>
</html>