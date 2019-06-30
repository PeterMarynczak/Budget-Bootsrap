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
          <a class="navbar-brand" href="menu.html"><img src="images/logo.png" class="img-responsive" alt=""></a>
        </div>

        <div class="collapse navbar-collapse" id="moje-menu">
          <ul class="nav navbar-nav mr-auto">
            <li class="pull-left nav-item"><a href="menu.html"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li><a class="nav-link" href="przychod.html"><span class="glyphicon glyphicon-plus"></span> Dodaj przychód</a></li>
            <li class="nav-item"><a class="nav-link" href="wydatek.html"><span class="glyphicon glyphicon-minus"></span> Dodaj wydatek</a></li>
            <li class="nav-item"><a class="nav-link" href="bilans.html"><span class="glyphicon glyphicon-usd"></span> Przeglądaj bilans</a></li>
            <li class="nav-item"><a class="nav-link" href="ustawienia.html"><span class="glyphicon glyphicon-wrench"></span> Ustawienia</a></li> 
            <li class="nav-item social pull-right"><a class="nav-link" href="#wyloguj"><span class="glyphicon glyphicon-off"></span> Wyloguj się</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>  
</header>         

<!--###############################-->
<!--formularz########################-->
<!--###############################-->
 
<h3 id="subject">Dodaj wydatek</h3>
<div class="container">
    
    <div class="col-md-offset-2 col-md-8">
      <form >
        <div class="form-group">
            <div class="row">
                  <label for="kwota" class="col-md-2 col-lg-2">
                    Kwota:
                  </label>
                  <div class="col-md-10 col-lg-10 input-group">
                    <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-usd"></span></span>
                    <input type="text" class="form-control" id="kwota" placeholder="Wprowadź kwotę przychodu">
                  </div>
                </div>
        </div>
        
    <div class="row">
        <div class="form-group">
          <label for="date" class="col-md-2 col-lg-2">
        Data:
          </label>
          <div class="col-md-10 col-lg-10 input-group">
            <span class="input-group-addon" id="basic-addon2"><span class="glyphicon glyphicon-calendar"></span></span>
            <input class="form-control" type="text" id="date" name="date" placeholder="YYYY-MM-DD" />
          </div>
        </div>  
        </div>
    
    <div class="form-group">
        <div class="row">
          <h4 class="col-md-2">
            Sposób płatności:
          </h4>
          <div class="col-md-10 col-lg-10">
            <label class="radio">
              <input type="radio" name="platnosc" id="gotowka" value="gotowka" checked>
              Gotówka
            </label>
            <label class="radio">
              <input type="radio" name="platnosc" id="debetowa" value="debetowa">
              Karta debetowa
            </label>
            <label class="radio">
              <input type="radio" name="platnosc" id="kredytowa" value="kredytowa">
              Karta kredytowa
            </label>
         </div>
      </div>
    </div>
          

          
    <div class="form-group">
    <div class="row">
    <label for="kategoria" class="col-md-2 col-lg-2">Kategoria:</label>
        <div class="col-md-10 col-lg-10">
            <select class="form-control" id="kategoria">
              <option>Jedzenie</option>
              <option>Mieszkanie</option>
              <option>Transport</option>
              <option>Telekomunikacja</option>
              <option>Opieka zdrowotna</option>
              <option>Ubranie</option>
              <option>Higiena</option>
              <option>Dzieci</option>
              <option>Rozrywka</option>
              <option>Szkolenia</option>
              <option>Książki</option>
              <option>Oszczędności</option>
              <option>Na złotą jesień, czyli emeryturę</option>
              <option>Spłata długów</option>
              <option>Darowizna</option>
              <option>Inne wydatki</option>
            </select>
        </div>
    </div>
  </div>
          

          
    <div class="form-group shadow-textarea">
        <div class="row">
            <label for="komentarz" class="col-md-2 col-lg-2">Komentarz:</label>
                <div class="col-md-10 col-lg-10">
                    <textarea class="form-control z-depth-1" id="komentarz" rows="1"></textarea>
                </div>
            </div>
        </div>
 
    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-10">
                <button type="submit" class="btn btn-success btn-sm">
                  Dodaj
                </button>
                <button type="submit" class="btn btn-danger btn-sm">
                  Anuluj
                </button>
            </div>
        </div>
    </div>
  </form>
    </div>
  </div>      
  
 
<!--###############################-->
<!--stopka ########################-->
<!--###############################-->

   <hr>
    <section id="stopka">
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
    </section>
      
    <!-- sekcja JavaScript  -->
    <script src="js/jquery-2.0.3.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/wlasny.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>   
      
    <script>
       
    </script>
  </body>
</html>