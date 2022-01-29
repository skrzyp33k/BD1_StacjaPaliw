<?php
    if($_POST['nameInput'] != "" && $_POST['priceInput'] != "" && $_POST['typeInput'] != "" && $_POST['descriptionInput'] != "" && $_POST['taxInput'] != "")
    {
        require_once("dbinfo.php");

        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

        $query =  "INSERT INTO Paliwa(nazwa, cena_litr, rodzaj, opis, vat) VALUES ('".$_POST['nameInput']."',".$_POST['priceInput'].",'".$_POST['typeInput']."','".$_POST['descriptionInput']."',".$_POST['taxInput'].");";
        
        mysqli_query($conn, $query);

        mysqli_close($conn);
    }
    header("Location: paliwa.php");
?>