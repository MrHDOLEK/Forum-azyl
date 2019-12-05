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
		<?php
            if ($_SESSION["moc_upr"] > 74)
            {   
          ?>
          	<br /><button href="/" onClick="op('wyswietl_1'); return false;" class="btn btn-primary btn-lg btn-block" variant="dark">Posty</button>
              <div id="wyswietl_1" style="display:none">
                <!--Wyszukiwanie include -->
                <br />
                  <?php
                    
                    include 'wyszukiwanie_azyl.php';  
                  ?>
              <table class="table table-dark">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Tytuł_postu</th>
                  <th scope="col">Wlasciciel</th>
                  <th scope="col">Tresc</th>
                  <th scope="col">Data</th>
                  <th scope="col">Edycja/Usuń</th>
              </thead>
              <tbody>
                </tr>
                <?php
                //wyszukiwajka z wyborem
                  
                  $wybor =$_GET['wyb_wysz'];
                  $dane =$_GET['pole_wysz'];

                  if (empty($wybor))
                  {
                     $zapytanie ="SELECT * FROM azyl_posty ORDER BY id DESC";

                  }
                  else if ($wybor == 'data')
                  {
                     $danedata = $_GET['poka_data'];
                     
                     $zapytanie = "SELECT * FROM azyl_posty WHERE  data Like '$danedata'";
                  }
                  else if ($wybor == 'wlasciciel')
                  {
                     $zapytanie = "SELECT * FROM azyl_posty WHERE  wlasciciel Like '%$dane%'";
                  }
                   else if ($wybor == 'tresc')
                  {
                     $zapytanie = "SELECT * FROM azyl_posty WHERE  tresc Like '%$dane%'";
                  }
                   else if ($wybor == 'tytul_postu')
                  {
                     $zapytanie = "SELECT * FROM azyl_posty WHERE  tytul_postu Like '%$dane%'";
                  }
                   else if ($wybor == 'id_k')
                  {
                     $zapytanie = "SELECT * FROM azyl_posty WHERE  id_k Like '%$dane%'";
                  }
                 
                 
                /* $dane =$_GET['pole_wysz'];

                  $zapytanie = "SELECT * FROM azyl_posty WHERE  (wlasciciel Like '%$dane%') OR (data Like '%$dane%') OR (tresc Like '%$dane%') OR (tytul_postu Like '%$dane%') OR (id_k Like '%$dane%')";*/


                    
                    $wynik = $conn->query($zapytanie);
                    if($wynik->num_rows > 0)
                    {
                      while ($row = $wynik -> fetch_assoc())
                      {
                        echo '<tr>';
                        echo '<td>'.$row['id'].'</a></td>';
                        echo '<td>'.$row['tytul_postu'].'</td>';
                        echo '<td>'.$row['wlasciciel'].'</td>';
                        echo '<td>'.$row['tresc'].'</td>';
                        echo '<td>'.$row['data'].'</td>';
                        echo '<td>'.'<a href ="edycja_tabelek_posty.php?id='.$row["id"].'" class="btn btn-info"> Edycja </a>'.' <a href ="usuwanie_tabelek_posty.php?id='.$row["id"].'" class="btn btn-danger"> Usuń </a>'.'</td>';


                      }
                      echo '</tr>';

                  }
                ?>
                
              </tbody>
            </table>
            <a href="dodawanie_tabeli_posty.php" class="btn btn-success">Dodaj nowy post</a>
            
              </div>
              <br /><a href="/" onClick="op('wyswietl_2'); return false;" class="btn btn-primary btn-lg btn-block">Mail</a>
              <div id="wyswietl_2" style="display:none">
                <br />
                 <?php
                    
                    include 'wyszukiwanie_mail.php';  
                  ?>
                <table class="table table-dark">
              <thead class="thead-dark">
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Imie_i_nazwisko</th>
                <th scope="col">email</th>
                <th scope="col">Temat wiadomosci</th>
                <th scope="col">Data</th>
                <th scope="col">Odpowiedziano</th>
                <th scope="col">Odpowiedz</th>
              </thead>
              <tbody>
                </tr>

                <?php
                //wyszukiwajka z wyborem

                  $nazwa_tabeli = 'azyl_posty';
                  $wybor =$_GET['wyb_wysz_1'];
                  $dane =$_GET['pole_wysz_1'];

                  if (empty($wybor))
                  {
                     $zapytanie ="SELECT * FROM azyl_zapytania ORDER BY id DESC";
                  }
                  else if ($wybor == 'data')
                  {
                     $danedata = $_GET['poka_data_1'];
                     
                     $zapytanie = "SELECT * FROM azyl_zapytania WHERE  data Like '$danedata'";
                  }
                  else if ($wybor == 'imie_i_nazwisko')
                  {
                     $zapytanie = "SELECT * FROM azyl_zapytania WHERE imie_i_nazwisko Like '%$dane%'";
                  }
                   else if ($wybor == 'email')
                  {
                     $zapytanie = "SELECT * FROM azyl_zapytania WHERE  email Like '%$dane%'";
                  }
                   else if ($wybor == 'temat')
                  {
                     $zapytanie = "SELECT * FROM azyl_zapytania WHERE  temat Like '%$dane%'";
                  }
                  

                    
                    $wynik = $conn->query($zapytanie);
                    if($wynik->num_rows > 0)
                    {
                      while ($row = $wynik -> fetch_assoc())
                      {
                        echo '<tr>';
                        echo '<td>'.$row['id'].'</a></td>';
                        echo '<td>'.$row['imie_i_nazwisko'].'</td>';
                        echo '<td>'.$row['email'].'</td>';
                        echo '<td>'.$row['temat'].'</td>';
                        echo '<td>'.$row['data'].'</td>';
                        if ($row['odp'] == 0) 
                        {
                          echo '<td>Nie</td>';
                        }
                        else
                        {
                          echo '<td>Tak</td>';
                        }
                        echo '<td>'.'<a href ="azyl_zapytania_odp.php?id='.$row["id"].'" class="btn btn-info">Odpowiedz</a>';
                        echo '<a href ="usun_odp.php?id='.$row["id"].'" class="btn btn-danger">Usuń</a>'.'</td>';
                      }
                      echo '</tr>';

                  }
                ?>
                
              </tbody>
            </table>
              </div>
            <br /><a href="/" onClick="op('wyswietl_3'); return false;" class="btn btn-primary btn-lg btn-block">Kategorie na forum</a>
              <div id="wyswietl_3" style="display:none">
                <table class="table table-dark">
              <thead class="thead-dark">
                <tr>
                <th scope="col">Id_kategori</th>
                <th scope="col">Nazwa</th>
                <th scope="col">Edycja/Usun</th>
              </thead>
              <tbody>
                </tr>
                <?php
                    $zapytanie ="SELECT * FROM forum_kateg ORDER BY id_k ASC";
                    $wynik = $conn->query($zapytanie);
                    if($wynik->num_rows > 0)
                    {
                      while ($row = $wynik -> fetch_assoc())
                      {
                        echo '<tr>';
                        echo '<td>'.$row['id_k'].'</a></td>';
                        echo '<td>'.$row['nazwa'].'</td>';
                        echo '<td>'.'<a href ="edycja_kategori.php?id='.$row["id_k"].'" class="btn btn-info">Edycja</a>';
                        echo ' <a href ="usuwanie_kategori.php?id='.$row["id_k"].'" class="btn btn-danger"> Usun</a>'.'</td>';
                      }
                      echo '</tr>';

                  }
                ?>
                
              </tbody>
            </table>
              <a href="dodanie_kategori.php" class="btn btn-success">Dodaj nową kategorie</a>
              </div>
              <br /><a href="/" onClick="op('wyswietl_4'); return false;" class="btn btn-primary btn-lg btn-block">Odpowiedzi na forum</a>
              <div id="wyswietl_4" style="display:none">
                <table class="table table-dark">
              <thead class="thead-dark">
                <tr>
                <th scope="col">Id_postu</th>
                <th scope="col">Kategoria</th>
                <th scope="col">Właściciel</th>
                <th scope="col">Treść</th>
                <th scope="col">Data powstania</th>
                <th scope="col">Edycja/Usuń</th>
                
              </thead>
              <tbody>
                </tr>
                <?php
                //Zrób pliki do tego
                    $zapytanie ="SELECT id_p,nazwa,nick,tresc,forum_odpowiedzi.data FROM forum_odpowiedzi INNER JOIN user_login ON forum_odpowiedzi.id_u = user_login.id INNER JOIN forum_kateg ON forum_odpowiedzi.id_k = forum_kateg.id_k";
                    $wynik = $conn->query($zapytanie);
                    if($wynik->num_rows > 0)
                    {
                      while ($row = $wynik -> fetch_assoc())
                      {
                        echo '<tr>';
                        echo '<td>'.$row['id_p'].'</a></td>';
                        echo '<td>'.$row['nazwa'].'</td>';
                        echo '<td>'.$row['nick'].'</td>';
                        echo '<td>'.$row['tresc'].'</td>';
                        echo '<td>'.$row['data'].'</td>';
                        echo '<td>'.'<a href ="edycja_odpowiedzi.php?id='.$row["id_p"].'" class="btn btn-info"> Edycja </a>';
                        echo ' <a href ="usuwanie_odpowiedzi.php?id='.$row["id_p"].'" class="btn btn-danger"> Usuń </a>'.'</td>';
                        
                      }
                      echo '</tr>';

                  }
                ?>
                
              </tbody>
            </table>
              </div>
              <?php
              //Spr czy dany user ma odpowiednia moc uprawnien
               if ($_SESSION["moc_upr"] > 100)
                    {   
              ?>
        	 <br /><a href="/" onClick="op('wyswietl_5'); return false;" class="btn btn-primary btn-lg btn-block">Rangi</a>
              <div id="wyswietl_5" style="display:none">
                <table class="table table-dark">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Id_rangi</th>
                  <th scope="col">Nazwa</th>
                  <th scope="col">Opis</th>
                  <th scope="col">Wartosc</th>
                  <th scope="col">Edycja/Usuń</th>
              </thead>
              <tbody>
                </tr>
                <?php
                    $zapytanie ="SELECT * FROM ranga ORDER BY id_r ASC";
                    $wynik = $conn->query($zapytanie);
                    if($wynik->num_rows > 0)
                    {
                      while ($row = $wynik -> fetch_assoc())
                      {
                        echo '<tr>';
                        echo '<td>'.$row['id_r'].'</a></td>';
                        echo '<td>'.$row['nazwa'].'</td>';
                        echo '<td>'.$row['opis'].'</td>';
                        echo '<td>'.$row['value'].'</td>';
                        echo '<td>'.'<a href ="edycja_ranga.php?id='.$row["id_r"].'" class="btn btn-info"> Edycja </a>';
                        echo ' <a href ="usun_ranga.php?id='.$row["id_r"].'" class="btn btn-danger"> Usuń </a>'.'</td>';
                      }
                      echo '</tr>';

                  }
                ?>
                
              </tbody>
            </table>
           	 <a href="dodawanie_ranga.php" class="btn btn-success">Dodaj nową range</a>
              </div>
              <br /><a href="/" onClick="op('wyswietl_6'); return false;" class="btn btn-primary btn-lg btn-block">Bany</a>

              <div id="wyswietl_6" style="display:none">
                <br />
                 <?php
                    
                    include 'wyszukiwanie_bany.php';  
                  ?>
                <table class="table table-dark">
              <thead class="thead-dark">
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Nick</th>
                <th scope="col">Ban time</th>
                <th scope="col">Powód</th>
                <th scope="col">Data</th>
                <th scope="col">Usuń</th>
              </thead>
              <tbody>
                </tr>
                <?php

                    //wyszukiwajka z wyborem

                  $nazwa_tabeli = 'azyl_posty';
                  $wybor =$_GET['wyb_wysz_2'];
                  $dane =$_GET['pole_wysz_2'];

                  if (empty($wybor))
                  {
                    
                     $zapytanie ="SELECT user_bans.id,nick,ban_time,powod,user_bans.data FROM user_bans INNER JOIN user_login ON user_bans.id_u = user_login.id WHERE user_bans.id IS NOT NULL ORDER BY id DESC";
                  }
                  else if ($wybor == 'data')
                  {
                     $danedata = $_GET['poka_data_2'];
                     
                    
                     $zapytanie ="SELECT user_bans.id,nick,ban_time,powod,user_bans.data FROM user_bans INNER JOIN user_login ON user_bans.id_u = user_login.id WHERE user_bans.data Like '$danedata' ORDER BY data DESC";
                  }
                  else if ($wybor == 'id')
                  {
                     
                     $zapytanie ="SELECT user_bans.id,nick,ban_time,powod,user_bans.data FROM user_bans INNER JOIN user_login ON user_bans.id_u = user_login.id WHERE user_bans.id Like '$daned' ORDER BY id DESC";
                  }
                   else if ($wybor == 'id_u')
                  {
                     
                     $zapytanie ="SELECT user_bans.id,nick,ban_time,powod,user_bans.data FROM user_bans INNER JOIN user_login ON user_bans.id_u = user_login.id WHERE user_bans.id_u Like '$dane' ORDER BY id DESC";
                  }
                   else if ($wybor == 'ban_time')
                  {
                     
                     $zapytanie ="SELECT user_bans.id,nick,ban_time,powod,user_bans.data FROM user_bans INNER JOIN user_login ON user_bans.id_u = user_login.id WHERE user_bans.ban_time Like '$dane' ORDER BY user_bans.ban_time DESC";
                  }
                  else if ($wybor == 'powod')
                  {
                     
                     $zapytanie ="SELECT user_bans.id,nick,ban_time,powod,user_bans.data FROM user_bans INNER JOIN user_login ON user_bans.id_u = user_login.id WHERE user_bans.powod Like '$dane' ";
                  }
                  

                    
                    $wynik = $conn->query($zapytanie);
                    if($wynik->num_rows > 0)
                    {
                      while ($row = $wynik -> fetch_assoc())
                      {
                        echo '<tr>';
                        echo '<td>'.$row['id'].'</a></td>';
                        echo '<td>'.$row['nick'].'</td>';
                        echo '<td>'.$row['ban_time'].'</td>';
                        echo '<td>'.$row['powod'].'</td>';
                        echo '<td>'.$row['data'].'</td>';
                        echo '<td>'.'<a href ="usun_ban.php?id='.$row["id_u"].'" class="btn btn-danger">Usuń</a>'.'</td>';
                      }
                      echo '</tr>';

                  }
                ?>
                
              </tbody>
            </table>
              </div>
              <br /><a href="/" onClick="op('wyswietl_7'); return false;" class="btn btn-primary btn-lg btn-block">Użytkownicy</a>
              <div id="wyswietl_7" style="display:none">
                <br />
                 <?php
                    
                    include 'wyszukiwanie_uzytkownicy.php';  
                  ?>
                  <br />
                <table class="table table-dark">
              <thead class="thead-dark">
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Nick</th>
                <th scope="col">Email</th>
                <th scope="col">haslo</th>
                <th scope="col">Data</th>

                <th scope="col">Edycja/Usuń/Ban</th>
              </thead>
              <tbody>
                </tr>
                <?php
                     //wyszukiwajka z wyborem

                  $nazwa_tabeli = 'azyl_posty';
                  $wybor =$_GET['wyb_wysz_3'];
                  $dane =$_GET['pole_wysz_3'];

                  if (empty($wybor))
                  {
                    $zapytanie ="SELECT * FROM user_login ORDER BY id DESC";
                  }
                  else if ($wybor == 'data')
                  {
                     $danedata = $_GET['poka_data_3'];
                     
                     $zapytanie = "SELECT * FROM user_login WHERE  data Like '$danedata'";
                  }
                  else if ($wybor == 'id')
                  {
                     $zapytanie = "SELECT * FROM user_login WHERE id Like '%$dane%'";
                  }
                   else if ($wybor == 'nick')
                  {
                     $zapytanie = "SELECT * FROM user_login WHERE nick Like '%$dane%'";
                  }
                   else if ($wybor == 'email')
                  {
                     $zapytanie = "SELECT * FROM user_login WHERE  email Like '%$dane%'";
                  }
                  
                    $wynik = $conn->query($zapytanie);

                    if($wynik->num_rows > 0)
                    {
                      while ($row = $wynik -> fetch_assoc())
                      {
                        echo '<tr>';
                        echo '<td>'.$row['id'].'</a></td>';
                        echo '<td>'.$row['nick'].'</td>';
                        echo '<td>'.$row['email'].'</td>';
                        echo '<td>'.$row['haslo'].'</td>';
                        echo '<td>'.$row['data'].'</td>';

						
                        echo '<td>'.'<a href ="edycja_uzytkownika.php?id='.$row["id"].'" class="btn btn-info"> Edycja </a>';
                        echo ' <a href ="usun_uzytkownicy.php?id='.$row["id"].'" class="btn btn-warning"> Usuń </a>';
                        echo ' <a href ="ban_uzytkownicy.php?id='.$row["id"].'" class="btn btn-danger"> Ban </a>'.'</td>';
                      }
                      echo '</tr>';

                  }
                ?>
                
              </tbody>
            </table>
             <a href="dodawanie_uzytkownika.php" class="btn btn-success">Dodaj nowego użytkownika</a>
              </div>
              
              <div id="wyswietl_7" style="display:none">
                <table class="table table-dark">
              <thead class="thead-dark">
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Id_uzytownika</th>
                <th scope="col">Id_rangi</th>
                <th scope="col">Edycja</th>
        
              </thead>
              <tbody>
                </tr>
                <?php
                    $zapytanie ="SELECT * FROM user_ranga ORDER BY id DESC";
                    $wynik = $conn->query($zapytanie);
                    if($wynik->num_rows > 0)
                    {
                      while ($row = $wynik -> fetch_assoc())
                      {
                        echo '<tr>';
                        echo '<td>'.$row['id'].'</a></td>';
                        echo '<td>'.$row['id_u'].'</td>';
                        echo '<td>'.$row['id_r'].'</td>';
                        echo '<td>'.' <a href ="edycja_tabelek.php?id='.$row["id"].'" class="btn btn-danger">Edycja</a>'.'</td>';
                      }
                      echo '</tr>';

                  }
                ?>
                
              </tbody>
             </table>
              </div>
                 <?php
          	}
              ?>
              <br /><a href="/" onClick="op('wyswietl_8'); return false;" class="btn btn-primary btn-lg btn-block">Ilość czasu spedzanego na forum</a>
              <div id="wyswietl_8" style="display:none">
                <table class="table table-dark">
              <thead class="thead-dark">
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Id_uzytkownika</th>
                <th scope="col">Czas</th>
                <th scope="col">Edycja</th>
        
              </thead>
              <tbody>
                </tr>
                <?php
                    $zapytanie ="SELECT * FROM user_spend_time ORDER BY id DESC";
                    $wynik = $conn->query($zapytanie);
                    if($wynik->num_rows > 0)
                    {
                      while ($row = $wynik -> fetch_assoc())
                      {
                        echo '<tr>';
                        echo '<td>'.$row['id'].'</a></td>';
                        echo '<td>'.$row['id_u'].'</td>';
                        echo '<td>'.$row['czas'].'</td>';
                        echo '<td>'.'<a href ="edycja_tabelek.php?id='.$row["id"].'" class="btn btn-danger">Edycja</a>'.'</td>';
                      }
                      echo '</tr>';

                  }
                ?>
                
              </tbody>
              </table>
              </div>
              <br /><a href="/" onClick="op('wyswietl_9'); return false;" class="btn btn-primary btn-lg btn-block">Regulamin</a>
              <div id="wyswietl_9" style="display:none">
                <br /><button  data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-lg center-block">
                Regulamin<span class="glyphicon glyphicon-paperclip"></span>
                </button>
               <!-- Edycja regulaminu -->
               <form method="post" id="rejestracja" action="/gui_admin.php">
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Zamknij</span></button>
                        <h4 class="modal-title" id="myModalLabel">Regulamin Forum-azyl.pl</h4>
                      </div>
                      <div class="modal-body">
                        <textarea rows="20" cols="80" name="edycja_regulaminu" style="resize: none;">
                          <?php

                             echo readfile("regulamin.txt");

                            ?>
                          </textarea>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
                        <button type="submit" class="btn btn-success" name="zapisz_regulamin">Zapisz zmiany</button>

                      </div>
                      
                        
                    </div>
                  </div>
                </div>
              </form>

              </div>
              <br /><a href="/" onClick="op('wyswietl_10'); return false;" class="btn btn-primary btn-lg btn-block">News</a>
              <div id="wyswietl_10" style="display:none">
               <table class="table table-dark">
              <thead class="thead-dark">
                <tr>
                <th scope="col">Id_News</th>
                <th scope="col">Tytuł</th>
                <th scope="col">Treść</th>
                <th scope="col">Data powstania</th>
                <th scope="col">Edycja/Usuń</th>
                
              </thead>
              <tbody>
                </tr>
                <?php
                //Zrób pliki do tego
                    $zapytanie ="SELECT * FROM news ORDER BY id DESC";
                    $wynik = $conn->query($zapytanie);
                    if($wynik->num_rows > 0)
                    {
                      while ($row = $wynik -> fetch_assoc())
                      {
                        echo '<tr>';
                        echo '<td>'.$row['id'].'</a></td>';
                        echo '<td>'.$row['tytul'].'</td>';
                        echo '<td>'.$row['tresc'].'</td>';
                        echo '<td>'.$row['data'].'</td>';
                        echo '<td>'.'<a href ="edytor_news.php?id='.$row["id"].'" class="btn btn-info"> Edycja </a>';
                        echo ' <a href ="usuwanie_newsa.php?id='.$row["id"].'" class="btn btn-danger"> Usuń </a>'.'</td>';
                        
                      }
                      echo '</tr>';

                  }
                ?>
                
              </tbody>
            </table>
              </div>
              <?php
                          //edycja regulaminu w panelu cruda
                          if(isset($_POST['zapisz_regulamin']))
                            {

                                    $regulamin = $_POST['edycja_regulaminu'];

                                    /// otwarcie pliku do zapisu
                                    $fp = fopen("/var/www/html/regulamin.txt", "w+") or die("Nie można otworzyć pliku");;

                                    fwrite($fp, $regulamin);
                                    fclose($fp);
                                    echo "<script type=\"text/javascript\">window.alert('Udało sie zapisać');</script>";
                              
                            }  
                        ?>
          <?php  
         	 } 
            else 
            {
              echo 'Niemasz uprawnień do tego panelu';
            }
        ?>
  <!-- Site footer -->
        <footer class="footer">
          <p>© 2019 Aleksander Kowalski 'MrHDOLEK'</p>
        </footer>
</div>

</body>
</html>
