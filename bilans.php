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
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
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
 


<!-- Single button -->
<div class="col-md-4 col-md-offset-8 col-lg-offset-8 col-lg-4 text-right"> 
    <div class="btn-group">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Wybierz zakres <span class="caret"></span>
          </button>
          <ul class="dropdown-menu text-left">
            <li><a href="#">Bieżący miesiąc</a></li>
            <li><a href="#">Poprzedni miesiąc</a></li>
            <li><a href="#">Bierzący rok</a></li>
            <li role="separator" class="divider"></li>
            <li data-toggle="modal" data-target="#myModal"><a href="#date-range">Niestandardowy</a></li>
          </ul>
    </div>
</div>
      
<!--################################################-->
<!--modal window zakred dat ########################-->
<!--################################################-->
      
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Zakres dat</h4>
              </div>
              <div class="modal-body">
                <div class="input-group input-daterange">
                    <input type="text" class="form-control" name="date">
                    <div class="input-group-addon">do</div>
                    <input type="text" class="form-control" name="date">
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
                <button type="button" class="btn btn-primary">Zapisz</button>
              </div>
            </div>
          </div>
      </div>
      
      
 <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Przychody</h2></div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kategoria</th>
                        <th>Data</th>
                        <th>Kwota</th>
                        <th>Komentarz</th>
                        <th>Edytuj/Usuń</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                        </td>
                    </tr>      
                </tbody>
            </table>
        </div>
    </div>          
      
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Wydatki</h2></div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kategoria</th>
                        <th>Data</th>
                        <th>Kwota</th>
                        <th>Komentarz</th>
                        <th>Edytuj/Usuń</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                        </td>
                    </tr>      
                </tbody>
            </table>
        </div>
    </div>          
      
<!--###############################-->
<!--diagram ########################-->
<!--###############################-->
  
    <div class="container">
    <div class="chart-container">
        <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2 col-lg-12"> 
        <canvas id="myChart"></canvas>
        </div>
    </div> 
    </div>
 
<!--###############################-->
<!--stopka ########################-->
<!--###############################-->

   <hr>
    <footer>
            <div class="navbar navbar-fixed-bottom" id="stopka">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">       
                    <h4>Copyright 2019 &copy; Budgety.pl</h4>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <a href="#"><img src="icons/facebook.png" alt="" class="img-responsive"></a>
                    <a href="#"><img src="icons/googleplus.png" alt="" class="img-responsive"></a>
                    <a href="#"><img src="icons/twitter.png" alt="" class="img-responsive"></a>
                    <a href="#"><img src="icons/vimeo.png" alt="" class="img-responsive"></a>    </div>            
                </div>
            </footer>
      
    <!-- sekcja JavaScript  -->
     
      
      
    <script src="js/jquery-2.0.3.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>   
    <script src="js/wlasny.js"></script>  
   <script>

    </script>
  </body>
</html>