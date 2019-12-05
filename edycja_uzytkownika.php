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
  $id = $_GET['id'];
  $zapytanie = "SELECT * FROM user_login WHERE id='$id'";

  $sql_ranga = "SELECT * FROM ranga";
  $wynik_ranga = $conn->query($sql_ranga);

  $wynik = $conn->query($zapytanie);

            if($wynik->num_rows > 0)
            {
                
                while($row = $wynik -> fetch_assoc())
                {
                  
                    echo '      
                <form method="GET" id="Edycja" action="/edycja_uzytkownika_run.php" onreset="if (!confirm("Czy na pewno chcesz zresetować cały formularz?")) return false">
                   <table>
                        <tr><td>Id</td><td><input type="text" id="inputID" name="inputID" maxlenght="10" value="'.$row["id"].'" readonly required></td></tr>
                        <tr><td>Nazwa użytkownika: </td><td><input type="text" id="inputNazwa" name="inputNazwa" maxlenght="40" value="'.$row["nick"].'" required></td></tr>
                        <tr><td>Email: </td><td><input type="email" id="inputEmail" name="inputEmail" maxlenght="40" value="'.$row["email"].'" required></td></tr>
                        <tr><td>Hasło: </td><td><input type="password" id="inputHaslo" name="inputHaslo" maxlenght="40" value="'.$row["haslo"].'" required></td></tr>
                        </select></td></tr>
                        <tr><td>Data</td><td><input type="date" id="inputData" name="inputData" value="'.$row["data"].'" readonly required></td></tr>
                        <tr><td>Ranga :</td><td>
                        <select name="ranga">';
                          while($row = mysqli_fetch_array($wynik_ranga)) 
                          {
                            echo('<option value="'.$row['id_r'].'">'.$row['nazwa'].'</option>');
                          }
                        echo '</select></td></tr>
                        

                        
                    </table>
                   <div style="text-align: left;">
                      <input type="submit" class="btn btn-success"></input>
                      <input type="reset" value="Reset" class="btn btn-danger"></input>

                   </div>
                  </form>';
                }
              echo '</table>';
                        }
            else{
                echo "Brak danych";
            }
            }

else 
{
   echo '<div class="alert alert-danger" role="alert"> <strong>';
  echo "Nie masz potrzebnych uprawnien do tego panelu </strong>";
  echo "</div>";
  header("Refresh: 2; URL=gui_admin.php");
}
                            
?>
</div>
</body>
</html>