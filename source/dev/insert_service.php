<?php
    if($_POST['nameInput'] != "" && $_POST['priceInput'] != "" && $_POST['descriptionInput'] != "" && $_POST['taxInput'] != "")
    {
        require_once("dbinfo.php");

        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

        $query =  "INSERT INTO Uslugi(nazwa, cena, opis, vat) VALUES ('".$_POST['nameInput']."',".$_POST['priceInput'].",'".$_POST['descriptionInput']."',".$_POST['taxInput'].");";
        
        mysqli_query($conn, $query);

        mysqli_close($conn);
    }
    header("Location: uslugi.php");
?>