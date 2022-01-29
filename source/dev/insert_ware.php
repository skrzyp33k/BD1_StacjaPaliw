<?php
    if($_POST['nameInput'] != "" && $_POST['priceInput'] != "" && $_POST['typeInput'] != "" && $_POST['codeInput'] && $_POST['descriptionInput'] != "" && $_POST['taxInput'] != "")
    {
        require_once("dbinfo.php");

        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

        $query =  "INSERT INTO Towary(nazwa, cena, rodzaj, kod, opis, vat) VALUES ('".$_POST['nameInput']."',".$_POST['priceInput'].",'".$_POST['typeInput']."','".$_POST['codeInput']."','".$_POST['descriptionInput']."',".$_POST['taxInput'].");";
        
        mysqli_query($conn, $query);

        mysqli_close($conn);
    }
    header("Location: towary.php");
?>