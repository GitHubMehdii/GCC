<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Home Page</title>

  <!-- Bootstrap -->
  <link href="assets/css/bootstrap.css" rel="stylesheet">
  <link href="assets/css/bootstrap-theme.css" rel="stylesheet">
  <link rel="icon" href="assets/img/logo.png">

  <!-- siimple style -->
  <link href="assets/css/style.css" rel="stylesheet">


</head>

<body>

  <!-- Fixed navbar -->
  <div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php" >
          <div class="container">
            <div class="row">
              <div class="col-md-6">
                <img src="assets/img/logohori.png" width="20%">
              </div>
              <div class="col-md-6">
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="navbar-collapse collapse margintop" >
        <ul class="nav navbar-nav navbar-right" >
          <li><a href="login.php">Se Connecter</a></li>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
  </div>

  <div id="header">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <h1>GCC Électricité</h1>
          <h2 class="subtitle">Présent sur les cinq continents avec plus de 163 226 salariés, GCC Électricité conçoit et déploie des solutions pour la gestion  énergétique, participant au développement durable et à la compétitivité de ses clients.</h2>
          <form class="form-inline signup" role="form" action="login.php">
            <div class="form-group margin">
            </div>
			       <button type="submit" class="btn btn-theme margin" >Se Connecter</button>
          </form>
        </div>
        <div class="col-lg-4 col-lg-offset-2">
          <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
              <li data-target="#carousel-example-generic" data-slide-to="1"></li>
              <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>
            <!-- slides -->
            <div class="carousel-inner">
              <div class="item active ">
                <img src="assets/img/electricite.png" alt="">
              </div>
              <div class="item ">
                <img src="assets/img/topelement.png" alt="">
              </div>
              <div class="item ">
                <img src="assets/img/elec.png" alt="">
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  <div id="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <p class="copyright">Pour nous contacter : +212537708787</p>
        </div>
        <div class="col-md-6">
          <div class="credits">
            <p class="copyright" >&copy; 2018 GCC inc  </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>

</body>

</html>
