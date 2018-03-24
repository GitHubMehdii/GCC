<?php
	session_start();
	if (!isset($_SESSION['admin_id']) && !isset($_SESSION['agent_id']) && !isset($_SESSION['client_id'])) {
		header("Location:login.php");
	}

	//echo '<pre>';
	//print_r($_SESSION);
	//echo '</pre>';
	require_once('header.php');
	
?>
	<div class="container margintop">
		<div class="row">
			<div class="col-sm-12">
				<h3>Menu Principal</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<figure>
					<img src="img/document-icon.png" alt="Photo de document" height="150px" width="150px" class="document" />
					<h4 class="bl">Gestion de Factures</h4>
				</figure>
			</div>
		</div>
		<br>
		<?php if(!isset($_SESSION['client_id']) && !isset($_SESSION['agent_id'])) {?>
		<div class="row">
			<div class= "col-sm-4">
			</div>
			<div class="col-sm-4">
				<a href="ajouterClient.php"><button type="button" class="btn btn-success btnn" >Ajouter Client</button></a>
			</div>
			<div class="col-sm-4">
			</div>
		</div>
		<br>
		<?php }?>
		<?php if(!isset($_SESSION['client_id'])) {?>
		<div class="row">
			<div class= "col-sm-4">

			</div>
			<div class="col-sm-4">
				<a href="client.php"><button type="button" class="btn btn-primary btnn"> Clients</button></a>
			</div>
			<div class= "col-sm-4">

			</div>
		</div>
		<br>
		<?php }?>
		
		

		<?php if(isset($_SESSION['admin_id'])|| isset($_SESSION['agent_id'])){?> 
		<div class="row">
			<div class= "col-sm-4">

			</div>
			<div class="col-sm-4">
				<a href="factures.php"><button type="button" class="btn btn-warning btnn" >Factures</button></a>
			</div>
			<div class= "col-sm-4">

			</div>
		</div>
		<br>
		<?php }?>
		<?php if(isset($_SESSION['client_id'])) {?>
		<div class="row">
			<div class= "col-sm-4">

			</div>
			<div class="col-sm-4">
				<a href="detailsClient.php?detailler= <?= $_SESSION['client_id'] ?>" > <button type="button" class="btn btn-warning btnn" > Vos Factures</button></a>
			</div>
			<div class= "col-sm-4">

			</div>
		</div>
		<?php }?>
	</div>

<?php
	require'footer.php';
?>