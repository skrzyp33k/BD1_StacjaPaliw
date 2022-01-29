<?php
    if($_POST['streetInput'] != "" && $_POST['buildingInput'] != "" && $_POST['postalInput'] != "" && $_POST['cityInput'] != "" && $_POST['countryInput'] != "" && $_POST['nameInput'] != "" && $_POST['phoneInput'] != "" && $_POST['emailInput'] != "")
    {
        require_once("dbinfo.php");

        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

        $flat_nr = "NULL";

        if($_POST['flatInput'] != "")
        {
            $flat_nr = $_POST['flatInput'];
        }

        $query = "UPDATE Adresy SET kraj = '".$_POST['countryInput']."' , miasto = '".$_POST['cityInput']."' , kod_pocztowy = '".$_POST['postalInput']."', ulica = '".$_POST['streetInput']."', nr_domu = '".$_POST['buildingInput']."', nr_mieszkania = ".$flat_nr." WHERE ID_adresu = ".$_POST['addressID'].";";

        mysqli_query($conn, $query);

        $query = "UPDATE Dostawcy SET nazwa = '".$_POST['nameInput']."', telefon = '".$_POST['phoneInput']."', email = '".$_POST['emailInput']."' WHERE ID_dostawcy = ".$_POST['providerID'].";";

        mysqli_query($conn, $query);

        mysqli_close($conn);
    }
    header("Location: dostawcy.php");
?>