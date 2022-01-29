<?php
    if($_POST['streetInput'] != "" && $_POST['buildingInput'] != "" && $_POST['postalInput'] != "" && $_POST['cityInput'] != "" && $_POST['countryInput'] != "" && $_POST['nameInput'] != "" && $_POST['surnameInput'] != "" && $_POST['phoneInput'] != "" && $_POST['phoneInput'] != "" && $_POST['bankInput'] != "")
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

        $query = "UPDATE Klienci SET nazwisko = '".$_POST['surnameInput']."', imie = '".$_POST['nameInput']."', telefon = '".$_POST['phoneInput']."', nr_rachunku = '".$_POST['bankInput']."' WHERE ID_klienta = ".$_POST['clientID'].";";

        mysqli_query($conn, $query);

        mysqli_close($conn);
    }
    header("Location: klienci.php");
?>