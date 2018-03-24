<?php
	session_start();
	require_once("connexion.php");
	//echo '<pre>';
	//print_r($_SESSION);
	//echo '</pre>';

	if (isset($_GET['logout'])) {

		unset($_SESSION['pseudo']);
		unset($_SESSION['last_login']);

			if (isset($_SESSION['agent_id'])) {

				unset($_SESSION['agent_id']);
			}
			if (isset($_SESSION['client_id'])) {

				unset($_SESSION['client_id']);
			}
			if (isset($_SESSION['admin_id'])) {

				unset($_SESSION['admin_id']);
				unset($_SESSION['type']);
			}
	
	}

	if(isset($_POST['Envoyer'])){

		$pwd=$_POST['password'];
		$pseudo=$_POST['pseudo'];



		$request="select * from clients where pseudo='".$pseudo."' LIMIT 1"; 
		$result=mysqli_query($connection, $request);
		if ($result) {

			$admin = mysqli_fetch_assoc($result); 

		}else{

			echo mysqli_error($connection);
	  		mysqli_close($connection);
	  		exit();
	  	}


	  	if($admin){

	  		if(password_verify($pwd,$admin['password'])) {

	  				//mot de passe correcte 
		  		

		  			if($admin['type']=='AD') {

		  				// si l'utilisateur est admin

		  				session_regenerate_id();
			  			$_SESSION['pseudo']=$admin['pseudo'];
			  			$_SESSION['admin_id']=$admin['num_client'];
			  			$_SESSION['last_login']=time();
			  			//$_SESSION['type']=$admin['type'];

			  			header("Location:index.php");

	  				}
	  				if($admin['type']=='AG'){

	  					// si l'utilisateur est un agent

	  					session_regenerate_id();
			  			$_SESSION['pseudo']=$admin['pseudo'];
			  			$_SESSION['agent_id']=$admin['num_client'];
			  			$_SESSION['last_login']=time();

			  			header("Location:index.php");

	  				}
	  				if($admin['type']=='C') {

	  					// si l'utilisateur est un simple client

	  					session_regenerate_id();
			  			$_SESSION['pseudo']=$admin['pseudo'];
			  			$_SESSION['client_id']=$admin['num_client'];
			  			$_SESSION['last_login']=time();

			  			header("Location:index.php");

	  				}

	  		 }else{

	  		 	//mot de passe incorrecte 
	  		 	$msg="login fail" ;

	  		 }
	  		
	  	}else{

	  		 	//pas d'admin avec ce pseudo
	  		 	$msg="login fail" ;

	  		 }


		
	}

 ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
        <title>Login</title>
        <link rel="icon" href="img/logo.png">
        <!-- Bootstrap and CSS -->
	    <link href="stylesheets/bootstrap.css" rel="stylesheet">
	    <link href="stylesheets/style.css" rel="stylesheet">

	</head>
<body>
	<div class="navimg">
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<a class="navbar-brand" href="Home.php"><img src="img/logo.png" width="25%"></a>
				</div>
				<div class="col-sm-7">
					<h4 class="masthead-subheading mb-0 margintop">A Votre Service Au Quotidien 7/7</h4>
				</div>
				<div class="col-sm-2 margin">
					<?php
					if (isset($_SESSION['admin_id']) || isset($_SESSION['agent_id']) || isset($_SESSION['client_id'])) {
						echo '<a href="login.php?logout=ok"> <h6 >Se Déconnecter</h6> </a>';
					}
					?>
				</div>
			</div>
		</div>
	</div>

<div class="container">

<?php if (!empty($msg)){

echo $msg;


}
?>

		<br><br><br><br><br>
	<div class="col-lg-6" style="margin-left: 260px;">


        <form class="form my-2 my-lg-0" name="recherche" method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'] ;?>" >
            

	            <div class="form-group">
	            	
	            	<label for="pseudo"> Pseudo </label> 

					<input class="form-control mr-sm-2" type="text" placeholder=" Entrez votre Pseudo" name="pseudo" />

	            </div>
	        	
	            <div class="form-group">
	            	
	            	<label for="pseudo"> Mot de Passe  </label>

					<input class="form-control mr-sm-2" type="password" placeholder="Entrez votre Mote de Passe" name="password" />

	            </div>

	            <div class="form-group">
	            	
					<input class="btn btn-default" type="submit" name="Envoyer"  value="Envoyer" />

	            </div>
			
		</form>

	</div>

</div>



<?php require 'footer.php'; ?>