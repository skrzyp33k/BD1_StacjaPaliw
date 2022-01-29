<?php
    require_once("dbinfo.php");

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    $query = "INSERT INTO Dostawy(ID_dostawcy, rejestracja_samochodu, data_dostawy, ID_pracownika) VALUES (".$_POST['providerSelect'].",'".$_POST['licenseInput']."', '".$_POST['dateInput']."',".$_POST['workerSelect'].");";

    mysqli_query($conn, $query);

    mysqli_close($conn);

    header("Location: dostawy.php");
?>