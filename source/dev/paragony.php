<!DOCTYPE HTML>
<html lang="pl">

<head>
  <meta charset="UTF-8" />

  <title>GBS - Paragony</title>

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
          <li><a href="./dostawy.php" class="nav-link px-2 text-white">Dostawy</a></li>
          <li><a href="./paragony.php" class="nav-link px-2 text-black">Paragony</a></li>
          <li><a href="./faktury.php" class="nav-link px-2 text-white">Faktury</a></li>
          <li><a href="./inne.php" class="nav-link px-2 text-white">Inne zestawienia</a></li>
        </ul>
      </div>
    </div>
  </header>
  <main class="container">
    <div class="container">
    <?php
      require_once("dbinfo.php");
      $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
      $query = "SELECT * FROM Paragony NATURAL JOIN Pracownicy";
      $result = mysqli_query($conn, $query);
      $table = mysqli_fetch_all($result, MYSQLI_ASSOC);
      foreach($table as $row)
      {
        echo '<h4>';
        echo 'ID: '.$row['nr_paragonu'];
        echo ' Data: '.$row['data_wystawienia'];
        echo ' Wystawił/a: '.$row['imie'].' '.$row['nazwisko'];
        echo '</h4>';
        echo '<table class="result_table">';
        $query2 = "SELECT Paliwa.nazwa AS Nazwa, Paliwa.cena_litr AS Cena, ZleceniaPaliwa.ilosc AS Ilosc, ROUND(ZleceniaPaliwa.ilosc * Paliwa.cena_litr,2) AS WartoscNetto,  ROUND(ZleceniaPaliwa.ilosc * Paliwa.cena_litr * (1+(Paliwa.vat)/100),2) AS WartoscBrutto,  ROUND(ZleceniaPaliwa.ilosc * Paliwa.cena_litr * ((Paliwa.vat)/100),2) AS Vat FROM ZleceniaPaliwa NATURAL JOIN Paliwa WHERE ID_zlecenia = ".$row['ID_zlecenia']." 
        UNION
        SELECT Towary.nazwa AS Nazwa, Towary.cena AS Cena, ZleceniaTowary.ilosc AS Ilosc, ROUND(ZleceniaTowary.ilosc * Towary.cena,2) AS WartoscNetto,  ROUND(ZleceniaTowary.ilosc * Towary.cena * (1+(Towary.vat)/100),2) AS WartoscBrutto,  ROUND(ZleceniaTowary.ilosc * Towary.cena * ((Towary.vat)/100),2) AS Vat FROM ZleceniaTowary NATURAL JOIN Towary WHERE ID_zlecenia = ".$row['ID_zlecenia']." 
        UNION
        SELECT Uslugi.nazwa AS Nazwa, Uslugi.cena AS Cena, ZleceniaUslugi.ilosc AS Ilosc, ROUND(ZleceniaUslugi.ilosc * Uslugi.cena,2) AS WartoscNetto,  ROUND(ZleceniaUslugi.ilosc * Uslugi.cena * (1+(Uslugi.vat)/100),2) AS WartoscBrutto,  ROUND(ZleceniaUslugi.ilosc * Uslugi.cena * ((Uslugi.vat)/100),2) AS Vat FROM ZleceniaUslugi NATURAL JOIN Uslugi WHERE ID_zlecenia = ".$row['ID_zlecenia'].";";
        $result2 = mysqli_query($conn, $query2);
        $table2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);
        echo '<tr><th>Nazwa</th><th>Cena za jednostkę</th><th>Ilość</th><th>Wartość Netto</th><th>Wartosć Brutto</th><th>VAT</th></tr>';
        foreach($table2 as $row2)
        {
          echo '<tr>';
          foreach($row2 as $cell2)
          {
            echo '<td>';
            echo $cell2;
            echo '</td>';
          }
          echo '</tr>';
        }
        echo '</table>';
        echo '<hr/>';
      }
    ?>
    </div>
    <div class="container">
      <form method="POST" action="insert_receipt.php">
        <div class="row">
          <div class="col-sm">
            <label for="workerSelect">ID zlecenia</label>
            <select class="form-select" aria-label="ID zlecenia" name="orderSelect" id="orderSelect">
            <?php
              $query = "SELECT ID_zlecenia FROM Zlecenia ORDER BY ID_zlecenia ASC;";
              $result = mysqli_query($conn, $query);
              $table = mysqli_fetch_all($result, MYSQLI_ASSOC);
              $count = 0;
                  foreach($table as $row)
                  {
                    echo '<option value="'.$row['ID_zlecenia'].'"';
                    if($count == 0)
                    {
                      echo ' selected';
                      $count++;
                    }
                    echo '>';
                    echo $row['ID_zlecenia'];
                    echo '</option>';
                  }
            ?>
            </select>
          </div>
          <div class="col-sm">
          <label for="workerSelect">Pracownik</label>
                  <select class="form-select" aria-label="Ekspedient" name="workerSelect" id="workerSelect">
                  <?php
                  $query = mysqli_query($conn, 'SELECT ID_pracownika AS ID, CONCAT(imie," ",nazwisko) AS Pracownik FROM Pracownicy WHERE stanowisko = "Ekspedient";');
          
                  $workers = mysqli_fetch_all($query, MYSQLI_ASSOC);

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
                  mysqli_close($conn);
                  ?>
                </select>
          </div>
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