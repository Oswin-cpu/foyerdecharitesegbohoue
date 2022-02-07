<?php
    session_start();
	
?>
<?php require('Connexion.php');  $id = null; if (!empty($_GET['id'])) { $id = $_REQUEST['id']; }
 if (null == $id) { header("location:Programme.php"); } else 
 { $pdo = Database ::connect(); $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) .
    $sql = "SELECT * FROM programme where id =?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $données = $q->fetch(PDO::FETCH_ASSOC);
    Database::disconnect();
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
        <section>
		<div  class="container-fluid">
			<h2 class="text-center  mb-5">Programme</h2>
				<div class="row row-cols-1 row-cols-md-2 g-3" style="display:flex; justify-content:center;" >
                        <div class="col-mb-5" > 
							<div class="card">
								<div class="card-header">
									<h4 class="card-title text-center">
										<?php echo $données['Nom']; ?>
									</h4>
								</div>
								<div class="card-body">
									<p><?php echo $données['Descriptionprog'];?></p>
									<p><?php echo $données['Predicateur'];?></p>
									<p></p>
								</div>
								<div class="card-footer bottom-center" style="font-size:13px">
									<?php echo $données['Dateprog'];?>
								</div>
							</div>
						</div>
            	</div>
		</div>
                
        </section>
		<section>
			<div class="container-fluid">
			<br>
			<br>
			<div class="row">
				<div class="col-mb-5">
					<div class="input-group"  style="display:flex; justify-content:center;">
						<button class="btn btn-secondary btn-lg mb-3" style="display:flex; justify-content:center;align-items:center;font-weight:bold;height: 50px; width:95px;font-size:15px"><a href="Programme.php" class="text-light" style="text-decoration:none">Retour</a></button>

					</div>
				
				</div>
			</div>
						</div>
		</section>
		
		<footer class="bg-dark text-light text-left ">
		<?php require_once('Includes/footer.php') ?>
	</footer>

		<script src="assets/js/bootstrap.bundle.min.js"></script>
		</body>
        
		</html>