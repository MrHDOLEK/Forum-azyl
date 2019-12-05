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
      $zapytanie = "SELECT * FROM ranga WHERE id_r='$id'";


      $wynik = $conn->query($zapytanie);

                if($wynik->num_rows > 0)
                {
                    
                    while($row = $wynik -> fetch_assoc())
                    {
                      
                        echo '      
                    <form method="GET" id="Edycja" action="/edycja_ranga_run.php" onreset="if (!confirm("Czy na pewno chcesz zresetować cały formularz?")) return false">
                       <table>
                            <tr><td>Id</td><td><input type="text" id="inputID" name="inputID" maxlenght="50" value="'.$row["id_r"].'" readonly required></td></tr>
                            <tr><td>Nazwa rangi: </td><td><input type="text" id="inputNazwa" name="inputNazwa" maxlenght="50" value="'.$row["nazwa"].'" required></td></tr>
                            <tr><td>Opis rangi: </td><td><input type="text" id="inputOpis" name="inputOpis" maxlenght="255" value="'.$row["opis"].'" required></td></tr>
                            <tr><td>Moc rangi: </td><td><input type="number" name="inputMoc" min="0" max="100" value="'.$row["value"].'" required></td></tr>
                            
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