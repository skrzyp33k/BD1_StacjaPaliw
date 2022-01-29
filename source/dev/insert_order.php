<?php
    require_once("dbinfo.php");
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    $paliwa_count = mysqli_fetch_all(mysqli_query($conn,"SELECT COUNT(*) FROM Paliwa;"),MYSQLI_ASSOC)[0]['COUNT(*)'];

    $towary_count = mysqli_fetch_all(mysqli_query($conn,"SELECT COUNT(*) FROM Towary;"),MYSQLI_ASSOC)[0]['COUNT(*)'];

    $uslugi_count = mysqli_fetch_all(mysqli_query($conn,"SELECT COUNT(*) FROM Uslugi;"),MYSQLI_ASSOC)[0]['COUNT(*)'];

    $execute = -1;

    for($i = 1; $i <= $paliwa_count; $i++)
    {
        if(!$_POST['fuelInput_'.$i] == "" && !doubleval($_POST['fuelInput_'.$i]) <= 0)
        {
            $execute = 0;
            break;
        }
    }

    if($execute == -1)
    {
        for($i = 1; $i <= $towary_count; $i++)
        {
            if(!$_POST['wareInput_'.$i] == "" && !intval($_POST['wareInput_'.$i]) <= 0)
            {
                $execute = 0;
                break;
            }
        }
    }

    if($execute == -1)
    {
        for($i = 1; $i <= $uslugi_count; $i++)
        {
            if(!$_POST['serviceInput_'.$i] == "" && !intval($_POST['serviceInput_'.$i]) <= 0)
            {
                $execute = 0;
                break;
            }
        }
    }

    if($execute == 0)
    {
        mysqli_query($conn,"INSERT INTO Zlecenia VALUES(null,null);");

        $last_order = mysqli_insert_id($conn);
    
        for($i = 1; $i <= $paliwa_count; $i++)
        {
            if(!$_POST['fuelInput_'.$i] == "" && !doubleval($_POST['fuelInput_'.$i]) <= 0)
            {
                $query = 'INSERT INTO ZleceniaPaliwa VALUES (null, '.$last_order.', '.$i.', '.$_POST['fuelInput_'.$i].');';
                mysqli_query($conn, $query);
            }
        }
    
        for($i = 1; $i <= $towary_count; $i++)
        {
            if(!$_POST['wareInput_'.$i] == "" && !intval($_POST['wareInput_'.$i]) <= 0)
            {
                $query = 'INSERT INTO ZleceniaTowary VALUES (null, '.$last_order.', '.$i.', '.intval($_POST['wareInput_'.$i]).');';
                mysqli_query($conn, $query);
            }
        }
    
        for($i = 1; $i <= $uslugi_count; $i++)
        {
            if(!$_POST['serviceInput_'.$i] == "" && !intval($_POST['serviceInput_'.$i]) <= 0)
            {
                $query = 'INSERT INTO ZleceniaUslugi VALUES (null, '.$last_order.', '.$i.', '.intval($_POST['serviceInput_'.$i]).');';
                mysqli_query($conn, $query);
            }
        }
    
        mysqli_close($conn);
    }

    header("Location: zlecenia.php");
?>