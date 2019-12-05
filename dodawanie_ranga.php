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
<?php
if ($_SESSION["moc_upr"] >= 100)
  {
?>
  <div class="container">

      <form method="POST" id="dodanie" action="/dodawanie_ranga.php" onreset='if (!confirm("Czy na pewno chcesz zresetować cały formularz?")) return false'>
                         <table>
                              <tr><td>Id</td><td><input type="text" id="inputID" name="inputID" maxlenght="50"  readonly ></td></tr>
                              <tr><td>Nazwa rangi: </td><td><input type="text" id="inputNazwa" name="inputNazwa" maxlenght="50"  required></td></tr>
                              <tr><td>Opis rangi: </td><td><input type="text" id="inputOpis" name="inputOpis" maxlenght="255"  required></td></tr>
                              <tr><td>Moc rangi: </td><td><input type="number" name="inputMoc" value="0" min="0" max="100" /></td></tr>
                              
                          </table>
                          <div style="text-align: left;">
                            <input type="submit" class="btn btn-success"></input>
                            <input type="reset" value="Reset" class="btn btn-danger"></input>

                         </div>
                        </form>;
      <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
          {
            
            $nazwa=$_POST['inputNazwa'];
            $opis=$_POST['inputOpis'];
            $moc=$_POST['inputMoc'];
            $sql = "INSERT INTO ranga (nazwa,opis,value)
            VALUES ('$nazwa','$opis','$moc')";
            if ($conn->query($sql) === TRUE) 
                {
                  
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