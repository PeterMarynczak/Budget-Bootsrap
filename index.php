<?php

session_start();

if(isset($_SESSION['logged']) && ($_SESSION['logged']==true)) {
    
    header ('Location: menu.php');
    exit();
}

?>

<!DOCTYPE HTML>
<html lang="pl">
  <head>
    <title>Budgety</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>  
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="css/responsive.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="style.css">
      
    <link rel="stylesheet" type="text/css" media="all" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700&subset=latin,latin-ext">
  </head>
  <body>

    <!--###############################-->
    <!-- MENU GÓRNE ###################-->
    <!--###############################-->
    
<header>
    <nav class="navbar navbar-default" id="logo_glowne">
            <div class="col-sm-4 col-md-4 col-lg-4">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">
                        <div id="logo">
                            <img src="images/logo.png" alt="brand_logo" class="img-responsive">
                        </div>
                    </a>
                </div>
            </div>
      </nav>
</header>
      
    <!--###############################-->
    <!-- BODY STRONY###################-->
    <!--###############################-->
      
<section id="index_body">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 body_naglowek">       
                    <h2>Aplikacja dbająca o finanse</h2>
                        <p class="quote-text">
                            Zrobić budżet to wskazać swoim pieniądzom, dokąd mają iść, zamiast się zastanawiać, gdzie się rozeszły.<br> - John C. Maxwell 
                        </p>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-5">
                    <img src="images/budget_img.jpg" class="img-responsive" alt="" id="family_img">
                </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-7">
                        <h3>Przychody</h3>
                        <h5><span class="glyphicon glyphicon-ok"></span> Archiwizuj każdy zastrzyk finansowy</h5>
                        <p>Miej dostęp do archiwum przychodów, z laptopa, z telefonu. Bądź na bierząco z własnym rachunkiem</p>

                        <h3>Wydatki</h3>
                        <h5><span class="glyphicon glyphicon-ok"></span> Kontroluj odpływ finansów</h5>                    
                        <p>Pamiętaj, że oszczędzania polega na wydawaniu mniej niż zarabiasz,
                        różnicę inwestuj</p>
                    </div>
            </div>
        </div>
    </section>

    <!--###############################-->
    <!-- LOGOWANIE###################-->
    <!--###############################-->

    <div class="container jumbotron text-center" id="login-panel">
        <h3 id="join-h3">Dołącz do budgety.pl już dziś!</h3>
        
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#loginModal">Logowanie</button>
        
        <button type="button" class="btn btn-success but-reg" data-toggle="modal" data-target="#regModal">Rejestracja</button>
        
        <?php
            if(isset($_SESSION['error'])){
                
               echo '<div class="error">'.$_SESSION['error'].'</div>'; 
               unset ($_SESSION['error']);
            } 
        ?>
        <?php
			if (isset($_SESSION['e_nick'])) {
                
				echo '<div class="error">'.$_SESSION['e_nick'].'</div>';
				unset($_SESSION['e_nick']);
			}
		?>
        <?php
			if (isset($_SESSION['e_email']))
			{
				echo '<div class="error">'.$_SESSION['e_email'].'</div>';
				unset($_SESSION['e_email']);
			}
		?>
        <?php
			if (isset($_SESSION['e_pass']))
			{
				echo '<div class="error">'.$_SESSION['e_pass'].'</div>';
				unset($_SESSION['e_pass']);
			}
		?>
        
    </div>

    <div class="modal fade" role="dialog" id="loginModal">
        <div class="modal-dialog narrow-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">LOGOWANIE</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                </div>
                
                <form action="zaloguj.php" method="post">
                    <div class="modal-body">
                        <div class="form-group input-group">
                            <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user"></span></span><input type="text" name="login" class="form-control" placeholder="Login">
                        </div>
                         <div class="form-group input-group">
                             <span class="input-group-addon" id="basic-addon2"><span class="glyphicon glyphicon-lock"></span></span>
                            <input type="password" name="password" class="form-control" placeholder="Hasło">
                        </div>
                        <div class="modal-footer">
                        <button type="submit" class="btn btn-success" >Zaloguj się</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>    
    
      <div class="modal fade" role="dialog" id="regModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">REJESTRACJA</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                </div>
                
            <form action="rejestracja.php" method="post">
                <div class="modal-body">
                    <div class="form-group input-group">
                        <span class="input-group-addon" id="basic-addon3"><span class="glyphicon glyphicon-user"></span></span><input type="text" name="nick" class="form-control" placeholder="Login">
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon" id="basic-addon3"><span class="glyphicon glyphicon-envelope"></span></span><input type="text" name="email" class="form-control" placeholder="Email">
                    </div>
                   <div class="form-group input-group">
                         <span class="input-group-addon" id="basic-addon4"><span class="glyphicon glyphicon-lock"></span></span>
                        <input type="password" name="pass1" class="form-control" placeholder="Hasło">
                    </div>
                     <div class="form-group input-group">
                         <span class="input-group-addon" id="basic-addon4"><span class="glyphicon glyphicon-lock"></span></span>
                        <input type="password" name="pass2" class="form-control" placeholder="Powtórz hasło">
                    </div>
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-success but-reg">Zarejestruj się</button>
                </div>
                </div>
            </form>
            </div>
        </div>
    </div>    
    
    <hr>
    <section id="stopka">
        <div class="container">
            <footer class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">       
                    <h4>Copyright 2019 &copy; Budgety.pl</h4>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
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

    </script>
  </body>
</html>