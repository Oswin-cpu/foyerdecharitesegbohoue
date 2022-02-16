<?php
    session_start();

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

	<body class="order-form" style="background-color:#d6d6d6">
	<header>
			<?php require_once('Includes/header.php') ?>
		</header>


		<section >
			<br>
			<br>
			<br>
			<br>
			<div class="container-fluid " style="background-color:#d6d6d6">
				<div class="row" style="background-color:#d6d6d6">
					<div class="nav navbar-dark  text-light" style="background-color:#112f41">
        				<div class="container-fluid">
            				<h2 class="text-center ">PROGRAMME</h2>
        				</div>
    				</div>


					<?php

    					$bdd = new PDO('mysql:host=localhost;dbname=foyer', 'root', '');
        				$reponse = $bdd->query('SELECT * FROM programme');
    				?>
                	<div class="row row-cols-1 row-cols-md-2 g-3">
                        <?php
                        	while($données = $reponse->fetch()){
                        ?>
						<div class="col mb-5">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title text-center"><?php echo $données['Nom']; ?></h5>
								</div>
								<div class="card-body">
                                	<p class="card-text"><?php echo $données['Descriptionprog'];?></p>
                                	<p class="card-text">  Superviseur : <?php echo $données['Predicateur'];?></p>
									<p class="card-text" style="font-size:13px"><?php echo $données['Dateprog'];?></p>
								</div>
								<div class="card-footer bottom-right">
								<a  href="EditProgramme.php?id=<?php echo $données['id'] ?>"><i class="btn btn-secondary far fa-eye"></i></a>
								<?php
									if (isset($_SESSION['connecte'])){
											echo'

											<a  href="MajProgramme.php?id='?><?php echo $données['id'] ?><?php echo '"><i class="btn btn-warning far fa-edit"></i></a>
											<a  href="DeleteProgramme.php?id='?><?php echo $données['id'] ?><?php echo '"><i class="btn btn-danger fa fa-trash-o"></i></a>
											';

									}?>
									</div>
							</div>
						</div>
						<?php
						}
                        ?>
		</section>

		<footer class="bg-dark text-light text-left ">
			<?php require_once('Includes/footer.php') ?>
		</footer>

		<script src="assets/js/bootstrap.bundle.min.js"></script>
	</body>

</html>
