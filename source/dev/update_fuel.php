<?php
    if($_POST['nameInput'] != "" && $_POST['priceInput'] != "" && $_POST['typeInput'] != "" && $_POST['descriptionInput'] != "" && $_POST['taxInput'] != "")
    {
        require_once("dbinfo.php");

        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name); 

        $query = "UPDATE Paliwa SET nazwa = '".$_POST['nameInput']."', cena_litr = ".$_POST['priceInput'].", rodzaj = '".$_POST['typeInput']."', opis = '".$_POST['descriptionInput']."', vat = ".$_POST['taxInput']." WHERE ID_paliwa = ".$_POST['fuelID'].";";

        mysqli_query($conn, $query);

        mysqli_close($conn);
    }
    header("Location: paliwa.php");
?>