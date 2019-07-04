<?php
    session_start();

    if (!isset($_SESSION['logged'])){
        header('Location: przychod.php');
        exit();
    }

    if (isset($_POST['price'])) {
        
        $correctly_added_income = true;
        
        $price = $_POST['price'];
        $price = str_replace(",",".",$price); 
        $price = round($price, 2);
        
        if (!is_int($price)) {
            $correctly_added_income = false;
            $_SESSION['e_price']= "Wprowadzona kwota nie jest liczbą";
            exit();
        }
        
        echo $price."<br/>";
        
        $date = $_POST['date'];
        echo $date."<br/>";
        
        $category = $_POST['category'];
        echo $category."<br/>";
        
        $comment = $_POST['comment'];
        echo $comment."<br/>";
    }

    
?>