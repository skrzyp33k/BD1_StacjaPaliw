<!DOCTYPE HTML>
<html lang="pl">

<head>
  <meta charset="UTF-8" />

  <title>GBS - Dostawy</title>

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
          <li><a href="./paliwa.php" class="nav-link px-2 text-white">Paliwa</a></li>
          <li><a href="./zlecenia.php" class="nav-link px-2 text-white">Zlecenia</a></li>
          <li><a href="./dostawy.php" class="nav-link px-2 text-black">Dostawy</a></li>
          <li><a href="./paragony.php" class="nav-link px-2 text-white">Paragony</a></li>
          <li><a href="./faktury.php" class="nav-link px-2 text-white">Faktury</a></li>
          <li><a href="./inne.php" class="nav-link px-2 text-white">Inne zestawienia</a></li>
        </ul>
      </div>
    </div>
  </header>
  <main class="container">
    <div class="container">
      <h1>Lista zrealizowanych dostaw</h1>
    <?php
      require_once("dbinfo.php");
      $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
      if($conn)
      {
        $query = mysqli_query($conn, "SELECT nazwa, telefon, email, rejestracja_samochodu, nazwisko, imie, data_dostawy FROM Dostawy_Widok ORDER BY data_dostawy DESC;");
        $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
        echo '<table class="result_table">';
        echo '<tr>';
        echo '<th>Nazwa dostawcy</th><th>Telefon</th><th>E-Mail</th><th>Rejestracja samochodu</th><th>Nazwisko</th><th>Imię</th><th>Data dostawy</th>';
        echo '</tr>';
        foreach($result as $row)
        {
          echo '<tr>';
          foreach($row as $cell)
          {
            echo '<td>';
            echo $cell;
            echo '</td>';
          }
          echo '</tr>';
        }
        echo '</table>';
      }
      else
      {
        echo 'Błąd łączenia z bazą!!!';
      }
    ?>
    </div>
    <div class="container">
      <h1>Dodawanie dostawy</h1>
      <form method="POST" action="delivery_insert.php">
      <label for="providerSelect">Dostawca</label>
          <select class="form-select" aria-label="Dostawca" name="providerSelect" id="providerSelect">
          <?php          
                  $query = mysqli_query($conn,'SELECT ID_dostawcy AS ID, nazwa AS Dostawca FROM Dostawcy;');
          
                  $providers = mysqli_fetch_all($query, MYSQLI_ASSOC);

                  $count = 0;

                  foreach($providers as $row)
                  {
                    echo '<option value="'.$row['ID'].'"';
                    if($count == 0)
                    {
                      echo ' selected';
                      $count++;
                    }
                    echo '>';
                    echo $row['Dostawca'];
                    echo '</option>';
                  }

                  $count = 0;
          ?>
        </select>
          <label for="workerSelect">Kierownik</label>
                  <select class="form-select" aria-label="Kierownik" name="workerSelect" id="workerSelect">
                  <?php
                  $query = mysqli_query($conn, 'SELECT ID_pracownika AS ID, CONCAT(imie," ",nazwisko) AS Pracownik FROM Pracownicy WHERE stanowisko = "Kierownik";');
          
                  $workers = mysqli_fetch_all($query, MYSQLI_ASSOC);

                  mysqli_close($conn);

                  $count = 0;

                  foreach($workers as $row)
                  {
                    echo '<option value="'.$row['ID'].'"';
                    if($count == 0)
                    {
                      echo ' selected';
                      $count++;
                    }
                    echo '>';
                    echo $row['Pracownik'];
                    echo '</option>';
                  }
                  ?>
                </select>
                <div class="form-group">
          <label for="licenseInput">Rejestracja samochodu</label>
          <input type="text" class="form-control" id="licenseInput" name="licenseInput" value="" maxlength="10"/>
        </div>
        <div class="form-group">
          <label for="dateInput">Data</label>
          <input type="date" class="form-control" id="dateInput" name="dateInput" value="" />
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