<?php
    require_once("./dbinfo.php");

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    mysqli_query($conn, "DELETE FROM Uslugi WHERE ID_uslugi = ".$_POST['service_id'].";");

    mysqli_close($conn);

    header("Location: uslugi.php");
?>