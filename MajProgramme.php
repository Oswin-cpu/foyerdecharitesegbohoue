<?php
    session_start();
	if (!isset($_SESSION['connecte'])) // Si la variable existe, et qu'elle contient ce qu'il faut...
{
  header("Location: login.php");
}
?>
<?php require 'Connexion.php'; $id = null; if ( !empty($_GET['id'])) { $id = $_REQUEST['id']; } if ( null==$id ) { header("Location: proggramme.php"); } if($_SERVER["REQUEST_METHOD"]== "POST" && !empty($_POST)){  $NomError = ''; $DateprogError=''; $DescriptionprogError=''; $PredicateurError ='';  $Nom = htmlentities(trim($_POST['Nom'])); $Dateprog=htmlentities(trim($_POST['Dateprog'])); $Descriptionprog = htmlentities(trim($_POST['Descriptionprog']));
	$Predicateur=htmlentities(trim($_POST['Predicateur']));  $valid = true;
	if (empty($Nom)) { $NomError = 'Entrez un nom pour le programme'; $valid = false; }else if 
	(!preg_match("/^[a-zA-Z ]*$/",$Nom)) { $NomError = "Seulement des lettres et des espaces sont autorisés"; }
	if (empty($Predicateur)) { $PredicateurError = 'Entrez un Predicateur'; $valid = false; } else if 
	(!preg_match("/^[a-zA-Z ]*$/",$Nom)) { $NomError = "Seulement des lettres et des espaces sont autorisés"; }  
    if ($valid) { $pdo = Database::connect(); $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);           
             $sql = "UPDATE programme SET Nom = ?,Dateprog = ?,Descriptionprog = ?,Predicateur = ? where id = ?";
             $q = $pdo->prepare($sql);
             $q->execute(array($Nom,$Dateprog, $Descriptionprog, $Predicateur, $id));
             Database::disconnect();
             header("Location: programme.php");
          
        }else{

            $pdo = Database::connect();
             $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $sql = "SELECT * FROM programme where id = ?";
             $q = $pdo->prepare($sql);
             $q->execute(array($id));
             $data = $q->fetch(PDO::FETCH_ASSOC);
             $Nom = $data['Nom'];
             $Dateprog = $data['Dateprog'];
             $Descriptionprog = $data['Descriptionprog'];
             $Predicateur = $data['Predicateur'];
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

		<title>Programme</title>
	</head>
	<body class="order-form" style="background-color:#d6d6d6">

    <header>
			<?php require_once('Includes/header.php') ?>
		</header>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		
        <section >
		<?php
    $id=$_GET['id'];
    $bdd = new PDO('mysql:host=localhost;dbname=foyer', 'root', '');
    $sql = "SELECT * FROM programme where id = ?";
	$req = $bdd->prepare($sql);
	$req->execute(array($id));
	$données = $req->fetch();
	$Nom = $données['Nom'];
    $Dateprog = $données['Dateprog'];
	$Predicateur = $données['Predicateur'];
	$Descriptionprog = $données['Descriptionprog'];
    ?>
			<div class="container-fluid">
				<h2 class="text-center mb-5">Modifier un Programme</h2>
				<form method="post" action="MajProgramme.php?id=<?php echo $id ;?>">
					<div class="row">
						<div class="col-md-6 col-sm">
							<div class="input-group mb-3">
								<input type="text" id="Nom" name="Nom" class="form-control" placeholder="Nom du programme..." value="<?php echo $Nom; ?>" />
							</div>
						</div>
						<div class="col-md-6 col-sm">
							<div class="input-group mb-3">
								<input type="date" id="Dateprog" name="Dateprog" class="form-control" placeholder="Date du Programme(YYYY-MM-DD)..." value="<?php echo $Dateprog; ?>"  />
								
							</div>
						</div>
					</div>
					<center>
					<div class="row">
					<div class="input-group mb-3">
								<input type="text" id="Predicateur" name="Predicateur" class="form-control" placeholder="Prédicateur du Programme..." value="<?php echo $Predicateur; ?>" />
							</div>
					</div>
					</center>
					<div class="row">
						<div class="input-group">
							<textarea class="form-control" id="Descriptionprog" name="Descriptionprog" aria-label="With textarea" placeholder="Description"><?php echo $Descriptionprog; ?></textarea>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-6 col-sm">
							<div class="input-group" style="display:flex; justify-content:right;">
								<button class="btn btn-secondary btn-lg" style="display:flex; justify-content:center;align-items:center;font-weight:bold;height: 50px; width:95px;font-size:15px"><a href="Programme.php" class="text-light" style="text-decoration:none">Retour</a></button>
							</div>
						</div>

						<div class="col-md-6 col-sm">
							<div class="input-group mb-3" style="display:flex; justify-content:left;">
								<input type="submit" name="submit" value="Modifier" class="btn btn-warning btn-lg" style="font-weight:bold;height: 50px; width:95px;font-size:15px">
							</div>
						</div>
							
						
					</div>
				</form>
	</div>
				<section>
			<div class="container-fluid">
			
			
		<br>
		<br>	
		</div>
		</section>	
		<footer class="bg-dark text-light text-left ">
		<?php require_once('Includes/footer.php') ?>
	</footer>

		<script src="assets/js/bootstrap.bundle.min.js"></script>
		</body>
        
		</html>