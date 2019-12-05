<!DOCTYPE html>
<html lang="pl">

<head>
	<title>Forum_Azyl</title>
  <?php
    include 'c_baza.php';  
  ?>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="style_forum.css" />

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <style type="text/css">
    #wylogowanie {
     float: right;
    }

  </style>
</head>
<body oncontextmenu="return false">
	<div class="container">

      <!-- The justified navigation menu is meant for single line per list item.
           Multiple lines will require custom code not provided by Bootstrap. -->
      <div class="masthead">
         <?php
            if (isset($_SESSION["zalogowany"])) {
           
             echo '<div id="wylogowanie">
                Witamy '.$_SESSION['nick'].'
                <form method="post"  action="/p_logowanie.php">
                <button name="poka_profil" type="submit">Pokaż profil</button>
                <br /><button name="wylogowanie" type="submit">Wyloguj się</button>
                </form>
                </div>';

                
                if(isset($_POST['wylogowanie'])){
                  session_destroy();
                  header("Location: forum.php");
            
              } 
              if(isset($_POST['poka_profil'])){
                  header("Location: user_profil.php");
            
              } 
            }
            ?>
        <h3 class="text-muted">Forum Azyl</h3>
        <nav>
          <ul class="nav nav-justified">
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="u_online.php">Użytkownicy online na TS</a></li>
            <?php
            if (isset($_SESSION["zalogowany"])) {
              echo "<li><a href=\"forum.php\">Forum</a></li>";
            }
            
            ?>
            <li><a href="p_logowanie.php">Logowanie</a></li>
              <li><a href="p_rejestracja.php">Zarejestruj</a></li>
            <li><a href="kontakt.php">Kontakt</a></li>
          </ul>
        </nav>
      </div>
    <div>
      <form class="form-signin" method="post" id="rejestracja" action="/dodaj_post.php">
        <h2 class="form-signin-heading" style="text-align: center;">Dodawanie nowego postu na forum</h2>
        <label for="inputNick" class="sr-only">Nick</label>
        <input type="text" id="inputNick" name="inputNick" class="form-control" placeholder="Nick" required="" autofocus="" maxlength='40'>
        <label for="inpuTemat" class="sr-only">Temat</label>
        <input type="text" id="inputTemat" name="inputTemat" class="form-control" placeholder="Temat" required="" autofocus="" maxlength='50'>
        <label for="inputTresc" class="sr-only">Tresc</label>
        <input type="text" name="inputTresc" maxlength="255" class="form-control" placeholder="Tresc" required="" autofocus="" id="inputTresc">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Dodaj</button>
    </div>
    	<?php  
      if ($_SERVER['REQUEST_METHOD'] == 'POST') 
      {
        // pobranie oraz przetworzenie danych z $_POST, np. zapis do bazy
        // kiedy czynności zostaną wykonane może nastąpić przekierowanie
          //Odbierania danych z formularza
          $nick = $_POST['inputNick'];
          $temat = $_POST['inputTemat'];
          $tresc = $_POST['tresc'];
          $data = date('Y-m-d');
         
 
      if($result->num_rows == 0) {
          //dodanie nowego rekordu
          $sql = "INSERT INTO azyl_posty (tytul_postu,wlasciciel,tresc, data)
            VALUES ($temat','$nick','$tresc','$data')";
          if ($conn->query($sql) === TRUE) 
          {
            
          } 
        else 
        {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
            $conn->close();
          
        exit;
         

        } 
      }
  
      
      ?>

	
      <!-- Site footer -->
      <footer class="footer">
        <p>© 2019 Aleksander Kowalski 'MrHDOLEK'</p>
      </footer>

    </div> <!-- /container -->
</body>
</html>