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

    $query =  "INSERT INTO Adresy(ulica,nr_domu,nr_mieszkania,kod_pocztowy,miasto,kraj) VALUES ('".$_POST['streetInput']."','".$_POST['buildingInput']."',".$flat_nr.",'".$_POST['postalInput']."','".$_POST['cityInput']."','".$_POST['countryInput']."');";

    mysqli_query($conn, $query);

    $id_addr = mysqli_insert_id($conn);

    $query = "INSERT INTO Dostawcy(nazwa, telefon, email, ID_adresu) VALUES ('".$_POST['nameInput']."','".$_POST['phoneInput']."','".$_POST['emailInput']."',".$id_addr.");";

    mysqli_query($conn,$query);

    mysqli_close($conn);
}
    header("Location: dostawcy.php");
?>