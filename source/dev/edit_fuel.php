<?php
    require_once("dbinfo.php");

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    $query_fuel = mysqli_query($conn, "SELECT * FROM Paliwa WHERE ID_paliwa = ".$_POST['fuel_id'].";");

    $result_fuel = mysqli_fetch_all($query_fuel, MYSQLI_ASSOC);

    mysqli_close($conn);
?>
<!DOCTYPE HTML>
<html lang="pl">

<head>
  <meta charset="UTF-8" />

  <title>GBS - Edycja paliwa</title>

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
        <li><a href="./index.php" class="nav-link px-2 text-white">Strona główna</a></li>
          <li><a href="./pracownicy.php" class="nav-link px-2 text-white">Pracownicy</a></li>
          <li><a href="./klienci.php" class="nav-link px-2 text-white">Klienci</a></li>
          <li><a href="./dostawcy.php" class="nav-link px-2 text-white">Dostawcy</a></li>
          <li><a href="./towary.php" class="nav-link px-2 text-white">Towary</a></li>
          <li><a href="./uslugi.php" class="nav-link px-2 text-white">Usługi</a></li>
          <li><a href="./paliwa.php" class="nav-link px-2 text-black">Paliwa</a></li>
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
    <h1>Edytuj paliwo</h1>
    <div class="container">
      <form method="POST" action="update_fuel.php">
        <div class="form-group">
          <label for="nameInput">Nazwa</label>
          <input type="text" class="form-control" id="nameInput" name="nameInput" value="<?php echo $result_fuel[0]['nazwa']; ?>" maxlength="20"/>
        </div>
        <div class="form-group">
          <label for="priceInput">Cena za litr</label>
          <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control" id="priceInput" name="priceInput" value="<?php echo $result_fuel[0]['cena_litr']; ?>" maxlength="5" />
        </div>
        <div class="form-group">
          <label for="typeInput">Rodzaj</label>
          <input type="text" class="form-control" id="typeInput" name="typeInput" value="<?php echo $result_fuel[0]['rodzaj']; ?>" maxlength="15" />
        </div>
        <div class="form-group">
          <label for="descriptionInput">Opis</label>
          <input type="text" class="form-control" id="descriptionInput" name="descriptionInput" value="<?php echo $result_fuel[0]['opis']; ?>" maxlength="100"/>
        </div>
        <div class="form-group">
          <label for="taxInput">% Vat</label>
          <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control" id="taxInput" name="taxInput" value="<?php echo $result_fuel[0]['vat']; ?>" maxlength="2"/>
        </div>
        <input type="hidden" name="fuelID" value="<?php echo $_POST['fuel_id']; ?>" />
        <button type="submit" class="btn btn-primary">Edytuj</button>
      </form>
    </div>
  </main>
  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <div class="col-md-4 d-flex align-items-center">
      <span class="text-muted">&copy; 2022 GBS, Wszelkie prawa zastrzeżone</span>
    </div>
  </footer>
</body>

</html>