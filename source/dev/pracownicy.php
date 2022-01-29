<!DOCTYPE HTML>
<html lang="pl">

<head>
  <meta charset="UTF-8" />

  <title>GBS - Pracownicy</title>

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
          <li><a href="./pracownicy.php" class="nav-link px-2 text-black">Pracownicy</a></li>
          <li><a href="./klienci.php" class="nav-link px-2 text-white">Klienci</a></li>
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
    <div class="container">
      <div class="h1">Lista pracowników</div>
      <?php
      require_once("dbinfo.php");
      $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
      if($conn)
      {
        $query = mysqli_query($conn, "SELECT Pracownicy.ID_pracownika AS ID_Pracownika, Adresy.ID_adresu AS ID_adresu, Pracownicy.stanowisko AS Stanowisko, Pracownicy.Imie AS Imie, Pracownicy.nazwisko AS Nazwisko, Pracownicy.telefon AS Telefon, Pracownicy.nr_rachunku AS Nr_rachunku, Pracownicy.wyplata AS Wyplata, Adresy.ulica AS Ulica, Adresy.nr_domu AS Nr_domu, Adresy.nr_mieszkania AS Nr_mieszkania, Adresy.kod_pocztowy AS Kod_pocztowy, Adresy.miasto AS Miasto, Adresy.kraj AS Kraj FROM Pracownicy NATURAL JOIN Adresy;");
        $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
        echo '<table class="result_table container-fluid">';
        echo '<tr><th>Stanowisko</th><th>Imię</th><th>Nazwisko</th><th>Telefon</th><th>Numer rachunku</th><th>Wypłata</th><th>Ulica</th><th>Numer budynku</th><th>Numer mieszkania</th><th>Kod pocztowy</th><th>Miasto</th><th>Kraj</th><th>Akcje</th></tr>';
        foreach($result as $row)
        {
          $count = 0;
          $worker_id = -1;
          $address_id = -1;
          echo '<tr>';
          foreach($row as $cell)
          {
            $count++;
            if($count == 1)
            {
              $worker_id = $cell;
            }
            else if($count == 2)
            {
              $address_id = $cell;
            }
            else
            {
              echo '<td>';
              echo $cell;
              echo '</td>';
            }
          }
          echo '<td>';
          echo<<<END
          <table class="button_table"><tr>
          <td>
          <form method="POST" action="./edit_worker.php" >
          <input type="hidden" name="worker_id" value="$worker_id"/>
          <input type="hidden" name="address_id" value="$address_id"/>
          <button type="submit" class="btn btn-primary"><img class="btn_icon" src="../img/pencil.png"/></button>
          </form>
          </td>
          <td>
          <form method="POST" action="./delete_worker.php" >
          <input type="hidden" name="worker_id" value="$worker_id"/>
          <input type="hidden" name="address_id" value="$address_id"/>
          <button type="submit" class="btn btn-primary"><img class="btn_icon" src="../img/trash.png"/></button>
          </form>
          </td>
          </tr></table>
          END;
          echo '</td>';
          echo '</tr>';
        }
        echo '</table>';
        mysqli_close($conn);
      }
      else
      {
        echo '<h1>Błąd łączenia się z bazą danych!!!!</h1>';
      }
    ?>
    </div>
  <hr/>
    <div class="container">
      <div class="h1">Dodawanie pracownika</div>
      <form method="POST" action="insert_worker.php">
        <div class="form-group">
        <div class="form-group">
          <label for="positionInput">Stanowisko</label>
          <input type="text" class="form-control" id="positionInput" name="positionInput" value="" maxlength="30"/>
        </div>
          <label for="nameInput">Imię</label>
          <input type="text" class="form-control" id="nameInput" name="nameInput" value="" maxlength="30" />
        </div>
        <div class="form-group">
          <label for="surnameInput">Nazwisko</label>
          <input type="text" class="form-control" id="surnameInput" name="surnameInput" value="" maxlength="40"/>
        </div>
        <div class="form-group">
          <label for="phoneInput">Numer telefonu</label>
          <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control" id="phoneInput" name="phoneInput" value="" maxlength="12"/>
        </div>
        <div class="form-group">
          <label for="bankInput">Numer konta bankowego</label>
          <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control" id="bankInput" name="bankInput" value="" maxlength="26"/>
        </div>
        <div class="form-group">
          <label for="salaryInput">Wyplata</label>
          <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control" id="salaryInput" name="salaryInput" value="" maxlength="8"/>
        </div>
        <div class="form-group">
          <label for="streetInput">Ulica</label>
          <input type="text" class="form-control" id="streetInput" name="streetInput" value="" maxlength="50"/>
        </div>
        <div class="form-group">
          <label for="buildingInput">Numer budynku</label>
          <input type="text" class="form-control" id="buildingInput" name="buildingInput" value="" maxlength="5"/>
        </div>
        <div class="form-group">
          <label for="flatInput">Numer mieszkania</label>
          <input type="text" class="form-control" id="flatInput" name="flatInput" value="" maxlength="5"/>
        </div>
        <div class="form-group">
          <label for="postalInput">Kod pocztowy</label>
          <input type="text" class="form-control" id="postalInput" name="postalInput" value="" maxlength="6"/>
        </div>
        <div class="form-group">
          <label for="cityInput">Miasto</label>
          <input type="text" class="form-control" id="cityInput" name="cityInput" value="" maxlength="30"/>
        </div>
        <div class="form-group">
          <label for="countryInput">Kraj</label>
          <input type="text" class="form-control" id="countryInput" name="countryInput" value="" maxlength="20"/>
        </div>
        <button type="submit" class="btn btn-primary">Dodaj</button>
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