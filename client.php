<?php
	session_start();
	if (!isset($_SESSION['admin_id'])&& !isset($_SESSION['agent_id']) && !isset($_SESSION['client_id'])) {
		header("Location:login.php");
	}
	require_once("connexion.php");

	// Suppression d'un client
	if (isset($_GET['supprimer'])) {		
		$request1="delete from clients where num_client='".$_GET['supprimer']."' ";
		$result1=mysqli_query($connection,$request1);
		if($result1) {	
			$msg3 ="Client supprimé avec succès";
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
			$datenaiss= $_POST['datenaiss'];
			$email= $_POST['email'];
			$tele= $_POST['tele'];
			$adr= $_POST['adr'];
			$pseudo= $_POST['pseudo'];
			$password=password_hash($_POST['password'],PASSWORD_BCRYPT);
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
			if ($datenaiss!="" && (int)$datenaiss<=(int)date('Y')-18) {
				$URL=$URL."&datenaiss=$datenaiss";
				$nv++;
			}
			if ($email!="") {
				$URL=$URL."&email=$email";
				$nv++;
			}
			if ($tele!="") {
				if(strlen($tele)==10 && (strcmp(substr($tele,0,2),"05")==0 || strcmp(substr($tele,0,2),"06")==0 || strcmp(substr($tele,0,2),"07")==0))
				{
					$URL=$URL."&tele=$tele";
					$nv++;
				}
				else if (strlen($tele)==13 && (strcmp(substr($tele,0,4),"+212")==0))
				{
					$tele=substr($tele,1,12);
					$URL=$URL."&tele=%2B$tele";
					$nv++;
				}
			}
			if ($adr!="") {
				$URL=$URL."&adr=$adr";
				$nv++;
			}
			// Si tous les champs sont valides :
			if ($nv==6) {
				$request="INSERT INTO CLIENTS SET nom='".$nom."',prenom='".$prenom."',datenaiss='".$datenaiss."',email='".$email."',telephone='".$tele."',adresse='".$adr."',pseudo='".$pseudo."',password='".$password."',type='C' "; 
				$result=mysqli_query($connection,$request);

				if($result) {	
					$msg1="Client ajouté avec succès";
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

	 		$request2="UPDATE  clients SET nom='".$_POST['nom']."',prenom='".$_POST['prenom']."',datenaiss='".$_POST['datenaiss']."',email='".$_POST['email']."',telephone='".$_POST['tele']."',adresse='".$_POST['adr']."',pseudo='".$_POST['pseudo']."',password='".$password."' where num_client='".$_SESSION['id']."'  ";
			$result2=mysqli_query($connection,$request2);
			if($result2) {	
				$msg2="client modifié avec succès";
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
		$request3="SELECT * from clients where nom like '%".$_GET['chercher']."%'  ";
		$result3=mysqli_query($connection,$request3);
		if(!$result3){
			echo mysqli_error($connection);
			mysqli_close($connection);
			exit();
		}
	 
	}
	else {
		$request3="SELECT * from clients ";
		$result3=mysqli_query($connection,$request3);
		if(!$result3){
			echo mysqli_error($connection);
			mysqli_close($connection);
			exit();
		}
	}

?>
<?php  $page_title= 'Clients'; ?>
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
                	<h3>Liste des clients :</h3>
                </div>
                <div class="row">
                	<?php if(isset($_SESSION['admin_id'])) {?>	
                    <div class="col-sm-8">
                    	<a href="ajouterClient.php" ><button name="ajouter_client" class="btn btn-success" >Ajouter Client </button></a>
                    </div>
                    <?php }?>
                    <form class="form-inline my-2 my-lg-0 " name="recherche" method="GET" action="" >
	                    <div class="form-group">
							<input class="form-control mr-sm-2" type="text" placeholder="Nom" name="chercher" value="<?php if (isset($_GET['chercher'])) { echo $_GET['chercher']; } ?>"/>
							<input class="btn btn-secondary my-2 my-sm-0" type="submit" name="valider" value="Rechercher"/>
						</div>
					</form>
				</div>
					<table class="table table-hover margin text-center">
						<tr class="table-dark bld">
							<td>Pseudo </td>
							<td>Nom </td>
							<td>Prénom </td>
							<td>Email </td>
							<td>Date naissance </td>
							<td>Date d'adhésion </td>
							<td>Téléphone </td>
							<td>Adresse </td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
				<?php 
					while ($clients=mysqli_fetch_assoc($result3)) 
					{
				?>
						<tr class="table-secondary">
							<td>   <?= $clients['pseudo'] ?>   </td>
							<td>   <?= $clients['nom']    ?> </td>
							<td>   <?= $clients['prenom']    ?> </td>
							<td>   <?= $clients['email']    ?> </td>
							<td>   <?= $clients['datenaiss']    ?> </td>
							<td>   <?= $clients['date_inscrip']    ?> </td>
							<td>   <?= $clients['telephone']   ?> </td>
							<td>   <?= $clients['adresse']   ?> </td>

							<td>   <a class="btn btn-secondary" href="consomSaisie.php?id=<?= $clients['num_client']."&nom=".$clients['nom']?>" >
								Ajouter Conso. </a> </td>
								<td>   <a class="btn btn-primary" href="detailsClient.php?detailler=<?= $clients['num_client']?>"> Détails</a> </td>

							<?php if(isset($_SESSION['admin_id'])) {?>	
							<td>   <a class="btn btn-warning" href="ajouterClient.php?modifier=<?= $clients['num_client']?>" > Modifier</a> </td>
							
							<td>   <a class="btn btn-danger" href="client.php?supprimer=<?= $clients['num_client']?>" onclick="return confirm('Voulez-vous supprimer ?')">Supprimer</a> </td>
							<?php }?>
						</tr>
				<?php
					}
				?>
					</table>
				</div>
			</div>
<?php require 'footer.php'; ?>
