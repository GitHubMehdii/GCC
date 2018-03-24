
<?php
	if(!isset($page_title)) $page_title="Menu Principale";
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
        <title><?php echo $page_title; ?></title>
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
					<a class="navbar-brand" href="index.php"><img src="img/logo.png" width="25%"></a>
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
