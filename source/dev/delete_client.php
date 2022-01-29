<?php
    require_once("./dbinfo.php");

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    mysqli_query($conn, "DELETE FROM Klienci WHERE ID_klienta = ".$_POST['client_id'].";");

    mysqli_query($conn, "DELETE FROM Adresy WHERE ID_adresu = ".$_POST['address_id'].";");

    mysqli_close($conn);

    header("Location: klienci.php");
?>