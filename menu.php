<?php
    session_start();

    if (!isset($_SESSION['logged'])){
        header('Location: index.php');
    }
?>

<!DOCTYPE HTML>
<html lang="pl">
  <head>
    <title>Budgety</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>  
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="style.css" rel="stylesheet" media="screen">
    <link href="css/responsive.css" rel="stylesheet" media="screen">
      
    <link rel="stylesheet" type="text/css" media="all" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700&subset=latin,latin-ext">
        
  </head>
  <body>

    <!--###############################-->
    <!-- MENU GÓRNE ###################-->
    <!--###############################-->
  <header>   
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#moje-menu">
            <span class="sr-only">Nawigacja</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="menu.php"><img src="images/logo.png" class="img-responsive" alt=""></a>
        </div>

        <div class="collapse navbar-collapse" id="moje-menu">
          <ul class="nav navbar-nav mr-auto">
            <li class="pull-left nav-item"><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li><a class="nav-link" href="przychod.php"><span class="glyphicon glyphicon-plus"></span> Dodaj przychód</a></li>
            <li class="nav-item"><a class="nav-link" href="wydatek.php"><span class="glyphicon glyphicon-minus"></span> Dodaj wydatek</a></li>
            <li class="nav-item"><a class="nav-link" href="bilans.php"><span class="glyphicon glyphicon-usd"></span> Przeglądaj bilans</a></li>
            <li class="nav-item"><a class="nav-link" href="ustawienia.php"><span class="glyphicon glyphicon-wrench"></span> Ustawienia</a></li> 
            <li class="nav-item social pull-right"><a class="nav-link" href="wyloguj.php"><span class="glyphicon glyphicon-off"></span> Wyloguj się</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>  
</header>  
      
    
<?php
      echo '<div class="col-xs-6 col-sm-2 col-md-2 col-lg-2 col-xs-offset-3 col-sm-offset-5 col-md-offset-5 col-lg-offset-5">';
      echo "<p>Witaj ".$_SESSION['user']."!";
      echo '</div>';
?>
      
    <!--###############################-->
    <!--Carousel ######################-->
        <div id="pokaz-slajdow" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#pokaz-slajdow" data-slide-to="0" class="active"></li>
                <li data-target="#pokaz-slajdow" data-slide-to="1"></li>
                <li data-target="#pokaz-slajdow" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="item active">
                    <img src="images/carousel1.jpg" alt="" class="img-responsive">
                    <div class="carousel-caption">
                        <h1>Kontroluj własny budżet</h1>
                        <p>Poznaj aplikację Budgety.pl</p>
                    </div>
                </div>
                <div class="item">
                    <img src="images/carousel2.jpg" alt="" class="img-responsive">
                    <div class="carousel-caption">
                        <h1>Przeglądaj własny rachunek w kilka sekund</h1>
                    </div>                 
                </div>
                <div class="item">
                    <img src="images/carousel3.jpg" alt="" class="img-responsive">
                    <div class="carousel-caption">
                        <h1>Siła oszczędzania</h1>
                        <p>To proste, wydawaj mniej niż zarabiasz</p>
                    </div>                 
                </div>                        
            </div>
        </div>

    <!--###############################-->
    <!--stopka ########################-->
    <!--###############################-->

   <hr>
    <section id="stopka">
        <div class="container">
            <footer class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">       
                    <h4>Copyright 2019 &copy; Budgety.pl</h4>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <a href="#"><img src="icons/facebook.png" alt="" class="img-responsive"></a>
                    <a href="#"><img src="icons/googleplus.png" alt="" class="img-responsive"></a>
                    <a href="#"><img src="icons/twitter.png" alt="" class="img-responsive"></a>
                    <a href="#"><img src="icons/vimeo.png" alt="" class="img-responsive"></a>                 
                </div>
            </footer>
        </div>
    </section>
      
    <!-- sekcja JavaScript  -->
     <script src="js/jquery-2.0.3.min.js"></script>
    <script src="js/bootstrap.js"></script>

    <script>
        $('ul.navbar-nav li a').each((i, item) => {
          if ($(item).attr('data-page')) {
            $(item).on('click', (element) => {
                $('#mainContainer').load($(element.target).attr('data-page')+'.html');
    });
  }
});
    </script>
  </body>
</html>