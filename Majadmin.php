<?php
    session_start();
	if (!isset($_SESSION['connecte'])) // Si la variable existe, et qu'elle contient ce qu'il faut...
{
  header("Location: index.php");
}
?>
<?php require 'Connexion.php'; $id = null; if ( !empty($_GET['id'])) { $id = $_REQUEST['id']; } if ( null==$id ) { header("Location: index.php"); } if($_SERVER["REQUEST_METHOD"]== "POST" && !empty($_POST)){  $pseudoError = ''; $mailError=''; $passError='';  $pseudo = htmlentities(trim($_POST['pseudo'])); $mail=htmlentities(trim($_POST['mail'])); $pass = htmlentities(trim(sha1($_POST['mdp'])));
	$valid = true;
	if (empty($pseudo)) { $pseudoError = 'Entrez un pseudo'; $valid = false; }else if 
	(!preg_match("/^[a-zA-Z ]*$/",$pseudo)) { $pseudoError = "Seulement des lettres et des espaces sont autorisés"; }  
    if ($valid) { $pdo = Database::connect(); $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);           
             $sql = "UPDATE membres SET pseudo = ?,mail = ?,pass = ? where id = ?";
             $q = $pdo->prepare($sql);
             $q->execute(array($pseudo,$mail, $pass, $id));
             Database::disconnect();
             header("Location: admin.php");
          
        }else{

            $pdo = Database::connect();
             $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $sql = "SELECT * FROM membres where id = ?";
             $q = $pdo->prepare($sql);
             $q->execute(array($id));
             $data = $q->fetch(PDO::FETCH_ASSOC);
             $pseudo = $data['pseudo'];
             $mail = $data['mail'];
             $pass = $data['pass'];
             Database::disconnect();
         }
        }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<!-- Font awesome cdn CSS-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<!-- Bootstrap core CSS -->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/stylesprog.css" />

		<title>Administrateurs</title>
		
	</head>
	<body class="order-form">
	<header>
		<?php require_once('Includes/header.php') ?>
		</header>
    <?php
    $id=$_GET['id'];
    $bdd = new PDO('mysql:host=localhost;dbname=foyer', 'root', '');
    $sql = "SELECT * FROM membres where id = ?";
	$req = $bdd->prepare($sql);
	$req->execute(array($id));
	$données = $req->fetch();
	$pseudo = $données['pseudo'];
    $mail = $données['mail'];
    ?>
		
        <section>
			<br>
			<br>
			<br>
			<br>
			<br>
		<div class="container">
				<h2 class="merriweather text-center text-light mb-4">Modifier un administratreur</h2>
				<form method="POST" action="Majadmin.php?id=<?php echo $id ;?>">
               
					<center>
                    <div class="row">
						<div class="col-md-6 col-sm">
							<div class="input-group mb-3">
                        <input type="text" placeholder="Votre pseudo" class="form-control" id="pseudo" name="pseudo" value="<?php echo $pseudo; ?>" />
							</div>
						</div>

               
						<div class="col-md-6 col-sm">
							<div class="input-group mb-3">
								<input type="email" placeholder="Votre mail" class="form-control" id="mail" name="mail" value="<?php echo $mail;  ?>" />
							</div>	
						</div>
               </div>

               <div class="row">
                  <div class="col-md-6 col-sm">
							<div class="input-group mb-3">
                     <input type="email" placeholder="Confirmez votre mail" class="form-control" id="mail2" name="mail2" value="<?php echo $mail; ?>" />
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
							<div class="input-group mb-3">
                     <input type="password" placeholder="Confirmez votre mdp" class="form-control" id="mdp2" name="mdp2" />
							</div>	
						</div>
					</div>

               <div class="row">
                  
					   
					   <div class="col-md-6 col-sm">
					   <div class="input-group mb-3" style="display:flex; justify-content:right; align-items:center">
							<a href="admin.php"  class="btn btn-secondary btn-lg" style="display:flex; justify-content:center;align-items:center;font-weight:bold;height: 50px; width:95px;font-size:15px">Retour</a>
							</div>
					   </div>
					   <div class="col-md-6 col-sm">
							<div class="input-group mb-3" style="display:flex; justify-content:left; align-items:center">
                     <input type="submit" name="forminscription" class="btn btn-warning btn-lg" style="font-weight:bold;height: 50px; width:95px;font-size:15px" value="Modifier" />		
						   </div>
					   </div>
               </div>
      

               </center>
         </form> 
		 </div>
		 <footer class="bg-dark text-light text-left ">
		<?php require_once('Includes/footer.php') ?>
	</footer>

		<script src="assets/js/bootstrap.bundle.min.js"></script>
   
   </body>
</html>