<?php
    require_once("./dbinfo.php");

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    mysqli_query($conn, "DELETE FROM Paliwa WHERE ID_paliwa = ".$_POST['fuel_id'].";");

    mysqli_close($conn);

    header("Location: paliwa.php");
?>