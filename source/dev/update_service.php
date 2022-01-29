<?php
    if($_POST['nameInput'] != "" && $_POST['priceInput'] != "" && $_POST['descriptionInput'] != "" && $_POST['taxInput'] != "")
    {
        require_once("dbinfo.php");

        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name); 

        $query = "UPDATE Uslugi SET nazwa = '".$_POST['nameInput']."', cena = ".$_POST['priceInput'].", opis = '".$_POST['descriptionInput']."', vat = ".$_POST['taxInput']." WHERE ID_uslugi = ".$_POST['serviceID'].";";

        mysqli_query($conn, $query);

        mysqli_close($conn);
    }
    header("Location: uslugi.php");
?>