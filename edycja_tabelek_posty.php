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


$id = $_GET['id'];
$zapytanie = "SELECT * FROM azyl_posty WHERE id='$id'";

$wynik = $conn->query($zapytanie);

            if($wynik->num_rows > 0)
            {
                
                while($row = $wynik -> fetch_assoc())
                {
                  
                    echo '      
                <form method="GET" id="Edycja" action="/edycja_tabelek_posty_run.php" onreset="if (!confirm("Czy na pewno chcesz zresetować cały formularz?")) return false">
                   <table>
                        <tr><td>Id :</td><td><input type="text" id="inputID" name="inputID" maxlenght="50" value="'.$row["id"].'" readonly required></td></tr>
                        <tr><td>Tytuł postu: </td><td><input type="text" id="inputTytul" name="inputTytul" maxlenght="50" value="'.$row["tytul_postu"].'" required></td></tr>
                        <tr><td>Wlasciciel: </td><td><input type="text" id="inputWlasciciel" name="inputWlasciciel" maxlenght="50" value="'.$row["wlasciciel"].'" required></td></tr>
                        <tr><td>Treść: </td><td><textarea  id="inputTresc" name="inputTresc" maxlenght="255"  required>'.$row["tresc"].'</textarea></td></tr>
                        <tr><td>Data :</td><td><input type="date" id="inputData" name="inputData" maxlenght="40" value="'.$row["data"].'" readonly required></td></tr>
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
  


  
                  

?>

 <script>
    CKEDITOR.replace( 'inputTresc' );
 </script>
</div>
</body>
</html>