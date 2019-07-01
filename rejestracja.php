<?php

session_start();

if (isset($_POST['email'])) {
    
    header ('Location: index.php');
    
    $everything_OK = true;
    
    $nick = $_POST['nick'];
    
    if ((strlen($nick)<3) || (strlen($nick)>20)) {
        
			$everything_OK = false;
			$_SESSION['e_nick'] = "Nick musi posiadać od 3 do 20 znaków!";
		}
    
    if (ctype_alnum($nick)==false) {
        
			$everything_OK=false;
			$_SESSION['e_nick']="Nick może składać się tylko z liter i cyfr (bez polskich znaków)";
		}
    
    
    
    if ($everything_OK == true) {
        
       echo "Udana walidacja"; exit();
    }
    
}

?>
