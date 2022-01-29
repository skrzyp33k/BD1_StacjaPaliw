<?php 
    require_once("dbinfo.php");
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    if(!$conn)
    {
        echo 'Błąd łączenia się z bazą!!!!!!';
    }
?>
<!DOCTYPE HTML>
<html lang="pl">

<head>
  <meta charset="UTF-8" />

  <title>GBS - Inne zestawienia</title>

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
          <li><a href="./paragony.php" class="nav-link px-2 text-white">Paragony</a></li>
          <li><a href="./faktury.php" class="nav-link px-2 text-white">Faktury</a></li>
          <li><a href="./inne.php" class="nav-link px-2 text-black">Inne zestawienia</a></li>
        </ul>
      </div>
    </div>
  </header>
  <main class="container">
    <div class="container">
        <h1>Najgorszy sprzedawca</h1>
        <?php
            $query = "SELECT * FROM Najgorszy_Sprzedawca_Widok";
            $result = mysqli_query($conn,$query);
            $table = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $columns = mysqli_fetch_all(mysqli_query($conn, "SHOW COLUMNS FROM Najgorszy_Sprzedawca_Widok"),MYSQLI_ASSOC);
            echo '<table class="result_table">';
            echo '<tr>';
            foreach($columns as $row)
            {
                echo '<th>';
                echo $row['Field'];
                echo '</th>';
            }
            echo '</tr>';
            foreach($table as $row)
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
        ?>
    </div>
    <div class="container">
        <h1>Towary które były najczęściej sprzedawane</h1>
        <?php
            $query = "SELECT * FROM Najwiecej_Sprzedanych_Widok";
            $result = mysqli_query($conn,$query);
            $table = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $columns = mysqli_fetch_all(mysqli_query($conn, "SHOW COLUMNS FROM Najwiecej_Sprzedanych_Widok"),MYSQLI_ASSOC);
            echo '<table class="result_table">';
            echo '<tr>';
            foreach($columns as $row)
            {
                echo '<th>';
                echo $row['Field'];
                echo '</th>';
            }
            echo '</tr>';
            foreach($table as $row)
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
            ?>
    </div>
    <div class="container">
        <h1>Średnie wypłaty na stanowiskach</h1>
        <?php
            $query = "SELECT * FROM Srednie_Wyplaty_Widok";
            $result = mysqli_query($conn,$query);
            $table = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $columns = mysqli_fetch_all(mysqli_query($conn, "SHOW COLUMNS FROM Srednie_Wyplaty_Widok"),MYSQLI_ASSOC);
            echo '<table class="result_table">';
            echo '<tr>';
            foreach($columns as $row)
            {
                echo '<th>';
                echo $row['Field'];
                echo '</th>';
            }
            echo '</tr>';
            foreach($table as $row)
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
        ?>
    </div>
    <div class="container">
        <h1>Stali klienci</h1>
        <?php
            $query = "SELECT * FROM Stali_Klienci_Widok";
            $result = mysqli_query($conn,$query);
            $table = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $columns = mysqli_fetch_all(mysqli_query($conn, "SHOW COLUMNS FROM Stali_Klienci_Widok"),MYSQLI_ASSOC);
            echo '<table class="result_table">';
            echo '<tr>';
            foreach($columns as $row)
            {
                echo '<th>';
                echo $row['Field'];
                echo '</th>';
            }
            echo '</tr>';
            foreach($table as $row)
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
        ?>
    </div>
    <div class="container">
        <h1>Klienci zza granicy</h1>
        <?php
            $query = "SELECT * FROM Zagraniczni_Klienci_Widok";
            $result = mysqli_query($conn,$query);
            $table = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $columns = mysqli_fetch_all(mysqli_query($conn, "SHOW COLUMNS FROM Zagraniczni_Klienci_Widok"),MYSQLI_ASSOC);
            echo '<table class="result_table">';
            echo '<tr>';
            foreach($columns as $row)
            {
                echo '<th>';
                echo $row['Field'];
                echo '</th>';
            }
            echo '</tr>';
            foreach($table as $row)
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
            mysqli_close($conn);
        ?>
    </div>
    <div class="container">
        <h1>E-Maile dostawców</h1>
        <?php
            $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
            $query = "CALL EmaileDostawcow();";
            $result = mysqli_query($conn, $query);
            $tab = mysqli_fetch_all($result, MYSQLI_ASSOC);
            echo '<table class="result_table">';
            echo '<tr>';
            echo '<th>Nazwa</th><th>E-mail</th>';
            echo '</tr>';
            foreach($tab as $row)
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
            mysqli_close($conn);
        ?>
    </div>
    <div class="container">
        <h1>Pracownicy z Warszawy</h1>
        <?php
            $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
            $query = "CALL PracownicyzWarszawy();";
            $result = mysqli_query($conn, $query);
            $tab = mysqli_fetch_all($result, MYSQLI_ASSOC);
            echo '<table class="result_table">';
            echo '<tr>';
            echo '<th>Nazwisko</th><th>Imię</th><th>Stanowisko</th>';
            echo '</tr>';
            foreach($tab as $row)
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
            mysqli_close($conn);
        ?>
    </div>
    <div class="container">
        <h1>Sprzedawcy którzy sprzedali jaki towar</h1>
        <?php
            $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
            $query = "CALL SprzedazTowarowNaParagon();";
            $result = mysqli_query($conn, $query);
            $tab = mysqli_fetch_all($result, MYSQLI_ASSOC);
            echo '<table class="result_table">';
            echo '<tr>';
            echo '<th>Nazwisko</th><th>Imię</th><th>Stanowisko</th><th>Nazwa</th>';
            echo '</tr>';
            foreach($tab as $row)
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
            mysqli_close($conn);
        ?>
    </div>
    <div class="container">
        <form method="POST" action="inne.php">
        <h1>Kierowcy tankujący:</h1>
          <select class="form-select" name="fuelSelect" id="fuelSelect">
          <?php        
          $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

                  $query = mysqli_query($conn,'SELECT DISTINCT rodzaj FROM Paliwa;');
          
                  $providers = mysqli_fetch_all($query, MYSQLI_ASSOC);

                  $count = 0;

                  foreach($providers as $row)
                  {
                    echo '<option value="'.$row['rodzaj'].'"';
                    if($count == 0)
                    {
                      echo ' selected';
                      $count++;
                    }
                    echo '>';
                    echo $row['rodzaj'];
                    echo '</option>';
                  }

                  $count = 0;
                  mysqli_close($conn);
          ?>
        </select>
        <button type="submit" class="btn btn-primary">Dodaj</button>
        <?php
            $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
            if(isset($_POST['fuelSelect']))
            {
            $query = 'CALL KlienciTankujacyWybierz("'.$_POST['fuelSelect'].'");';
            $result = mysqli_query($conn, $query);
            $tab = mysqli_fetch_all($result, MYSQLI_ASSOC);
            echo '<table class="result_table">';
            echo '<tr>';
            echo '<th colspan="3">'.$_POST['fuelSelect'].'</th>';
            echo '</tr>';
            echo '<tr>';
            echo '<th>Imię</th><th>Nazwisko</th><th>Nazwa paliwa</th>';
            echo '</tr>';
            foreach($tab as $row)
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
            mysqli_close($conn);
        ?>
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