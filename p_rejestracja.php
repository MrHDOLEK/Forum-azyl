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
                  <form method="post"  action="/p_rejestracja.php">';
                     if ($_SESSION["moc_upr"]  > 74)
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
        <form class="form-signin" method="post" id="rejestracja" action="/p_rejestracja.php">
          <h2 class="form-signin-heading" style="text-align: center;">Rejestracja</h2>
          <label for="inputNick" class="sr-only">Nick</label>
          <input type="text" id="inputNick" name="inputNick" class="form-control" placeholder="Nick" required="" autofocus="" maxlength='40'>
          <label for="inputEmail" class="sr-only">Email</label>
          <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email" required="" autofocus="" maxlength='40'>
          <label for="inputPassword" class="sr-only">Hasło</label>
          <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Hasło" required="">
          <label>
              <input type="checkbox" required=""> Zapoznałem się z regulaminem
              <a  data-toggle="modal" data-target="#myModal">
                <span class="glyphicon glyphicon-paperclip"></span>
              </a>
          </label>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Zarejestruj</button>
          
              <!--Regulamin -->
           

          <!-- Modal -->
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Zamknij</span></button>
                  <h4 class="modal-title" id="myModalLabel">Regulamin Forum-azyl.pl</h4>
                </div>
                <div class="modal-body">
                  <?php

                      echo readfile("regulamin.txt");  

                    ?>
                </div>
                <div class="modal-footer">
                  <butoon type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
                  
                </div>
              </div>
            </div>
          </div>
      </form>
    </div>
  
      <?php  
      if ($_SERVER['REQUEST_METHOD'] == 'POST') 
      {
	  		// pobranie oraz przetworzenie danych z $_POST, np. zapis do bazy
	  		// kiedy czynności zostaną wykonane może nastąpić przekierowanie
	      	//Odbierania danych z formularza
	        $nick = $_POST['inputNick'];
	        $email = $_POST['inputEmail'];
	        $data = date('Y-m-d');

          //szyfrowanie hasła
          $salt = "azyl46515215115615616";
          $haslo = $_POST['inputPassword'].$salt;
          $haslo = sha1($haslo);

	        //sprawdzenie nie dziala NAPRAWIC
	        $sql_spr = "SELECT * FROM user_login WHERE email = '$email' || nick = '$nick'";
          $wynik_spr = $conn->query($sql_spr);
          if(mysqli_num_rows($wynik_spr) > 0) 
          {

              echo "<script type=\"text/javascript\">window.alert('Użytkownik o podanym emailu lub nicku istnieje');</script>";

          } 
          else 
          {
            //dodanie nowego rekordu
             $sql = "INSERT INTO user_login (nick, email, haslo, data)
              VALUES ('$nick','$email','$haslo','$data')";
              if ($conn->query($sql) === TRUE) 
              {
                //pobranie id uzytkownika nowo zarejestrowanego

                $sql_id ="SELECT id FROM user_login WHERE nick = '$nick'";
                $wynik_id = $conn->query($sql_id);
                    if($wynik_id->num_rows > 0)
                    {
                      while ($row = $wynik_id -> fetch_assoc())
                      {
                        $id_usera = $row['id'];
                      }
                    }
                
                
                //Zapytanie do bazy i szukanie id uzytkownika
                $sql_user ="SELECT * FROM ranga WHERE nazwa = 'Użytkownik'";
                $wynik_user = $conn->query($sql_user);
                if($wynik_user->num_rows > 0)
                    {
                      while ($row = $wynik_user -> fetch_assoc())
                      {
                        $id_rangi = $row['id_r'];
                      }
                    }
                
                //nadawanie rangi

               $sql_ranga = "INSERT INTO user_ranga (id_u,id_r)
              VALUES ('$id_usera','$id_rangi')";
              $wynik_ranga = $conn->query($sql_ranga);
            } 
            else 
            {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
              $conn->close();
              header("Location: sukces.php");
              exit;
              

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
