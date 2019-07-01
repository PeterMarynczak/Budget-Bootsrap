<?php

session_start();

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
    
    $pass1 = $_POST['$pass1'];
    $pass2 = $_POST['$pass2'];
    
    if ((strlen($pass1) < 8) || (strlen($pass1) > 20)) {
			$everything_OK = false;
			$_SESSION['e_haslo'] = "Hasło musi posiadać od 8 do 20 znaków!";
		}
    
    if ($pass1 != $pass2) {
			$everything_OK = false;
			$_SESSION['e_haslo'] = "Podane hasła nie są identyczne!";
		}	
    
    if ($everything_OK == true) {
        
       echo "Udana walidacja"; exit();
    }
    
}

?>
