<?php
    session_start();

    if (!isset($_SESSION['logged'])){
        header('Location: index.php');
        exit();
    }

    if (isset($_POST['price'])) {
        
        $correctly_added_income = true;
        $id = $_SESSION['id'];
        
        $price = $_POST['price'];
        $price = str_replace(",",".",$price); 
        $price = round($price, 2);
        
        if ($price == 0) {
            $correctly_added_income = false;
            $_SESSION['e_price']= "Wprowadzona kwota nie jest liczbą";
        }
        
        $date = $_POST['date'];
        $category = $_POST['category'];
        $comment = $_POST['comment'];

        
    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);
        
    try {
        $connection = new mysqli($host, $db_user, $db_password, $db_name);
        
        if ($connection->connect_errno!=0) {
				throw new Exception(mysqli_connect_errno());
			} else {
            
            if ($correctly_added_income == true) {
                
                if ($connection->query("INSERT INTO incomes(user_id, income_category_assigned_to_user_id, amount, date_of_income, income_comment)
                                        SELECT u.id, i.id, '$price', '$date', '$comment'
                                        FROM users u, incomes_category_assigned_to_users i WHERE u.id = '$id' AND i.user_id = '$id' AND i.name = '$category'")) {
                    
                $_SESSION['successful_income'] = true;
                unset($_POST['price']);

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
 
<h3 id="subject">Dodaj przychód</h3>
<?php
    if (isset($_SESSION['successful_income'])) {
        echo '<h4 style="text-align: center; color: green">Przychód został dodany pomyślnie</h4>';
        unset($_SESSION['successful_income']);
        if (isset($_SESSION['e_price'])) unset($_SESSION['e_price']);
        
    }
?>
<div class="container">
    <div class="col-md-offset-2 col-md-8 col-lg-offset-1 col-lg-10">
        <!--action="test.php"-->
      <form method="post">
            <div class="form-group">
                <div class="row">
                  <label for="price" class="col-md-2">
                    Kwota:
                  </label>
                      <div class="col-md-10 input-group">
                        <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-usd"></span></span>
                        <input type="text" class="form-control" name="price" placeholder="Wprowadź kwotę przychodu" required>
                      </div>
<?php
    if (isset($_SESSION['e_price'])) {

        echo '<div class="error">'.$_SESSION['e_price'].'</div>';
        unset($_SESSION['e_price']);
    }
?>
                </div>
            </div>

            <div class="form-group">
            <div class="row">
              <label for="date" class="col-md-2">
            Data uzyskania:
              </label>
              <div class="col-md-10 input-group">
                <span class="input-group-addon" id="basic-addon2"><span class="glyphicon glyphicon-calendar"></span></span>
                <input class="form-control" type="text" id="date" name="date" placeholder="YYYY-MM-DD" required/>
                </div>
              </div>
            </div>  

      <div class="form-group">
        <div class="row">
          <h4 class="col-md-2">
            Kategoria:
          </h4>
          <div class="col-md-10">
            <label class="radio">
              <input type="radio" name="category" id="Salary" value="Wynagrodzenie" checked>
              Wynagrodzenie
            </label>
            <label class="radio">
              <input type="radio" name="category" id="Interest" value="Odsetki bankowe">
              Odsetki bankowe
            </label>
            <label class="radio">
              <input type="radio" name="category" id="Allegro" value="Allegro">
              Sprzedaż na Allegro
            </label>
            <label class="radio">
              <input type="radio" name="category" id="Another" value="Inne">
              Inne
            </label>
            </div>
          </div>
        </div>

        <div class="form-group shadow-textarea">
            <div class="row">
                <label for="comment" class="col-md-2 col-lg-2">Komentarz:</label>
                    <div class="col-md-10 col-lg-10">
                        <textarea class="form-control z-depth-1" name="comment" rows="1"></textarea>
                    </div>
                </div>
            </div>

        <div class="row">
          <div class="col-md-offset-2 col-md-10">
            <button type="submit" class="btn btn-success btn-sm">
              Dodaj
            </button>
            <button type="reset" class="btn btn-danger btn-sm">
              Anuluj
            </button>
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