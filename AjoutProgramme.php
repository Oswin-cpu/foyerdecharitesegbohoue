<?php
    session_start();
	if (!isset($_SESSION['connecte'])) // Si la variable existe, et qu'elle contient ce qu'il faut...
{
  header("Location: login.php");
}
?>
<?php
/*

*/
	?>
	<?php require 'Connexion.php'; if($_SERVER["REQUEST_METHOD"]== "POST" && !empty($_POST)){  $NomError = ''; $DateprogError=''; $DescriptionprogError=''; $PredicateurError ='';  $Nom = htmlentities(trim($_POST['Nom'])); $Dateprog=htmlentities(trim($_POST['Dateprog'])); $Descriptionprog = htmlentities(trim($_POST['Descriptionprog']));
	$Predicateur=htmlentities(trim($_POST['Predicateur']));  $valid = true;
	if (empty($Nom)) { $NomError = 'Entrez un nom pour le programme'; $valid = false; }else if 
	(!preg_match("/^[a-zA-Z ]*$/",$Nom)) { $NomError = "Seulement des lettres et des espaces sont autorisés"; }
	if (empty($Predicateur)) { $PredicateurError = 'Entrez un Predicateur'; $valid = false; } else if 
	(!preg_match("/^[a-zA-Z ]*$/",$Nom)) { $NomError = "Seulement des lettres et des espaces sont autorisés"; }
	if ($valid) { $pdo = Database::connect(); $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO Programme (Nom,Dateprog,Descriptionprog,Predicateur) values(?, ?, ?, ? )";
            $q = $pdo->prepare($sql);
            $q->execute(array($Nom, $Dateprog, $Descriptionprog, $Predicateur));
            Database::disconnect();
            header("Location: Programme.php");
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
		<link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="../assets/css/stylesprog.css" />

		<title>Programme</title>
		<header>
			<?php require_once('../Includes/headeradmin.php') ?>
		</header>
	</head>
	<body class="order-form">

    
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<section >
			<div class="container">
				<h2 class="merriweather text-center text-light mb-4">Ajouter un Programme</h2>
				<form method="post" action="AjoutProgramme.php">
					<div class="row">
						<div class="col-md-6 col-sm">
							<div class="input-group mb-3">
								<input type="text" id="Nom" name="Nom" class="form-control" placeholder="Nom du programme..." />
							</div>
						</div>
						<div class="col-md-6 col-sm">
							<div class="input-group mb-3">
								<input type="date" id="Dateprog" name="Dateprog" class="form-control" placeholder="Date du Programme(YYYY-MM-DD)..." />
								
							</div>
						</div>
					</div>
					<center>
					<div class="row">
					<div class="input-group mb-3">
								<input type="text" id="Predicateur" name="Predicateur" class="form-control" placeholder="Prédicateur du Programme..." />
							</div>
					</div>
					</center>
					<div class="row">
						<div class="input-group mb-3">
							<textarea class="form-control" id="Descriptionprog" name="Descriptionprog" aria-label="With textarea" placeholder="Description"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-sm">
							<div class="input-group mb-3" style="display:flex; justify-content:right; align-items:center">
								<a href="Programme.php"  class="btn btn-secondary btn-lg" style="display:flex; align-items:center; justify-content:center; height: 50px; width:95px; font-size:15px;  font-weight:bold;">Retour</a>
							</div>
						</div>

						<div class="col-md-6 col-sm">
							<div class="input-group mb-3" style="display:flex; justify-content:left; align-items:center">
								<input type="submit" class="btn btn-warning btn-lg" name="submit" value="Ajouter" style="font-weight:bold; height: 50px; width:95px; font-size:15px">
							</div>
						</div>
							
							
						
					</div>
				</form>
			</div>
		</section>
				
		
		<footer class="bg-dark text-light text-left ">
		<?php require_once('../Includes/footeradmin.php') ?>
	</footer>

		<script src="assets/js/bootstrap.bundle.min.js"></script>
   </body>
</html>