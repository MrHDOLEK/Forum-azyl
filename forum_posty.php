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
                  $id = $_GET['id_k'];
                  echo "<li><a href=\"forum.php\">Forum</a></li>";
                  echo '<li><form  method="POST" action="forum_posty.php?id_k='.$id.'" name="wyszukiwarka"/>';
                  echo '<input class="form-control mr-sm-2" type="search" placeholder="Wyszukaj" aria-label="Wyszukaj" name="wyszukaj">';

                  echo '</form></li>';
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
                  <form method="post"  action="/forum_posty.php">';
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

      <!-- The justified navigation menu is meant for single line per list item.
           Multiple lines will require custom code not provided by Bootstrap. -->
      
        <?php  
            if (isset($_SESSION["zalogowany"]))
            {
        ?>
          <table class="table table-dark">
            <tr>
              
              <td>Tytuł</td>
              <td>Kto założył</td>
              <td>Data</td>
              
            </tr>
          <?php
          
          $id = $_GET['id_k'];
          
                  $dane =$_POST['wyszukaj'];


                  if (empty($dane))
                  {
                     $zapytanie_kate = "SELECT * FROM azyl_posty WHERE id_k = '$id'";
                  }
                  else
                  {
                
                     $zapytanie_kate = "SELECT * FROM azyl_posty WHERE  (wlasciciel Like '%$dane%' AND id_k = '$id') OR (tytul_postu Like '%$dane%' AND id_k = '$id') OR (data Like '%$dane%' AND id_k = '$id')";
                  }
                  
          //zapytanie o konretne posty z danej kategori
          
          $wynik_kate = $conn->query($zapytanie_kate);
          
           if($wynik_kate->num_rows > 0)
                  {
                    while ($row = $wynik_kate -> fetch_assoc())
                    {
                      echo '<tr>';
                      
                      echo '<td>'.$row['tytul_postu'].'</td>';
                      echo '<td>'.$row['wlasciciel'].'</td>';
                      echo '<td>'.$row['data'].'</td>';
                      echo '<td>'.'<a href ="pokaz_post.php?id='.$row["id"].'&id_k='.$row["id_k"].'" class="glyphicon glyphicon-chevron-right"></a>'.'</td>';
                      if ($_SESSION["moc_upr"] >= 75 OR $_SESSION["nick"] == $row['wlasciciel'])
                      {  
                        echo '<td>'.'<a href ="usuwanie_tabelek_posty_forum.php?id='.$row["id"].'"><span class="glyphicon glyphicon-remove-sign"></span>Usuń</a>'.'</td>';
                      }
                      
                      $id = $row["id_k"];
                    }
                    echo '</tr>';

                }
          
          ?>
          </table>
        
        <?php
        //zabezpieczenie aby userzy nie dodawali do kategori w ktorych niemaja nic prawa dodawac
        if ($_SESSION["moc_upr"] >= 100 AND $id == 1 OR $_SESSION["moc_upr"] >= 100 AND $id == 4)
            {  
    	         echo '<a href ="dodawanie_tabeli_posty_user.php?id='.$id.'"><span class="glyphicon glyphicon-plus-sign"></span>Dodaj post</a>';
            }
        if ($_SESSION["moc_upr"] >= 50 AND $id == 2 OR $_SESSION["moc_upr"] >= 50 AND $id == 3 OR $_SESSION["moc_upr"] >= 50 AND $id > 4)
            {  
               echo '<a href ="dodawanie_tabeli_posty_user.php?id='.$id.'"><span class="glyphicon glyphicon-plus-sign"></span>Dodaj post</a>';
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