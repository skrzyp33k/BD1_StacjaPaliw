<?php
    require_once("./dbinfo.php");

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    mysqli_query($conn, "DELETE FROM Pracownicy WHERE ID_pracownika = ".$_POST['worker_id'].";");

    mysqli_query($conn, "DELETE FROM Adresy WHERE ID_adresu = ".$_POST['address_id'].";");

    mysqli_close($conn);

    header("Location: pracownicy.php");
?>