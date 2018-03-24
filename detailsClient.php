<?php
	 session_start();
	if (!isset($_SESSION['admin_id'])&& !isset($_SESSION['agent_id']) && !isset($_SESSION['client_id'])) {
		header("Location:login.php");
	}
	require_once("connexion.php");

	if (isset($_GET['detailler'])) 
	{
	
		$request="SELECT * from clients where num_client='".$_GET['detailler']."' ";
		$result=mysqli_query($connection,$request);
		if($result)
		{	
			$client=mysqli_fetch_assoc($result);
	  	}else{
	  		echo mysqli_error($connection);
	  		mysqli_close($connection);
	  		exit();

	  	}

	  	$request1="SELECT factures.num_client,nom,factures.num_facture,tournee,agence,debut_consom,energie_consommee,date_limit from factures,clients where factures.num_client='".$_GET['detailler']."'AND factures.num_client=clients.num_client  ";
		$result1=mysqli_query($connection,$request1);
		if(!$result)
		{
	  		echo mysqli_error($connection);
	  		mysqli_close($connection);
	  		exit();

	  	}
    }

    $page_title= 'Détails client';
?>

<?php  require 'header.php'; ?>

	<div class="container margin">
            <div class="col-sm-12">
            	<div>
                	<h3>Informations Personnelles</h3>
                </div>
				<br>
				<fieldset> 
				<div>
					<label> Numéro du client: <?php echo $client['num_client']; ?></label>
				</div>
				<div>
					<label> Nom:   <?php echo $client['nom']; ?></label>
				</div>
				<div>
					<label> Prénom:   <?php echo $client['prenom']; ?> </label>
				</div>
				<div>
					<label> Date de naissance:    <?php echo $client['datenaiss']; ?></label>
				</div>
				<div>
					<label> Date d'adhésion:   <?php echo $client['date_inscrip']; ?></label>
				</div>
				<div>
					<label> Téléphone:   <?php echo $client['telephone']; ?> </label>
				</div>
				<div>
					<label> Adresse:   <?php echo $client['adresse']; ?> </label>
				</div> 
				<div>
					<label> Pseudo:   <?php echo $client['pseudo']; ?> </label>
				</div> 
	  	</fieldset>
	  		<div>
                <h3>Ensemble des factures de : <?php echo $client['nom']; ?></h3>
            </div>
				<table class="table table-hover margin text-center">
					<tr class="table-dark bld">
						<td>Numéro du client</td>
						<td>Propriétaire </td>
						<td>Numéro du factures </td>
						<td>Tournée </td>
						<td>Agence </td>
						<td>Début </td>
						
						<td>Energie consommée </td>
						<td>Date limite de paiement </td>
						<td></td>
					</tr>
<?php
	while ($facture=mysqli_fetch_assoc($result1)) 
	{
?>
		<tr class="table-secondary">
			<td>   <?= $facture['num_client'] ?>   </td>
			<td>   <?= $facture['nom']    ?> </td>
			<td>   <?= $facture['num_facture']    ?> </td>
			<td>   <?= $facture['tournee']    ?> </td>
			<td>   <?= $facture['agence']    ?> </td>
			<td>   <?= $facture['debut_consom']    ?> </td>
			
			<td>   <?= $facture['energie_consommee']   ?> </td>
			<td>   <?= $facture['date_limit']   ?> </td>
			<td> <a class="btn btn-primary" href="facturesDuClient.php?num_facture=<?=$facture['num_facture']."&num_client=".$facture['num_client']?>">Générer facture</a> </td>
		</tr>
<?php
	}

?>
	</table>	
		 
</div>


<?php require 'footer.php'; ?>