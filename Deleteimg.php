<?php
    session_start();
	if (!isset($_SESSION['connecte'])) // Si la variable existe, et qu'elle contient ce qu'il faut...
{
  header("Location: login.php");
}
?>
<?php
$bdd = new PDO('mysql:host=localhost;dbname=foyer', 'root', '');
$reponse = $bdd->query('SELECT * FROM galerie');
while($données = $reponse->fetch()){
    $chemin_img=$données['chemin_img'];
    $chemin_min=$données['chemin_min'];

}
    ?>
<?php require 'Connexion.php'; $id=null; if(!empty($_GET['id'])){ $id=$_REQUEST['id']; } if(!empty($_POST)){ $id= $_POST['id']; $pdo=Database::connect(); $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM galerie  WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
		unlink($chemin_img);
		unlink($chemin_min);
        Database::disconnect();
        header("Location: galerie.php");
           
        
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

		<title>Galerie</title>
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
		<br>
        <section>

        <form class="form-horizontal" action="Deleteimg.php" method="post">
                      <input type="hidden" name="id" value="<?php echo $id;?>"/>
					  <h1 style="">Etes vous sûr de vouloir supprimer cette image?</h1>


<br>
<br>

<div class="container-fluid">
<br />
<div class="form-actions">
                          <button type="submit" name="submit" class="btn btn-danger btn-lg" value="Yes">Oui</button>
                          <a class="btn btn-secondary btn-lg" href="galerie.php">Non</a>
</div>
</div>
<p>

                    </form>
        </section>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<footer class="bg-dark text-light text-left ">
		<?php require_once('Includes/footer.php') ?>
	</footer>

		<script src="assets/js/bootstrap.bundle.min.js"></script>
		</body>
        
		</html>