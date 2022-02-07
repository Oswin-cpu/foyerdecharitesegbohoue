<?php
    session_start();
	if (!isset($_SESSION['connecte'])) // Si la variable n'existe pas
{
  header("Location: index.php");
}
?>
<?php
  if(!empty($_FILES)){
        require("ClassImage.php");
        
       $img=$_FILES['img'];
       $ext=strtolower(substr($img['name'], -3));
       $allow_ext=array("jpg", "png", "gif");
        
       if (in_array($ext,$allow_ext)) {
           # code...
           move_uploaded_file($img['tmp_name'],"Images/".$img['name']);
           Img::creerMin("Images/".$img['name'],"Images/min",$img['name'], 286,180);
           
        }
        else
        {
           $erreur="Votre fichier n'est pas une image";
       }
      
        
    }  
?>
<?php require 'Connexion.php';
if($_SERVER["REQUEST_METHOD"]== "POST" && $_POST['envoyer']=='Envoyer')
{
    $nom=htmlentities(trim($_POST['nom']));
    $chemin_img="Images/".$img['name'];
    $chemin_min="Images/min/".$img['name'];
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'INSERT INTO galerie (nom,chemin_img,chemin_min) values(?,?,?)';
               $q = $pdo->prepare($sql);
               $q->execute(array($nom, $chemin_img, $chemin_min));
               Database::disconnect();
			   
               header("Location: admin.php");
    Database::disconnect();
}
?>
<?php if($_SERVER["REQUEST_METHOD"]== "POST" && $_POST['submit']=='Ajouter'){  $NomError = ''; $DateprogError=''; $DescriptionprogError=''; $PredicateurError ='';  $Nom = htmlentities(trim($_POST['Nom'])); $Dateprog=htmlentities(trim($_POST['Dateprog'])); $Descriptionprog = htmlentities(trim($_POST['Descriptionprog']));
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
            header("Location: admin.php");
        }
	}

    	
	?>
	<?php

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
		<link rel="stylesheet" href="assets/css/styles.css" />

		<title>Le Foyer de Charité</title>
		
	</head>
	<body style="background-color:#d6d6d6">
		<header>
		<?php require_once('Includes/header.php') ?>
		</header>
		<br>
		<br>
		<br>
		<br>
    	<div class="container-fluid">
			<div class="row">
				<div class="col-12 col-sm-6 col-lg-6 ">
					<div class="nav navbar-dark text-light" style="background-color:#112f41">
       					<div class="container-fluid">
            				<h2 class="text-center">AJOUTER DES IMAGES</h2>
        				</div>
    				</div>
					
        			<form action="admin.php" method="post" enctype="multipart/form-data" >
            			<div class="row mt-3">
							<div class="col-md-12 col-sm">
								<div class="input-group mb-3">
                        			<input type="file" name="img" class="form-control">
                    			</div>
							</div>
            			</div>
            			<div class="row">
							<div class="col-md-6 col-sm">
								<div class="input-group mb-3" style="display:flex; justify-content:right; align-items:center;">
                    				<input type="submit" name="envoyer" class="btn btn-warning" style="display:flex; align-items:center; justify-content:center; height: 50px; width:95px; font-size:15px;  font-weight:bold;">
                    			</div>
							</div>
							<div class="col-md-6 col-sm">
								<div class="input-group mb-3" style="display:flex; justify-content:left; align-items:center">
									<a href="galerie.php"  class="btn btn-secondary btn-lg" style="display:flex; align-items:center; justify-content:center; height: 50px; width:95px; font-size:15px;  font-weight:bold;">Voir</a>
								</div>
							</div>
						</div>    
						
					</form>
					<table class="table table-striped table-sm">
						<thead>
							
							<th colspan="">Image</th>
						</thead>
						<tbody>
						<?php
							$bdd = new PDO('mysql:host=localhost;dbname=foyer', 'root', '');
								$reponse = $bdd->query('SELECT * FROM galerie');
								while($données = $reponse->fetch()){
    					?>
							<tr>
								
								<td><img class="img-fluid" src="<?php echo $données['chemin_min'];?>" alt="" style="width:50px; height:50px"></td>
							</tr>
							<?php }?>
						</tbody>
					</table>
				</div>
				<div class="col-12 col-sm-6 col-lg-6">
					<div class="nav navbar-dark  text-light" style="background-color:#112f41">
        				<div class="container-fluid">
            				<h2 class="text-center ">PROGRAMME</h2>
        				</div>
    				</div>
					<form method="POST" action="admin.php">
					<div class="row mt-3">
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
					
					<div class="row">
					<div class="input-group mb-3">
								<input type="text" id="Predicateur" name="Predicateur" class="form-control" placeholder="Prédicateur du Programme..." />
							</div>
					</div>
					
					<div class="row">
						<div class="input-group mb-3">
							<textarea class="form-control" id="Descriptionprog" name="Descriptionprog" aria-label="With textarea" placeholder="Description"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-sm">
							<div class="input-group mb-3" style="display:flex; justify-content:right; align-items:center">
								<a href="Programme.php"  class="btn btn-secondary btn-lg" style="display:flex; align-items:center; justify-content:center; height: 50px; width:95px; font-size:15px;  font-weight:bold;">Voir</a>
							</div>
						</div>

						<div class="col-md-6 col-sm">
							<div class="input-group mb-3" style="display:flex; justify-content:left; align-items:center">
								<input type="submit" class="btn btn-warning btn-lg" name="submit" value="Ajouter" style="font-weight:bold; height: 50px; width:95px; font-size:15px">
							</div>
						</div>
							
						<table class="table table-striped table-sm">
						<thead>
							<th class="text text-right">Nom Programme</th>
							<th colspan="">Predicateur</th>
							<th colspan="">Date</th>
						</thead>
						<tbody>
						<?php
							$bdd = new PDO('mysql:host=localhost;dbname=foyer', 'root', '');
								$reponse = $bdd->query('SELECT * FROM programme');
								while($données = $reponse->fetch()){
    					?>
							<tr>
								<td><?php echo $données['Nom'];?></td>
								<td><?php echo $données['Predicateur'];?></td>
								<td><?php echo $données['Dateprog'];?></td>
							</tr>
							<?php }?>
						</tbody>
					</table>
						
					</div>
				</form>
				</div>
			</div>
			<div class="col-12 col-sm-12 col-lg-12"  style="">
					<div class="nav navbar-dark  text-light" style="background-color:#112f41">
        				<div class="container-fluid">
            				<h2 class="text-center ">ADMIN</h2>
        				</div>
    				</div>
					<div class="mt-3 mb-3">
					<a href="Ajoutadmin.php" class="btn btn-warning btn-lg">Ajouter un membre</a>
					</div>
					
			   <table class="table table-striped table-sm">
						<thead>
							<th class="text text-right">Pseudo</th>
							<th colspan="">Mail</th>
							
						</thead>
						<tbody>
						<?php
							$bdd = new PDO('mysql:host=localhost;dbname=foyer', 'root', '');
								$reponse = $bdd->query('SELECT * FROM membres');
								while($données = $reponse->fetch()){
    					?>
							<tr>
								<td><?php echo $données['pseudo'];?></td>
								<td><?php echo $données['mail'];?></td>
								<td><a  href="MajAdmin.php?id=<?php echo $données['id'] ?>"><i class="btn btn-warning far fa-edit"></i></a>
									<a  href="DeleteAdmin.php?id=<?php echo $données['id'] ?>"><i class="btn btn-danger fa fa-trash-o"></i></a></td>
							</tr>
							<?php }?>
						</tbody>
					</table>
						
					</div>
               
         <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
		 </form>
      </div>
		<footer class="bg-dark text-light text-left" >
		<?php require_once('Includes/footer.php') ?>
		</footer>

		<script src="assets/js/bootstrap.bundle.min.js"></script>
	</body>
</html>