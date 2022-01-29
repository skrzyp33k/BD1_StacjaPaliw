<?php
    require_once("dbinfo.php");

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    $query_client = mysqli_query($conn, "SELECT * FROM Klienci WHERE ID_klienta = ".$_POST['client_id'].";");
    $query_address = mysqli_query($conn, "SELECT * FROM Adresy WHERE ID_adresu = ".$_POST['address_id'].";");

    $result_client = mysqli_fetch_all($query_client, MYSQLI_ASSOC);
    $result_address = mysqli_fetch_all($query_address, MYSQLI_ASSOC);

    mysqli_close($conn);
?>
<!DOCTYPE HTML>
<html lang="pl">

<head>
    <meta charset="UTF-8" />

    <title>GBS - Edycja klienta</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/main.css" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

    <script src="../js/main.js"></script>

    <link rel="icon" type="image/png" href="../img/gbs.png">
</head>

<body>
<header class="menuBarDev p-3" style="background-color: rgb(88,101,242);">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      <a href="../" style="height: 64px;"><img src="../img/gbs.png" class="img-fluid" style="height: 64px;"/></a>
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="../index.php" class="nav-link px-2 text-white">Strona główna</a></li>
          <li><a href="../pracownicy.php" class="nav-link px-2 text-white">Pracownicy</a></li>
          <li><a href="./klienci.php" class="nav-link px-2 text-black">Klienci</a></li>
          <li><a href="./dostawcy.php" class="nav-link px-2 text-white">Dostawcy</a></li>
          <li><a href="./towary.php" class="nav-link px-2 text-white">Towary</a></li>
          <li><a href="./uslugi.php" class="nav-link px-2 text-white">Usługi</a></li>
          <li><a href="./paliwa.php" class="nav-link px-2 text-white">Paliwa</a></li>
          <li><a href="./zlecenia.php" class="nav-link px-2 text-white">Zlecenia</a></li>
          <li><a href="./dostawy.php" class="nav-link px-2 text-white">Dostawy</a></li>
          <li><a href="./paragony.php" class="nav-link px-2 text-white">Paragony</a></li>
          <li><a href="./faktury.php" class="nav-link px-2 text-white">Faktury</a></li>
          <li><a href="./inne.php" class="nav-link px-2 text-white">Inne zestawienia</a></li>
        </ul>
            </div>
        </div>
    </header>
    <main class="container">
    <div class="h1">Edytuj klienta</div>
        <form method="POST" action="update_client.php">
            <div class="form-group">
                <label for="nameInput">Imię</label>
                <input type="text" class="form-control" id="nameInput" name="nameInput" value="<?php echo $result_client[0]['imie']; ?>" maxlength="30"/>
            </div>
            <div class="form-group">
                <label for="surnameInput">Nazwisko</label>
                <input type="text" class="form-control" id="surnameInput" name="surnameInput" value="<?php echo $result_client[0]['nazwisko']; ?>" maxlength="40"/>
            </div>
            <div class="form-group">
                <label for="phoneInput">Numer telefonu</label>
                <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control" id="phoneInput" name="phoneInput" value="<?php echo $result_client[0]['telefon']; ?>" maxlength="12"/>
            </div>
            <div class="form-group">
                <label for="bankInput">Numer konta bankowego</label>
                <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control" id="bankInput" name="bankInput" value="<?php echo $result_client[0]['nr_rachunku']; ?>" maxlength="26"/>
            </div>
            <div class="form-group">
                <label for="streetInput">Ulica</label>
                <input type="text" class="form-control" id="streetInput" name="streetInput" value="<?php echo $result_address[0]['ulica']; ?>" maxlength="50"/>
            </div>
            <div class="form-group">
                <label for="buildingInput">Numer budynku</label>
                <input type="text" class="form-control" id="buildingInput" name="buildingInput" value="<?php echo $result_address[0]['nr_domu']; ?>" maxlength="5"/>
            </div>
            <div class="form-group">
                <label for="flatInput">Numer mieszkania</label>
                <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control" id="flatInput" name="flatInput" value="<?php echo $result_address[0]['nr_mieszkania']; ?>" maxlength="5"/>
            </div>
            <div class="form-group">
                <label for="postalInput">Kod pocztowy</label>
                <input type="text" class="form-control" id="postalInput" name="postalInput" value="<?php echo $result_address[0]['kod_pocztowy']; ?>" maxlength="6"/>
            </div>
            <div class="form-group">
                <label for="cityInput">Miasto</label>
                <input type="text" class="form-control" id="cityInput" name="cityInput" value="<?php echo $result_address[0]['miasto']; ?>" maxlength="30"/>
            </div>
            <div class="form-group">
                <label for="countryInput">Kraj</label>
                <input type="text" class="form-control" id="countryInput" name="countryInput" value="<?php echo $result_address[0]['kraj']; ?>" maxlength="20"/>
            </div>
            <input type="hidden" name="clientID" value="<?php echo $_POST['client_id']; ?>"/>
            <input type="hidden" name="addressID" value="<?php echo $_POST['address_id']; ?>"/>
            <button type="submit" class="btn btn-primary">Edytuj</button>
        </form>
    </main>
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <div class="col-md-4 d-flex align-items-center">
      <span class="text-muted">&copy; 2022 GBS, Wszelkie prawa zastrzeżone</span>
    </div>
  </footer>
</body>

</html>