<?php
	session_start();
	if (!isset($_SESSION['admin_id'])&& !isset($_SESSION['agent_id']) && !isset($_SESSION['client_id'])) {
		header("Location:login.php");
	}
	require_once("connexion.php");

	if(isset($_POST['envoyer']))
	{
		$tournee=$_POST['tournee'] ;
		$nom=$_POST['nom_client'];
		$num_client=$_POST['num_client'] ;
		$agence= $_POST['agence'];
		// La date depuis l'input
		$date=date_create('01 '.$_POST['debut']);
		$debut=date_format($date,"Y-m-d");
		$debutToSec=strtotime($debut);
		$fin = date("Y-m-d", strtotime("+1 month", $debutToSec));
		$finToSec=strtotime($fin);
		$date_limit = date("Y-m-d", strtotime("+10 days", $finToSec));
		$energie_consommee=$_POST['energie_consommee'] ;
		// Calcule du prix total :
		if($energie_consommee<=100)
			$prixTsansTVA=$energie_consommee*0.91;
		else if ($energie_consommee<=200)
			$prixTsansTVA=$energie_consommee*1.01;
		else $prixTsansTVA=$energie_consommee*1.12;

		$prixT=$prixTsansTVA+$prixTsansTVA*0.14;

		$request="INSERT INTO factures SET tournee='".$tournee."',num_client='".$num_client."',agence='".$agence."',debut_consom='".$debut."',energie_consommee='".$energie_consommee."',prixTot='".$prixT."',date_limit='".$date_limit."' ";

		if($facture=mysqli_query($connection,$request)) $msg="Vos données sont bien enregistrée";
		else {
			echo mysqli_error($connection);
			mysqli_close($connection);
			exit();
		}
	}

	$request1="select factures.num_client,num_facture,nom,tournee,agence,debut_consom,date_limit,energie_consommee,prixTot from factures,clients where factures.num_client='".$_POST['num_client']."' AND factures.num_client=clients.num_client ";
	$result1=mysqli_query($connection,$request1);
	if($result1) $msg="facture ajoutee avec succee";
	else {
		echo mysqli_error($connection);
		mysqli_close($connection);
		exit();
	}
	
	$page_title= 'consomation review';
?>

<?php require 'header.php'; ?>

	<div id="content">
		<div class="margin">
            <h3>Ensemble des factures : </h3>
        </div>
		<table class="table table-hover margin text-center">
			<tr class="table-dark bld">
				<td>Numéro du client</td>
				<td>Nom du client</td>
				<td>Tourné</td>
				<td>Agence</td>
				<td>Début</td>
				<td>Date limite de paiement</td>
				<td>Energie consommée (KWh) </td>
				<td>Prix total (MAD)</td>
				<td></td>
			</tr>
<?php
	while ($facture=mysqli_fetch_assoc($result1)) 
	{
		echo '<tr class="table-secondary">'; 
			echo '<td> ';  echo $facture['num_client'];    echo '</td>';
			echo '<td> ';  echo $facture['nom'];    echo '</td>';
			echo '<td> ';  echo $facture['tournee'];    echo '</td>';
			echo '<td> ';  echo $facture['agence'];    echo '</td>';
			echo '<td> ';  echo $facture['debut_consom'];    echo '</td>';
			echo '<td> ';  echo $facture['date_limit'];   echo '</td>';
			echo '<td> ';  echo $facture['energie_consommee'];    echo '</td>';
			echo '<td> ';  echo $facture['prixTot'];   echo '</td>';
			echo "
				<td> <a class=\"btn btn-primary\" href=\"facturesDuClient.php?num_facture=".$facture['num_facture']."&num_client=".$facture['num_client']."\">Générer Facture</a> </td>";
		echo'</tr>';
	}
?>
		</table>
	</div>

<?php
	if(isset($connection)){
		mysqli_close($connection);
	}
?>

<?php require 'footer.php'; ?>
