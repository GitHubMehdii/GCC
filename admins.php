<?php
	
	session_start();
	
	require_once("connexion.php");

	// Suppression d'un client
	if (isset($_GET['supprimer'])) {		
		$request1="delete from admins where id='".$_GET['supprimer']."' ";
		$result1=mysqli_query($connection,$request1);
		if($result1) {	
			$msg3 ="admin supprimé avec succès";
		}
		else {
	 		echo mysqli_error($connection);
	 		mysqli_close($connection);
			exit();
		}
	}

	// Insertion des données
	if (!isset($_SESSION['id'])) {
		if (isset($_POST['valider'])) {
			$nom= $_POST['nom'];
			$prenom= $_POST['prenom'];
			$email= $_POST['email'];
			$pseudo= $_POST['pseudo'];
			$password= password_hash($_POST['password'],PASSWORD_BCRYPT);
			$passwordConfirm= $_POST['passwordConfirm'];
			$nv=0;
			// URL si un des champs n'est pas valide
			$URL="Location: ajouterClient.php?valide=-1";
			// Validations
			if ($nom!="") {
				$URL=$URL."&nom=$nom";
				$nv++;
			}
			if ($prenom!="") {
				$URL=$URL."&prenom=$prenom";
				$nv++;
			}
			
			if ($email!="") {
				$URL=$URL."&email=$email";
				$nv++;
			}
			if ($password!="") {
				$URL=$URL."&password=$password";
				$nv++;
			}
			if ($passwordConfirm!="") {
				$URL=$URL."&passwordConfirm=$passwordConfirm";
				$nv++;
			}
			
			
			// Si tous les champs sont valides :
			if ($nv==5) {
				$request="INSERT INTO admins SET nom='".$nom."',prenom='".$prenom."',email='".$email."',password='".$password."',pseudo='".$pseudo."' ";
				$result=mysqli_query($connection,$request);

				if($result) {	
					$msg1="admin ajouté avec succès";
				}
				else {
					echo mysqli_error($connection);
					mysqli_close($connection);
					exit();
				}
			}
			// Si un champs n'est pas valide
			else header($URL);
		}
	}
	else {
	 	if (isset($_POST['valider'])) {
	 		$password=password_hash($_POST['password'],PASSWORD_BCRYPT);
	 		$request2="UPDATE  admins SET nom='".$_POST['nom']."',prenom='".$_POST['prenom']."',email='".$_POST['email']."',password='".$password."' where id='".$_SESSION['id']."'  ";
			$result2=mysqli_query($connection,$request2);
			if($result2) {	
				$msg2="admin modifié avec succès";
				unset($_SESSION['id']);				
			}
			else {
				echo mysqli_error($connection);
		  		mysqli_close($connection);
		  		exit();
   			}
	 	}
	}
	// Moteur de recherche
	if (isset($_GET['chercher']))
	{
		$request3="SELECT * from admins where nom like '%".$_GET['chercher']."%'  ";
		$result3=mysqli_query($connection,$request3);
		if(!$result3){
			echo mysqli_error($connection);
			mysqli_close($connection);
			exit();
		}
	 
	}
	else {
		$request3="SELECT * from admins ";
		$result3=mysqli_query($connection,$request3);
		if(!$result3){
			echo mysqli_error($connection);
			mysqli_close($connection);
			exit();
		}
	}

?>
<?php  $page_title= 'Admins'; ?>
<?php  require('header.php'); ?>
<!-- l'affichage des msg --> 
<div class="col-sm-12" > 		
	<?php if(!empty($msg3)&&isset($_GET['supprimer'])) : ?>
	<div class="alert alert-danger"> 
		<?= $msg3 ?>
	</div>
	<?php endif ?>
	<?php if(!empty($msg2)&&isset($_GET['modifier'])):?>
		<div class="alert alert-info"> 
		<?= $msg2 ?>
		</div>
	<?php endif ?>
	<?php if (!empty($msg1)): ?>
		<div class="alert alert-success">
		<?= $msg1 ?>
	</div>
	<?php endif ?>
	
</div>
	<br>
		<div class="container margin">
            <div class="col-sm-12">
            	<div>
                	<h3>Liste des Admins :</h3>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                    	<a href="ajouterAdmin.php" ><button name="ajouter_Admin" class="btn btn-success" >Ajouter Admin </button></a>
                    </div>
                    <form class="form-inline my-2 my-lg-0 " name="recherche" method="GET" action="" >
	                    <div class="form-group">
							<input class="form-control mr-sm-2" type="text" placeholder="Nom" name="chercher" value="<?php if (isset($_GET['chercher'])) { echo $_GET['chercher']; } ?>"/>
							<input class="btn btn-secondary my-2 my-sm-0" type="submit" name="valider" value="Rechercher"/>
						</div>
					</form>
				</div>
				
					<table class="table table-hover  margin text-center">
						<tr class="table-dark bld">
							<td>id </td>
							<td>Nom </td>
							<td>Prénom </td>
							<td>Email </td>
							<td>Pseudo </td>
							<td>password </td>
							
						</tr>
				<?php 
					while ($admins=mysqli_fetch_assoc($result3)) 
					{
				?>
						<tr class="table-secondary">
							<td>   <?= $admins['id'] ?>   </td>
							<td>   <?= $admins['nom']    ?> </td>
							<td>   <?= $admins['prenom']    ?> </td>
							<td>   <?= $admins['email']    ?> </td>
							<td>   <?= $admins['pseudo']    ?> </td>
							<td>   <?= $admins['password']    ?> </td>
							
							
							<td>   <a class="btn btn-warning" href="ajouterAdmin.php?modifier=<?= $admins['id']  ?> " > Modifier</a> </td>
							<!-- <td>   <a class="btn btn-primary" href="detailsClient.php?detailler=<?= $admins['id']?>"> Détails</a> </td>-->
							<td>   <a class="btn btn-danger" href="admins.php?supprimer=<?= $admins['id']?>" onclick="return confirm('Voulez-vous supprimer ?')">Supprimer</a> </td>
						</tr>
				<?php
					}
				?>
					</table>
					

				</div>
			</div>
<?php require 'footer.php'; ?>
