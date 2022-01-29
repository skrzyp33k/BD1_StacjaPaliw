<?php
    require_once("dbinfo.php");
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    $query = "INSERT INTO Faktury VALUES(null, null,".$_POST['orderSelect'].", ".$_POST['clientSelect'].", ".$_POST['workerSelect'].");";

    mysqli_query($conn, $query);

    mysqli_close($conn);

    header("Location: faktury.php");
?>