<?php 
	session_start();
	if (!isset($_SESSION['admin_id'])&& !isset($_SESSION['agent_id']) && !isset($_SESSION['client_id'])) {
		header("Location:login.php");
	}
	$page_title= 'Facture par client ';
	require 'header.php';
	require_once("connexion.php");

	if (isset($_GET['num_facture'])&&isset($_GET['num_client'])) 
	{
	
		$request="SELECT * from clients where num_client='".$_GET['num_client']."' ";
		$result=mysqli_query($connection,$request);
		if($result)
		{	
			$client=mysqli_fetch_assoc($result); 
			
	  	}else{
	  		echo mysqli_error($connection);
	  		mysqli_close($connection);

	  		exit();


	  	}

	  	$request1="SELECT factures.num_client,nom,prenom,agence,debut_consom,energie_consommee,tournee,date_limit,prixTot from factures,clients where factures.num_facture='".$_GET['num_facture']."' AND factures.num_client='".$_GET['num_client']."' AND factures.num_client=clients.num_client ";
		$result1=mysqli_query($connection,$request1);
		if($result1)
		{	
			$facture=mysqli_fetch_assoc($result1);
	  	}else{
	  		echo mysqli_error($connection);
	  		mysqli_close($connection);
	  		exit();
	  	}
    }
?>

    <script type="text/javascript" src="js/jspdf.min.js"></script>
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>﻿
	<script type="text/javascript">
		
	function genPDF(){

		var doc = new jsPDF();

		var specialElementHandlers = { '#url' : function(element,render){return true;} };

		doc.fromHTML($('#content').get(0),20,20,{

			'width':500,
			elementHandlers : specialElementHandlers

			});

		doc.save('facture.pdf');
	}

	</script>

	<div class="container margin" id="content">
            <div class="col-sm-12" >
            	<div>
                	<h3>Facture </h3> 
            	</div>
            </div>
            <div class="container">
            	<div class="row">
            		<div class="col-sm-6">
            			<div>
            				<label hidden style="font-weight: bold;">Facture</label>
            			</div>
            		</div>	
            		<div class="col-sm-6">
						<div>
							<label> Numero client: <?php echo $client['num_client']; ?>  </label>
						</div>

						<div>

							<label> Nom:  <?php echo $client['nom']; ?> </label>


						</div>
							
						<div>
						
							<label> prenom: <?php echo $client['prenom']; ?> </label>
							

						</div>

						<div>
						
							<label> agence: <?php echo $facture['agence']; ?> </label>
							

						</div>

						<div>
						
							<label> Mois:<?php echo $facture['debut_consom']; ?> </label>
					

						</div>

						 
						<div>
						
							<label> energie consommee: <?php echo $facture['energie_consommee']; ?> </label>

						</div> 

						<div>
						
							<label> tournee: <?php echo $facture['tournee']; ?> </label>

						</div> 

						<div>
						
							<label> date limite paiment: <?php echo $facture['date_limit']; ?> </label>

						</div>

						<div>
							<label> Prix sans TVA :<?php echo $facture['prixTot']/1.14; ?> </label>
						</div>
						<div>
							<label> Prix Total:<?php echo $facture['prixTot']; ?> </label>
						</div>
						<br>
						<div id="url">
							<a class="btn btn-primary" href="javascript:genPDF()">Télécharger</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php require 'footer.php'; ?>
