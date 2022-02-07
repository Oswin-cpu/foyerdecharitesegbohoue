<?php
    session_start();
	
?>
<?php require 'Connexion.php'; $id=null; if(!empty($_GET['id'])){ $id=$_REQUEST['id']; } if(!empty($_POST)){ $id= $_POST['id']; $pdo=Database::connect(); $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $sql = "DELETE FROM programme  WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Database::disconnect();
        header("Location: programme.php");
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
		<br>
        <section>

        <form class="form-horizontal" action="Deleteprogramme.php" method="post">
                      <input type="hidden" name="id" value="<?php echo $id;?>"/>
                      
<h1 style="">Etes vous sûr de vouloir supprimer?</h1>

<br />
<br>
<br>
<div class="container-fluid">
<div class="form-actions">
                          <button type="submit" name="submit" class="btn btn-danger btn-lg" value="Yes">Oui</button>
                          <a class="btn btn-secondary btn-lg" href="Programme.php">Non</a>
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