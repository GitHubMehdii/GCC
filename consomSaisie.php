<?php
	session_start();
	if (!isset($_SESSION['admin_id'])&& !isset($_SESSION['agent_id']) && !isset($_SESSION['client_id'])) {
		header("Location:login.php");
	}
	if(isset($_GET['id'])&&isset($_GET['nom'])) {
		$id=$_GET['id'] ;
		$nom=$_GET['nom'];
	}
	else {
		$id="";
		$nom="";
	}
	$page_title='Consomation';
?>

<?php require 'header.php'; ?>

	<form name="consommation" method="post" action="consomReview.php">
		<div class="container margin">
            <div class="col-sm-12">
            	<div>
                	<h3>La facture :</h3>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-8">
						<fieldset>
							<div>
								<label>Tournée:</label>
								<input class="form-control" type="text" name="tournee" readonly value="<?php echo date('ymd'); ?>"/>
							</div>
							<div>
								<label>Nom du client:</label>
								<input class="form-control" type="text" name="nom_client" readonly value="<?php echo $nom;?>"/>
							</div>
							<div>
								<label>Numéro de client:</label>
								<input class="form-control" type="text" name="num_client" readonly value="<?php echo $id; ?>"/>
							</div>
							<div>
								<label for="agence">Agence:</label>
								<select class="form-control" name="agence" id="agence">
							        <option>Agence1</option>
							        <option>Agence2</option>
							        <option>Agence3</option>
							        <option>Agence4</option>
							        <option>Agence5</option>
							    </select>
							</div>
							<div>
								<label for="debut">Consomation de mois:</label>
								<select class="form-control" name="debut" id="debut">
							        <?php
							        	for($m=1,$y=date("Y");$m<=12;$m++) {
											$date=date_create("$y-$m");
											echo "<option>".date_format($date,"M Y")."</option>";
										}
							        ?>
							    </select>
							</div>
							<div>
								<label for="consommee" >Consomation en KWh:</label>
								<input class="form-control" type="number" min="0" name="energie_consommee" required id="consommee" />
							</div>
							<br><br><br>
							<div class="row">
								<div class= "col-sm-4">
								</div>
								<div class="col-sm-4">
									<button type="submit" name="envoyer" class="btn btn-success btnn" >Valider</button>
								</div>
							</div>
						</fieldset>
					</div>
				</div>
			</div>
		</div>
	</form>

<?php require 'footer.php'; ?>
