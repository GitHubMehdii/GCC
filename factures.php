<?php
	session_start();
	if (!isset($_SESSION['admin_id']) && !isset($_SESSION['agent_id']) && !isset($_SESSION['client_id'])) {
		header("Location:login.php");
	}
	require_once("connexion.php"); 

// Selection pour la recherche
	if (isset($_GET['chercher'])) 
	{
		//$request1="SELECT * from facture where num_client in (select num from clients where (nom like '%".$_GET['chercher']."%' ) ) ";
		$request1="SELECT factures.num_client,nom,num_facture,tournee,agence,debut_consom,energie_consommee,date_limit from clients,factures where nom like '%".$_GET['chercher']."%' AND factures.num_client=clients.num_client ";
		$result1=mysqli_query($connection,$request1);

		if(!$result1){
			echo mysqli_error($connection);
			mysqli_close($connection);
			exit();
		}
	 // Selection pour l'affichage du tableau
	}else {
		$request1="SELECT factures.num_client,nom,num_facture,tournee,agence,debut_consom,energie_consommee,date_limit from factures,clients";
		$result1=mysqli_query($connection,$request1);
		if(!$result1){
			echo mysqli_error($connection);
			mysqli_close($connection);
			exit();
		}
	}
?>
<?php  $page_title= 'Facture'; ?>
<?php  require 'header.php'; ?>
	<div class="container margin">
            <div class="col-sm-12">
            	<div>
                	<h3>Liste des factures :</h3>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                    </div>
                    <form class="form-inline my-2 my-lg-0 " name="recherche" method="GET" action="" >
	                    <div class="form-group">
							<input class="form-control mr-sm-2" type="text" placeholder="Nom" name="chercher" value="<?php if (isset($_GET['chercher'])) { echo $_GET['chercher']; } ?>"/>
							<input class="btn btn-secondary my-2 my-sm-0" type="submit" name="valider" value="Rechercher"/>
						</div>
					</form>
				</div>
				<table class="table table-hover margin text-center">
					<tr class="table-dark bld">
						
						<td>Propriétaire </td>
						<td>Numero client </td>
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
			
			<td>   <?= $facture['nom']    ?> </td>
			<td>   <?= $facture['num_client']    ?> </td>
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
