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
                  <form method="post"  action="/index.php">';
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
      <script src="ckeditor/ckeditor.js"></script>
          <form method="post" id="newsy" action="/edytor_news_run.php">
            <?php  
            $id = $_GET['id'];
            $zapytanie ="SELECT * FROM news WHERE id='$id'";
                    $wynik = $conn->query($zapytanie);
                    if($wynik->num_rows > 0)
                    {
                      while ($row = $wynik -> fetch_assoc())
                      { 
                        echo '<input type="hidden" id="id_p" name="id_p" value="'.$row['id'].'">';
                        echo '<br />Tytuł:<textarea class="form-control" name="tytul" id="tytul" rows="1" cols="70" placeholder="Tytuł newsa">'.$row['tytul'].'</textarea> 
                        <br />Treść:<textarea name="news_edi" id="news_edi" rows="10" cols="80" >'.$row['tresc'].'</textarea>';
                        
                      }
                      

                  }
              
              ?>
              <br /><button type="submit" class="btn btn-info">Edytuj news</button>
          </form>
              <script>
                  CKEDITOR.replace( 'news_edi' );
              </script>
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
