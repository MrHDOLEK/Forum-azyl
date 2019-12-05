<!DOCTYPE html>
<html lang="en">
<head>
  <title>Forum-azyl.pl</title>
   <?php
      include 'c_baza.php';  
    ?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="style_forum.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script>
            function op(obj) 
            {
              x=document.getElementById(obj);
              if(x.style.display == "none") x.style.display = "block";
              else x.style.display = "none";
            }
  </script>
  <style>
      /* cookie alert */
      #cookies-message{
        color: white; padding: 12px 10px; text-align: center; position: fixed; bottom:0px; left:0; right:0; background-color: rgba(0,0,0,0.6); z-index: 100000; box-shadow: 0 0 5px rgba(0,0,0,0.4); display: none;
      }
      #accept-cookies-checkbox{
        background-color: #00AFBF; color: #FFF; border: solid 1px #00AFBF; transition: all 0.5s; padding: 2px 6px; border-radius: 4px; display: inline-block; margin-left: 10px; text-decoration: none; cursor: pointer
      }
      #accept-cookies-checkbox:hover{
        background-color: transparent; border-color: white;
      }
      </style> 
</head>
<body oncontextmenu="return false">

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Forum-azyl.pl</a>
    </div>
    <ul class="nav navbar-nav">
      <li ><a href="index.php">Start</a></li>
     
      <li><a href="u_online.php">Użytkownicy online na TS</a></li>
      <li><a href="kontakt.php">Kontakt</a></li>
      
    
    <?php
                if (isset($_SESSION["zalogowany"])) 
                {
                  echo "<li><a href=\"forum.php\">Forum</a></li>";
                  echo '</ul>';
                }
              
              ?>
             <?php
               if (isset($_SESSION["zalogowany"])) 
               {
                  echo '<ul class="nav navbar-nav navbar-right">
                      <a class="navbar-brand"  >Witaj '.$_SESSION['nick'].'</a>
                      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Ustawienia<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                  <form method="post"  action="/p_logowanie.php">';
                     if ($_SESSION["moc_upr"] > 74)
                    {   
                      echo '<li><button name="gui_admin" type="submit" class="btn btn-danger btn-block">Panel zarzadzania</button></li>';
                    }

                    echo '<li><button name="poka_profil" type="submit" class="btn btn-info btn-block">Profill</button></li>
                    <li><button name="wylogowanie" type="submit" class="btn btn-warning btn-block">Wyloguj</button></li>
                  </form> 
                  </ul></li></ul>';
                  if(isset($_POST['wylogowanie']))
                  {
                              session_destroy();
                              header("Location: p_logowanie.php");
                      
                  } 
                 if(isset($_POST['poka_profil']))
                  {
                          header("Location: user_profil.php");
                    
                  }

                  if(isset($_POST['gui_admin']))
                  {
                          header("Location: gui_admin.php");
                    
                  }  
                       
               }
               else
               {
                echo '
                </ul>
                <ul class="nav navbar-nav navbar-right">
            <li><a href="p_rejestracja.php"><span class="glyphicon glyphicon-user"></span> Rejestracja </a></li>
            <li><a href="p_logowanie.php"><span class="glyphicon glyphicon-log-in"></span> Logowanie </a></li>
          </ul>';

                }
              ?>
    
  </div>
</nav>
  <div class="container">

      
      <div class=".align-items-center">
        <form class="form-signin"  method="post" id="logowanie" action="/p_logowanie.php">
          <h2 class="form-signin-heading" style="text-align: center;">Logowanie</h2>
          <label for="inputEmail" class="sr-only">Nick</label>
          <input type="text" id="inputNick" name="inputNick" class="form-control" placeholder="Nick" required="" autofocus="" maxlength='40'>
          <label for="inputPassword" class="sr-only">Hasło</label>
          <input type="password" name="inputPassword" id="inputPassword" class="form-control" placeholder="Hasło" required="">
          <div class="checkbox">
            <label>

              <input type="checkbox" value="remember-me"> Zapamiętaj mnie
            </label>
          </div>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Zaloguj</button>
        </form>
        
    </div>
      <?php
          $nick = $_POST['inputNick'];
          $sql = "SELECT * FROM user_login WHERE nick = '$nick'";
          $result = $conn->query($sql);

          $row = $result->fetch_assoc();

          if($result->num_rows == 0) {
              echo "<script type=\"text/javascript\">window.alert('Nie znaleziono takiego użytkownika');</script>";
          } 
          else 
          {
            //echo "login ".$email."<br>haslo ".$haslo."<br>poprawne haslo ".$row["haslo"];
            //odszyfrowywanie hasla z bazy
              $salt = "azyl46515215115615616";
              $haslo = $_POST['inputPassword'].$salt;
              $haslo = sha1($haslo);
            if($haslo == $row["haslo"]) {

	           //Wyszukanie i sprawdzanie dla danego uzytkownika jaką ma range
  	           $id=$row['id'];
  	           $zapytanie_ranga = "SELECT * FROM user_ranga WHERE id_u = '$id'";
  	           $wynik_ranga = $conn->query($zapytanie_ranga);
  	           if($wynik_ranga->num_rows > 0)
  	                {
  	                  while ($row = $wynik_ranga -> fetch_assoc())
  	                  {
  	                    $id_r=$row['id_r'];
  	                  }
  	              }
              //Sprawdzenie czy uzytkownik ma bana
               $zapytanie_ban = "SELECT * FROM user_bans WHERE id_u = '$id'";
               $wynik_ban = $conn->query($zapytanie_ban);
               if($wynik_ban->num_rows > 0)
                    {
                      while ($row = $wynik_ban -> fetch_assoc())
                      {
                        $ban_time=$row['ban_time'];
                        $powod=$row['powod'];
                      }
                  }
              if ($ban_time > 0)
              {
                echo "<h3 style='color:red;'>"."Brak dostępu powód ".$powod." ban na ".$ban_time." dni"."</h3>";
                exit;
              }
              else if (empty($ban_time))
              {
                echo $ban_time;
              
	           //Wyszukiwanie po id_r nazwy rangi
  	           $zapytanie_nazwa = "SELECT * FROM ranga WHERE id_r = '$id_r'";
  	           $wynik_nazwa = $conn->query($zapytanie_nazwa);
  	           if($wynik_ranga->num_rows > 0)
  	                {
  	                  while ($row = $wynik_nazwa -> fetch_assoc())
  	                  {
  	                    $n_ranga=$row['nazwa'];
  	                    $moc_pozwolen=$row['value'];
  	                  }
  	              }
	            
	           //Wpisywanie wartosci do sesji
		           $_SESSION["nick"] = $nick;
		           $_SESSION["haslo"] = $haslo;
		           $_SESSION["zalogowany"] = true;
		           $_SESSION["ranga"] = $n_ranga;
		           $_SESSION["moc_upr"] = $moc_pozwolen;
		        
	           header("refresh:0;URL=index.php");
	           echo "<script type=\"text/javascript\">window.alert('zalogowano');</script>";
              }
            }
            else
            {
               echo "<script type=\"text/javascript\">window.alert('Błędne haslo');</script>";
            }
          }

      ?>

      <!-- Site footer -->
      <footer class="footer">
        <p>© 2019 Aleksander Kowalski 'MrHDOLEK'</p>
      </footer>

    </div> <!-- /container -->
    <div id="cookies-message-container"><div id="cookies-message">Ta strona używa ciasteczek (cookies), dzięki którym nasz serwis może działać lepiej.<a href="javascript:WHCloseCookiesWindow();" id="accept-cookies-checkbox">Rozumiem</a></div></div>

     <script type="text/javascript" src="ciasteczka.js">
     </script>
</body>
</html>