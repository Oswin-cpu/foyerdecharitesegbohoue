<?php
    session_start();
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
if($_SERVER["REQUEST_METHOD"]== "POST")
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
               header("Location: galerie.php");
    Database::disconnect();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js"> </script>
    <script type="text/javascript" src="assets/js/zoombox/zoombox.js"> </script>
    <link rel="stylesheet" href="assets/css/stylesgal.css" />
    <link rel="stylesheet" href="assets/js/zoombox/zoombox.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <script type="text/javascript">
        jQuery(function($){
            $('a.zoombox').zoombox();
        });0
        </script>
    <title>Galerie</title>
    
</head>

<body class="order-form" style="background-color:#d6d6d6">

    <header>
		<?php require_once('Includes/header.php') ?>
	</header>
    <section >
			<br>
			<br>
			<br>
			<br>
            <div class="container-fluid ">
				<div class="row">
					<div class="nav navbar-dark  text-light" style="background-color:#112f41">
        				<div class="container-fluid">
            				<h2 class="text-center ">GALERIE</h2>
        				</div>
    				</div>
                    <div class="container-fluid">
                        <div class="row row-cols-1 mt-3">
                            <?php
                                $bdd = new PDO('mysql:host=localhost;dbname=foyer', 'root', '');
                                $reponse = $bdd->query('SELECT * FROM galerie');
                            ?>
                        <div class="container">
                        <div class="row row-cols-4 row-cols-md-4 g-2 ">
                            <?php
                                while($données = $reponse->fetch()){
                            ?>
                        <div class="col mb-5 trans">
                        <div class="card" style="width: 18rem">
                            <div class="min">
        
                                <a class="zoombox" href="<?php echo $données['chemin_img']; ?>">
                                    <img id="img" src="<?php echo $données['chemin_min']; ?>" alt="zagh"/>
                                    <style>
                                    .trans{
                                        transition: .5s;
                                        }
                                    .trans:hover{
                                        transform:scale(1.1)
                                        }
                                    </style>
                                </a>
        
            </div>
            
            <?php
                if (isset($_SESSION['connecte'])){
                    ?>
                <div class="card-footer bottom-right">
                <?php
                    echo '<a  href="Deleteimg.php?id='?><?php echo $données['id'] ?><?php echo '">'?><?php echo '<i class="btn btn-danger fa fa-trash-o"></i></a>';
                    echo '</div>';
                    }
            
            ?>
             
            <?php



?>
            </i></a>
           
            
        </div>
        </div>
    <?php 
   }
?>
</div>
   </div>
<?php

?>
</div>
</section>
<br>
<br>    
    <footer class="bg-dark text-light text-left ">
		<?php require_once('Includes/footer.php') ?>
	</footer>
		<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>*/