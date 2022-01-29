<?php
    require_once("./dbinfo.php");

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    mysqli_query($conn, "DELETE FROM Towary WHERE ID_towaru = ".$_POST['ware_id'].";");

    mysqli_close($conn);

    header("Location: towary.php");
?>