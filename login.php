<?php
session_start();
if (isset($_SESSION['connecte'])&&($_SESSION['connecte'] == 1)) // Si la variable existe, et qu'elle contient ce qu'il faut...
{
  header("Location:index.php");
}
else{
   $bdd = new PDO('mysql:host=127.0.0.1;dbname=foyer', 'root', '');
 
if(isset($_POST['formconnexion'])) {
   $mailconnect = htmlspecialchars($_POST['mailconnect']);
   $mdpconnect = sha1($_POST['mdpconnect']);
   if(!empty($mailconnect) AND !empty($mdpconnect)) {
      $requser = $bdd->prepare("SELECT * FROM membres WHERE mail = ? AND pass = ?");
      $requser->execute(array($mailconnect, $mdpconnect));
      $userexist = $requser->rowCount();
      if($userexist == 1) {
         $userinfo = $requser->fetch();
         $_SESSION['connecte']  = 1;
         $_SESSION['id'] = $userinfo['id'];
         $_SESSION['pseudo'] = $userinfo['pseudo'];
         $_SESSION['mail'] = $userinfo['mail'];
         header("Location: index.php");
      } else {
         $erreur = "Mauvais mail ou mot de passe !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
}
?>
<html>
   <head>
      <title>Connexion</title>
      <header>
			<?php require_once('Includes/header.php') ?>
		</header>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1" />

		<!-- Font awesome cdn CSS-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<!-- Bootstrap core CSS -->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/stylesprog.css" />
      
   </head>
   <body class="" style="background-color:#d6d6d6;">
   
     <section>
         <br>
			<br>
			<br>
			<br>
         <br>
         <div class="container-fluid" >
				<div class="row" style="display:flex; justify-content:center; align-items:center">
            <div class="col-12 col-sm-6 col-lg-6 border-end" style="display:flex; justify-content:center; align-items:center">
                  <img src="assets/img/loginimg3.svg" alt="zahg" class="img-fluid" style="width:500px">
               </div>
               <div class="col-12 col-sm-6 col-lg-6" >
               <div class="card bg-transparent" style="border:none;">
                  <div class="card-header" style="border:none;">
                  <div class="container-fluid">
                     <h2 class="text-center">Connexion</h2>
                  </div>
                  </div>
                  <div class="card-body">
                  <form action="" method="post" id="form_connect">
                     <div class="input-group mb-3">
                        <input type="email" name="mailconnect" placeholder="Mail" class="form-control" />
                     </div>
                     <div class="input-group mb-3">
                        <input type="password" name="mdpconnect" placeholder="Mot de passe" class="form-control" /><br>  
                     </div>
                     
                  
                  </div>
                  <div class="card-footer" style="border:none;"> 
                  <div class="input-group" style="display:flex; justify-content:center; align-items:center">
                           <input type="submit" name="formconnexion" class="btn btn-lg" value="Connexion" style="background-color:#112f41; color:antiquewhite">
                        </div>
                        </form>
                  </div>
               </div>
               
                  
               </div>
               
            </div>
         </div>
      </section>
   
         <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
      
     <section>
        
     </section>

		<script src="assets/js/bootstrap.bundle.min.js"></script>
   </body>
   
</html>
<footer class="bg-dark text-light text-left ">
			<?php require_once('Includes/footer.php') ?>
		</footer>