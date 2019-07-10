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
            
        } else if ($month == "last_month") {
            $first_day_of_month = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1));
            $last_day_of_month = date("Y-m-d", mktime(0, 0, 0, date("m"), 0));
            
        } else if ($month == "current_year") {
          
            $first_day_of_month = date(('Y').'-01-01');
            $last_day_of_month = date('Y') . '-12-31';
            
            
        } else if($month == "custom") {
            
            $first_day_of_month = $_POST['date1'];
            $last_day_of_month = $_POST['date2'];
            $first_day_of_month = date("Y-m-d", strtotime($first_day_of_month));
            $last_day_of_month = date("Y-m-d", strtotime($last_day_of_month));
              
        }
            
            try {
            $connection = new mysqli($host, $db_user, $db_password, $db_name);
                
            if ($connection->connect_errno!=0) {
				throw new Exception(mysqli_connect_errno());
			} else {
            
                if ($bilance == true) {
                
                if ($query = $connection->query("SELECT i.amount, i.date_of_income, ic.name 
FROM incomes i, incomes_category_assigned_to_users ic 
WHERE i.user_id = '$id' 
AND ic.id = i.income_category_assigned_to_user_id 
AND date_of_income >= '$first_day_of_month' 
AND date_of_income <= '$last_day_of_month'")) {
                 
                $query_income = "SELECT i.amount, i.date_of_income, ic.name 
FROM incomes i, incomes_category_assigned_to_users ic 
WHERE i.user_id = '$id' 
AND ic.id = i.income_category_assigned_to_user_id 
AND date_of_income >= '$first_day_of_month' 
AND date_of_income <= '$last_day_of_month' ORDER BY i.date_of_income ASC";
                    
                $result_income = mysqli_query($connection, $query_income) or die("database error:". mysqli_error($connection));
                   
                $_SESSION['successful_bilance'] = true;
        

                    } else {
                        throw new Exception($connection->error);
                    }
                    
                if ($query2 = $connection->query("SELECT e.amount, e.date_of_expense, ec.name
FROM expenses e, expenses_category_assigned_to_users ec 
WHERE e.user_id = '$id' 
AND ec.id = e.expense_category_assigned_to_user_id 
AND date_of_expense >= '$first_day_of_month' 
AND date_of_expense <= '$last_day_of_month'")) {
                 
                $query_expense = "SELECT e.amount, e.date_of_expense, ec.name
                                    FROM expenses e, expenses_category_assigned_to_users ec 
                                    WHERE e.user_id = '$id' 
                                    AND ec.id = e.expense_category_assigned_to_user_id 
                                    AND date_of_expense >= '$first_day_of_month' 
                                    AND date_of_expense <= '$last_day_of_month' ORDER BY e.date_of_expense";
                    
                $sum_result = $connection->query("SELECT SUM(amount) AS amount_sum FROM incomes WHERE user_id = '$id' AND date_of_income >= '$first_day_of_month' AND date_of_income <= '$last_day_of_month'");
                    
                    
                $num_rows = $sum_result->num_rows;
                if($num_rows > 0){
                    
                    $chart_income = "SELECT i.amount, ic.name 
                            FROM incomes i, incomes_category_assigned_to_users ic 
                            WHERE i.user_id = '$id' 
                            AND ic.id = i.income_category_assigned_to_user_id 
                            AND date_of_income >= '$first_day_of_month' 
                            AND date_of_income <= '$last_day_of_month'";
                    $res_income = $connection->query($chart_income);
                    
                    $chart_expense = "SELECT e.amount, e.date_of_expense, ec.name
                            FROM expenses e, expenses_category_assigned_to_users ec 
                            WHERE e.user_id = '$id' 
                            AND ec.id = e.expense_category_assigned_to_user_id 
                            AND date_of_expense >= '$first_day_of_month' 
                            AND date_of_expense <= '$last_day_of_month'";
                    $res_expense = $connection->query($chart_expense);
                    
                    $rows = $sum_result->fetch_assoc();
                    $_SESSION['sum_income'] = $rows['amount_sum'];
                }
    
                mysqli_free_result($sum_result);
                    
                $sum_result = $connection->query("SELECT SUM(amount) AS amount_sum FROM expenses WHERE user_id = '$id' AND date_of_expense >= '$first_day_of_month' AND date_of_expense <= '$last_day_of_month'");
                    
                $num_rows = $sum_result->num_rows;
                if($num_rows > 0){
                    
                    $rows = $sum_result->fetch_assoc();
                    $_SESSION['sum_expense'] = $rows['amount_sum'];
                }
                    
                $result_expense = mysqli_query($connection, $query_expense) or die("database error:". mysqli_error($connection));
                   
                $_SESSION['successful_expense'] = true;

                    } else {
                        throw new Exception($connection->error);
                    }
                }
                unset($_POST['month']);
                $connection->close();
                }

            } catch(Exception $e) {
            echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
            echo '<br />Informacja developerska: '.$e;
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
       <table id="editableTable" class="table table-bordered">
        <thead>
            <tr>
                <th>Kwota</th>
                <th>Data</th>
                <th>Kategoria</th>													
            </tr>
        </thead>
        <tbody>
            <?php 
            if (isset($_SESSION['successful_bilance'])) {
                
                while( $row = mysqli_fetch_assoc($result_income) ) { ?>
               <td><?php echo $row ['amount']; ?></td>
               <td><?php echo $row ['date_of_income']; ?></td>
               <td><?php echo $row ['name']; ?></td>				   				  
               </tr>
            <?php } 
        ?>
        <?php unset($_SESSION['successful_bilance']) ?>
    <?php } 
?>
           
        </tbody>
    </table> 
</div>
    <?php
    if (isset($_SESSION['sum_income'])) { ?>
       <h3>Suma przychodów: <?php echo $_SESSION['sum_income']; ?> zł</h3> 
    <?php }
    ?>
     <?php unset($_SESSION['sum_income']) ?>
</div>
    
<div class="container">
    <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Wydatki</h2></div>
                </div>
            </div>
       <table id="editableTable" class="table table-bordered">
        <thead>
            <tr>
                <th>Kwota</th>
                <th>Data</th>
                <th>Kategoria</th>													
            </tr>
        </thead>
        <tbody>
            <?php 
            if (isset($_SESSION['successful_expense'])) {
                
                 while( $row = mysqli_fetch_assoc($result_expense) ) { ?>
               <td><?php echo $row ['amount']; ?></td>
               <td><?php echo $row ['date_of_expense']; ?></td>
               <td><?php echo $row ['name']; ?></td>				   				  
               </tr>
            <?php } 
        ?>
        <?php unset($_SESSION['successful_expense']) ?>
    <?php } 
?>
           
        </tbody>
    </table> 
</div>
<?php
    if (isset($_SESSION['sum_expense'])) { ?>
       <h3>Suma wydatków: <?php echo $_SESSION['sum_expense']; ?> zł</h3> 
    <?php }
    ?>
     <?php unset($_SESSION['sum_expense']) ?>
</div>

  
<!--###############################-->
<!--diagram ########################-->
<!--###############################-->
  
    <div class="row">  
        <h4 style="text-align: center;">Struktura przychodów</h4>
        <div class="col-md-offset-4" id="piechart"></div>
    </div>

 <div class="row">  
        <h4 style="text-align: center;">Struktura wydatków</h4>
        <div class="col-md-offset-4" id="piechart2"></div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>   
    <script src="js/wlasny.js"></script>  
      
   <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['name', 'amount'],
            
        <?php
            while($row=$res_income->fetch_assoc()) {

                echo "['".$row['name']."',".$row['amount']."],";
            }
        ?>
         
        ]);

        var options = {
          //title: 'Struktura przychodów'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
          
        var data = google.visualization.arrayToDataTable([
          ['name', 'amount'],
            
        <?php
            while($row2=$res_expense->fetch_assoc()) {

                echo "['".$row2['name']."',".$row2['amount']."],";
            }
        ?>
         
        ]);

        var options = {
          //title: 'Struktura przychodów'
        };

        var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));

        chart2.draw(data, options);
      }
    </script>
  </body>
</html>