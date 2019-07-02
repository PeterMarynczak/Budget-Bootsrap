<?php

session_start();

if (isset($_SESSION['logged'])){
        header('Location: index.php');
    }

if (isset($_POST['email'])) {
    
    header ('Location: index.php');
    
    $everything_OK = true;
    
    $nick = $_POST['nick'];
    
    if ((strlen($nick) < 3) || (strlen($nick) > 20)) {
			$everything_OK = false;
			$_SESSION['e_nick'] = "Nick musi posiadać od 3 do 20 znaków!";
		}
    
    if (ctype_alnum($nick) == false) {
			$everything_OK = false;
			$_SESSION['e_nick'] = "Nick może składać się tylko z liter i cyfr (bez polskich znaków)";
		}
    
    $email = $_POST['email'];
    $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
    
    if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email)) {
        $everything_OK = false;
        $_SESSION['e_email'] = "Podaj poprawny adres e-mail!";
    }
    
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
		
    if ((strlen($pass1)<8) || (strlen($pass1)>20)) {
        $everything_OK = false;
        $_SESSION['e_pass']="Hasło musi posiadać od 8 do 20 znaków!";
    }

    if ($pass1!=$pass2) {
        $everything_OK = false;       
        $_SESSION['e_pass']= "Podane hasła nie są identyczne!";
    }		
    
    $pass_hash = password_hash($pass1, PASSWORD_DEFAULT);
    
    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);
    
    try {
        $connection = new mysqli($host, $db_user, $db_password, $db_name);
        
        if ($connection->connect_errno!=0) {
				throw new Exception(mysqli_connect_errno());
			} else {
            //if email exists
            $result = $connection->query("SELECT id FROM users WHERE email='$email'");
            
            if (!$result) throw new Exception($connection->error);
            
            $how_many_emails = $result->num_rows;
            if($how_many_emails>0) {
					$everything_OK = false;
					$_SESSION['e_email']="Istnieje już konto przypisane do tego adresu e-mail";
				}	
            
            //if login was reserved before
            $result = $connection->query("SELECT id FROM users WHERE username='$nick'");
            
            if (!$result) throw new Exception($connection->error);
            
            $how_many_nicks = $result->num_rows;
            if($how_many_nicks>0) {
					$everything_OK = false;
					$_SESSION['e_nick']="Istnieje już gracz o takim nicku! Wybierz inny";
				}	
            
            if ($everything_OK == true) {
                
                if ($connection->query("INSERT INTO users VALUES (NULL, '$nick', '$pass_hash', '$email')")) {
						$_SESSION['successful_reg']=true;
						header('Location: witamy.php');
					}
					else {
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







































