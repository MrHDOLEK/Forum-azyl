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
  <script src="ckeditor/ckeditor.js"></script>
  <script>
            function op(obj) 
            {
              x=document.getElementById(obj);
              if(x.style.display == "none") x.style.display = "block";
              else x.style.display = "none";
            }
  </script>
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
                  <form method="post"  action="/pokaz_post.php">';
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

        
        <?php  
            if (isset($_SESSION["zalogowany"]))
            {
          ?>
        <div id="odp">
          <h3>Pytanie:</h3>
            <?php
            $id = $_GET['id'];
            //zapytanie o konretne posty z danej kategori
            $zapytanie_kate ="SELECT  * FROM azyl_posty WHERE id = '$id'";
            $wynik_kate = $conn->query($zapytanie_kate);
             if($wynik_kate->num_rows > 0)
                    {
                      while ($row = $wynik_kate -> fetch_assoc())
                      {
                        echo '<article class="row">
                                <div class="col-md-2 col-sm-2 col-md-offset-1 col-sm-offset-0 hidden-xs">
                                  <figure class="thumbnail">
                                    <img class="img-responsive" src="http://www.tangoflooring.ca/wp-content/uploads/2015/07/user-avatar-placeholder.png" />
                                    <figcaption class="text-center">'.$row['wlasciciel'].'</figcaption>
                                  </figure>
                                </div>
                                <div class="col-md-9 col-sm-9">
                                  <div class="panel panel-default arrow left">
                                    <div class="panel-heading right">'.$row['tytul_postu'].'</div>
                                    <div class="panel-body">
                                      <header class="text-left">
                                        <time class="comment-date" ><i class="fa fa-clock-o"></i>Data utworzenia: '.$row['data'].'</time>
                                      </header>
                                      <div class="comment-post">
                                        <p>
                                        '.$row['tresc'].'
                                        </p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </article>';
                      }

                  }
            ?>
        </div>
        <div id="wys_odpowiedzi">
          <h3>Odpowiedzi:</h3>
                <?php
                    $id_p = $_GET['id'];
                    $id_k = $_GET['id_k'];
                    $zapytanie ="SELECT nick,tresc,forum_odpowiedzi.data FROM forum_odpowiedzi INNER JOIN user_login ON forum_odpowiedzi.id_u = user_login.id WHERE forum_odpowiedzi.id_p = '$id_p'";
                    $wynik = $conn->query($zapytanie);
                    if($wynik->num_rows > 0)
                    {
                      while ($row = $wynik -> fetch_assoc())
                      {
                        echo '<article class="row">
                                <div class="col-md-2 col-sm-2 col-md-offset-1 col-sm-offset-0 hidden-xs">
                                  <figure class="thumbnail">
                                    <img class="img-responsive" src="http://www.tangoflooring.ca/wp-content/uploads/2015/07/user-avatar-placeholder.png" />
                                    <figcaption class="text-center">'.$row['nick'].'</figcaption>
                                  </figure>
                                </div>
                                <div class="col-md-9 col-sm-9">
                                  <div class="panel panel-default arrow left">
                                    <div class="panel-body">
                                      <header class="text-left">
                                        <time class="comment-date"><i class="fa fa-clock-o"></i> Data odpowiedzi: '.$row['data'].'</time>
                                      </header>
                                      <div class="comment-post">
                                        <p>
                                        '.$row['tresc'].'
                                        </p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </article>';
                      }

                  }

                ?>
        </div>
      <br /><a href="/" onClick="op('wyswietl_1'); return false;"><span class="glyphicon glyphicon-comment">Odpowiedz</a>
    	   <div id="wyswietl_1" name="odpowiedz" style="display:none">
          <?php
          echo '<form method="post" id="Edycja" action="/pokaz_post.php?id='.$id_p.'">';
          $id_po = $_GET['id'];
          $id_ka = $_GET['id_k'];
          echo '<td><input type="hidden" id="inputID" name="inputID" maxlenght="10" value="'.$id_po.'" readonly required></td>';
          echo '<td><input type="hidden" id="kategoria" name="kategoria" maxlenght="10" value="'.$id_ka.'" readonly required></td>';
          ?>
                   <table>
                       

                        <tr><td><span class="glyphicon glyphicon-comment"></span>:</td><td><textarea class="form-control" rows="5" id="tresc" maxlength="255" name="tresc" required></textarea></td></tr>
                         <script>
                            CKEDITOR.replace( 'tresc' );
                         </script>
                    </table>
                   <div style="text-align: left;">
                      <input type="submit" value="Odpowiedz" class="btn btn-sm btn-success"></input>
                      <input type="reset" value="Reset" class="btn btn-sm btn-danger">
                      
                   </div>
                  </form>
                  </div>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') 
              {
                
                
               

              //Wygenerowanie aktualnej daty
                $results->start;
                $start = new DateTime($results->start);
                $start->format('Y-m-d');
              //pobranie id danego uzytkownika
               
                $nick=$_SESSION["nick"];
                $zapytanie_o_id= "SELECT * FROM user_login WHERE nick = '$nick'";
                $wynik_id = $conn->query($zapytanie_o_id);
                if($wynik_id->num_rows > 0)
                {
                   while ($row = $wynik_id -> fetch_assoc())
                     {
                      
                        $id_u = $row['id'];
                        
                    }
                }
              
                
                $id_p = $_POST['inputID'];
                $id_k = $_POST['kategoria'];
                $tresc = $_POST['tresc'];
                $data = date('Y-m-d');
                $sql = "INSERT INTO forum_odpowiedzi (id_p,id_k,id_u,tresc,data)
                VALUES ('$id_p','$id_k','$id_u','$tresc','$data')";
               
                if ($conn->query($sql) === TRUE) 
                    {
                      echo "<script type=\"text/javascript\">window.alert('Udało sie dodać odpowiedzi');</script>";
                  } 
                  else 
                  {
                      echo "Error: " . $sql . "<br>" . $conn->error;
                  }
                  header("Refresh: 1; URL=pokaz_post.php?id=$id_p");
                  $conn->close();
                  exit;


            }
            ?> 
         
         <?php  
            }
            else
            {
                echo 'Zaloguj sie aby zyskać dostep do forum';
                header('refresh:3;URL=p_logowanie.php');
            }
        ?>
        <!-- Site footer -->
        <footer class="footer">
          <p>© 2019 Aleksander Kowalski 'MrHDOLEK'</p>
        </footer>

      </div> <!-- /container -->

</body>
</html>