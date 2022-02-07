<section>
<nav class="cc-navbar navbar navbar-expand-lg navbar-dark position-fixed w-100">
			<div class="container-fluid">
				<a class="navbar-brand text-uppercase mx-4 py-3 fw-bolder" href="index.php"><p>Foyer Marie Reine de la Paix</p></a>
				<button
					class="navbar-toggler"
					type="button"
					data-bs-toggle="collapse"
					data-bs-target="#navbarSupportedContent"
					aria-controls="navbarSupportedContent"
					aria-expanded="false"
					aria-label="Toggle navigation"
				>
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
						<li class="nav-item pe-4">
							<a class="nav-link" href="index.php">Accueil</a>
						</li>
						<li class="nav-item pe-4">
							<a class="nav-link" href="galerie.php">Galerie</a>
						</li>
						<li class="nav-item pe-4">
							<a class="nav-link" href="Programme.php">Programme</a>
						</li>
						<?php
	if (isset($_SESSION['connecte'])) 
	{
		echo '
		<li class="nav-item pe-4">
		<a class="btn btn-order rounded-0" href="admin.php">Admin</a>
		</li> 
		<li class="nav-item pe-4">
		<a class="btn btn-order rounded-0" href="logout.php">Déconnexion</a>
		</li> ';
  			
	}?>
						
						
					</ul>
				</div>
			</div>
		</nav>
</section>
		