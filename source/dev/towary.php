<!DOCTYPE HTML>
<html lang="pl">

<head>
  <meta charset="UTF-8" />

  <title>GBS - Towary</title>

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
          <li><a href="./towary.php" class="nav-link px-2 text-black">Towary</a></li>
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
  <h1>Lista towarów</h1>
    <div class="container">
      <?php
        require_once("dbinfo.php");
        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        if($conn)
        {
          $query = mysqli_query($conn, "SELECT * FROM Towary;");
          $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
          echo '<table class="result_table">';
          echo '<tr>';
          echo '<th>Nazwa</th><th>Cena</th><th>Rodzaj</th><th>Kod</th><th>Opis</th><th>% Vat</th><th>Akcje</th>';
          echo '</tr>';
          foreach($result as $row)
          {
            echo '<tr>';
            $ware_id = -1;
            foreach($row as $cell)
            {
              if($ware_id == -1)
              {
                $ware_id = $cell;
                continue;
              }
              echo '<td>';
              echo $cell;
              echo '</td>';
            }
            echo '<td>';
            echo<<<END
            <table class="button_table"><tr>
            <td style="border: 1px solid black;">
            <form method="POST" action="./edit_ware.php" >
            <input type="hidden" name="ware_id" value="$ware_id"/>
            <button type="submit" class="btn btn-primary"><img class="btn_icon" src="../img/pencil.png"/></button>
            </form>
            </td>
            <td style="border: 1px solid black;">
            <form method="POST" action="./delete_ware.php" >
            <input type="hidden" name="ware_id" value="$ware_id"/>
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
          echo "Błąd łączenia się z bazą!!!";
        }
      ?>
    </div>
    <hr/>
    <h1>Dodaj towar</h1>
    <div class="container">
    <form method="POST" action="insert_ware.php">
            <div class="form-group">
                <label for="nameInput">Nazwa</label>
                <input type="text" class="form-control" id="nameInput" name="nameInput" value="" maxlength="30"/>
            </div>
            <div class="form-group">
                <label for="priceInput">Cena</label>
                <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control" id="priceInput" name="priceInput" value="" maxlength="5"/>
            </div>
            <div class="form-group">
                <label for="typeInput">Rodzaj</label>
                <input type="text" class="form-control" id="typeInput" name="typeInput" value="" maxlength="25"/>
            </div>
            <div class="form-group">
                <label for="codeInput">Kod</label>
                <input type="text" class="form-control" id="codeInput" name="codeInput" value="" maxlength="12"/>
            </div>
            <div class="form-group">
                <label for="descriptionInput">Opis</label>
                <input type="text" class="form-control" id="descriptionInput" name="descriptionInput" value="" maxlength="100"/>
            </div>
            <div class="form-group">
                <label for="taxInput">% Vat</label>
                <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control" id="taxInput" name="taxInput" value="" maxlength="2"/>
            </div>
            <input type="hidden" name="serviceID" value="<?php echo $service_id; ?>"/>
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