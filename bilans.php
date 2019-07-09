<?php
    session_start();

    if (!isset($_SESSION['logged'])){
        header('Location: index.php');
        exit();
    }
    
    if (isset($_POST['month'])) {
        
        require_once "connect.php";
        mysqli_report(MYSQLI_REPORT_STRICT);
        
        $bilance = true;
        $id = $_SESSION['id'];
        $month = $_POST['month'];
        
        if($month == "current_month"){
              
            $first_day_of_month = date('Y-m-01');
            $last_day_of_month = date('Y-m-t');
            
            try {
            $connection = new mysqli($host, $db_user, $db_password, $db_name);
                
            if ($connection->connect_errno!=0) {
				throw new Exception(mysqli_connect_errno());
			} else {
            
                if ($bilance == true) {
                
                if ($sqlQuery = $connection->query("SELECT i.amount, i.date_of_income, ic.name 
FROM incomes i, incomes_category_assigned_to_users ic 
WHERE i.user_id = '$id' 
AND ic.id = i.income_category_assigned_to_user_id 
AND date_of_income >= '$first_day_of_month' 
AND date_of_income <= '$last_day_of_month'")) {
                    
                echo $first_day_of_month."<br/>";
                echo $last_day_of_month;    
                    
                $_SESSION['successful_bilance'] = true;
                unset($_POST['month']);

                    } else {
                        throw new Exception($connection->error);
                    }
                }
                 $connection->close();
                }

            } catch(Exception $e) {
            echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
            echo '<br />Informacja developerska: '.$e;
            }
        }
        
        if($month == "custom"){
           $date1 = $_POST['date1'];
            $date2 = $_POST['date2'];
            echo $date1."<br/>";
            echo $date2;     
        }
        
       
        
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
          <a class="navbar-brand" href="menu.php"><img src="images/logo.png" class="img-responsive" alt=""></a>
        </div>

        <div class="collapse navbar-collapse" id="moje-menu">
          <ul class="nav navbar-nav mr-auto">
            <li class="pull-left nav-item"><a href="menu.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
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

<!--###############################-->
<!--formularz########################-->
<!--###############################-->
<form method="post">
    <div class="form-group">
        <div class="col-xs-offset-5 col-sm-7 col-sm-offset-9 col-sm-3 col-md-offset-9 col-md-3 col-lg-offset-10 col-lg-2 text-right"> 
           <label for="month">Wybierz zakres:</label>
              <select class="form-control" name="month" id="range-style">
                <option value="current_month">Bieżący miesiąc</option>
                <option value="last_month">Poprzedni miesiąc</option>
                <option value="current_year">Bierzący rok</option>
                <option value="custom" data-toggle="modal" data-target="#myModal"><a href="#date-range">Niestandardowy</a></option>
            </select> 
            <div class="row">
          <div class="col-md-offset-2 col-md-10">
            <button type="submit" class="btn btn-success btn-sm">
              Potwierdź
            </button>
          </div>
        </div>
        </div>
    </div>     



<!--################################################-->
<!--modal window zakred dat ########################-->
<!--################################################-->
    
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog narrow-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Zakres dat</h4>
              </div>
            
              <div class="modal-body">
                <div class="input-group input-daterange">
                    <input type="text" class="form-control" id ="date" name="date1">
                    <div class="input-group-addon">do</div>
                    <input type="text" class="form-control" id ="date" name="date2">
                  </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-default">OK</button>
              </div>
         
            </div>
          </div>
      </div>
   </form>  
      
   
      
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