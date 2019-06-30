<?php
    
    session_start();

    if ((!isset($_POST['login'])) || (!isset($_POST['password']))) {
        header ('Location: index.php');
        exit();
    }

    require_once "connect.php"; 

    $connection = @new mysqli($host,$db_user,$db_password,$db_name);

    if ($connection->connect_errno!=0){
        
        echo "Error: ".$connection->connect_errno;
        
    } else {
        
        $login = $_POST['login'];
        $password = $_POST['password'];
        
        $login = htmlentities($login, ENT_QUOTES, "UTF-8");
		$password = htmlentities($password, ENT_QUOTES, "UTF-8");
        
        if ($result = @$connection->query(
        sprintf("SELECT * FROM users WHERE username='%s' AND password='%s'",
        mysqli_real_escape_string($connection,$login),
		mysqli_real_escape_string($connection,$password)))) {
            
            $users_amount = $result->num_rows;
            if($users_amount > 0) {
                
                $_SESSION['logged'] = true;
                
                $row = $result->fetch_assoc();
                $_SESSION['user'] = $row['username'];
                $_SESSION['id'] = $row['id'];
                
                
                unset($_SESSION[error]);
                $result->free_result();
                header('Location: menu.php');
                
            } else {
                
                $_SESSION['error'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
                header('Location: index.php');
            }
        }

        $connection->close();
    }

?>