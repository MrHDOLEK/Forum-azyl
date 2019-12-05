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
  <style type="text/css">
    input{
      padding: 5px;
      margin: 0.5%;
    }
  </style>
</head>
<body oncontextmenu="return false">
  <div class="container">
    <?php 
    //Spr czy dany user ma odpowiednia moc uprawnien
      if ($_SESSION["moc_upr"] >= 100)
      {  
        $results->start;
        $start = new DateTime($results->start);
        $start->format('Y-m-d'); 
        $data = date('Y-m-d');

      ?>
    <form method="post" id="Edycja" action="/dodawanie_uzytkownika.php" onreset="if (!confirm('Czy na pewno chcesz zresetować cały formularz?')) return false">
                       <table>
                            <tr><td>Id :</td><td><input type="text" id="inputID" name="inputID" maxlength="50" readonly></td></tr>
                        
                            <tr><td>Nazwa użytkownika:</td><td><input type="text" id="inputNazwa" name="inputNazwa" maxlength="40" required></td></tr>
                            <tr><td>Email: </td><td><input type="email" id="inputEmail" name="inputEmail" maxlength="40" required></td></tr>
                            <tr><td>Hasło: </td><td><input type="password" id="inputHaslo" name="inputHaslo" maxlength="40" required></td></tr>
                          <?php
                            echo '<tr><td>Data: </td><td><input type="date" id="inputData" name="inputData" value='.$data.' required readonly></td></tr>';
                            ?>
                            
                            
                        </table>
                       <div style="text-align: left;">
                          <input type="submit" class="btn btn-info"></input>
                          <input type="reset" value="Reset" class="btn btn-danger">
                          
                       </div>
                      </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
          $nick=$_POST['inputNazwa'];
          $email=$_POST['inputEmail'];
          //szyfrowanie
          $salt = "azyl46515215115615616";
              $haslo = $_POST['inputHaslo'].$salt;
              $haslo = sha1($haslo);
              
          $sql = "INSERT INTO user_login (nick,email,haslo,data)
          VALUES ('$nick','$email','$haslo','$data')";
          if ($conn->query($sql) === TRUE) 
              {
                //pobranie id usera
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
            echo "<script type=\"text/javascript\">window.alert('Udało sie zapisać');</script>";
            header("Location: gui_admin.php");
            exit;


      }
    ?>
</div>
<?php
}
  else 
  {
     echo '<div class="alert alert-danger" role="alert"> <strong>';
    echo "Nie masz potrzebnych uprawnien do tego panelu </strong>";
    echo "</div>";
    header("Refresh: 2; URL=gui_admin.php");
  }
?>
</body>
</html>