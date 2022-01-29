<?php
    if($_POST['nameInput'] != "" && $_POST['priceInput'] != "" && $_POST['typeInput'] != "" && $_POST['codeInput'] && $_POST['descriptionInput'] != "" && $_POST['taxInput'] != "")
    {
        require_once("dbinfo.php");

        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name); 
        
        $desc = "NULL";

        if($_POST['descriptionInput'] != "")
        {
            $desc = "'".$_POST['descriptionInput']."'";
        }

        $query = "UPDATE Towary SET nazwa = '".$_POST['nameInput']."', cena = ".$_POST['priceInput'].", rodzaj = '".$_POST['typeInput']."', kod = '".$_POST['codeInput']."', opis = ".$desc.", vat = ".$_POST['taxInput']." WHERE ID_towaru = ".$_POST['wareID'].";";

        mysqli_query($conn, $query);

        mysqli_close($conn);
    }
    header("Location: towary.php");
?>