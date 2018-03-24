<?php
	session_start();
	if (!isset($_SESSION['admin_id'])) {
		header("Location:login.php");
	}
	require_once("connexion.php");
	if (isset($_GET['modifier'])) 
	{
		$_SESSION["id"]=$_GET['modifier'];
		// Réception des donnée de la BD
		$request="SELECT * from admins where id='".$_GET['modifier']."' ";
		$result=mysqli_query($connection,$request);
		if($result) {	
			$client=mysqli_fetch_assoc($result);
	  	}
	  	else {
	  		echo mysqli_error($connection);
	  		mysqli_close($connection);
	  		exit();
	  	}
	}
    $page_title='Ajouter Admin';
?>
<?php require 'header.php' ; ?>

	<form name="ajoutAdmin" method="post" action="admins.php">
		<div class="container margin">
            <div class="col-sm-12">
            	<div>
                	<h3>Les informations de l'admin :</h3>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-8">
						<fieldset>
							<div>
								<label for="nom">Nom :</label> 
								<input class="form-control" type="text" name="nom" id="nom" value= 
									"<?php
										if(isset($_GET['modifier'])) echo $client['nom'];
										if(isset($_GET['nom'])) echo $_GET['nom'];
									?>"
								/>
								<!-- Erreur -->
								<p class="text-danger"><?php if( isset($_GET['valide']) && !isset($_GET['nom'])) echo  "Veuillez saisir le Nom"; ?>
								</p>
							</div>
							<div>
								<label for="prenom">Prénom :</label> 
								<input class="form-control" type="text" name="prenom" id="prenom" value= 
									"<?php
										if(isset($_GET['modifier'])) echo $client['prenom'];
										if(isset($_GET['prenom'])) echo $_GET['prenom'];
									?>"
								/>
								<!-- Erreur -->
								<p class="text-danger"><?php if( isset($_GET['valide']) && !isset($_GET['prenom'])) echo "Veuillez saisir le Prénom"; ?>
								</p>
							</div>
							
							
							<div>
								<label for="email">Email :</label> 
								<input class="form-control" type="email" name="email" id="email" value= 
									"<?php
										if(isset($_GET['modifier'])) echo $client['email'];
										if(isset($_GET['email'])) echo $_GET['email'];
									?>"
								/>
								<!-- Erreur -->
								<p class="text-danger"><?php if( isset($_GET['valide']) && !isset($_GET['email'])) echo "Veuillez saisir l'email"; ?></p>

							</div>

							<div>
								<label for="pseudo">Pseudo :</label> 
								<input class="form-control" type="text" name="pseudo" id="pseudo" value= 
									"<?php
										if(isset($_GET['modifier'])) echo $client['email'];
										if(isset($_GET['email'])) echo $_GET['email'];
									?>"
								/>
								<!-- Erreur -->
								<p class="text-danger"><?php if( isset($_GET['valide']) && !isset($_GET['email'])) echo "Veuillez saisir l'email"; ?></p>

							</div>

							<div>
								<label for="password">Mot de Passe :</label> 
								<input class="form-control" type="password" name="password" id="password" value= 
									"<?php
										if(isset($_GET['modifier'])) echo $client['email'];
										if(isset($_GET['email'])) echo $_GET['email'];
									?>"
								/>
								<!-- Erreur -->
								<p class="text-danger"><?php if( isset($_GET['valide']) && !isset($_GET['email'])) echo "Veuillez saisir l'email"; ?></p>

							</div>

							<div>
								<label for="passwordConfirm">confirmer le Mot de Passe :</label> 
								<input class="form-control" type="password" name="passwordConfirm" id="passwordConfirm" value= 
									"<?php
										if(isset($_GET['modifier'])) echo $client['email'];
										if(isset($_GET['email'])) echo $_GET['email'];
									?>"
								/>
								<!-- Erreur -->
								<p class="text-danger"><?php if( isset($_GET['valide']) && !isset($_GET['email'])) echo "Veuillez saisir l'email"; ?></p>

							</div>

							
							<br>
							<div class="row">
								<div class= "col-sm-4">
								</div>
								<div class="col-sm-4">
									<button type="submit" name="valider"  class="btn btn-success btnn" >Valider</button>
								</div>
							</div>
						</fieldset>
					</div>
				</div>
			</div>
		</div>
	</form>

<?php require 'footer.php'; ?>