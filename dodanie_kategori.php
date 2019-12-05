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
<form method="POST" id="dodanie" action="/dodanie_kategori.php" onreset='if (!confirm("Czy na pewno chcesz zresetować cały formularz?")) return false'>
                   <table>
                        <tr><td>Id: </td><td><input type="text" id="inputID" name="inputID" maxlenght="50" readonly required></td></tr>
                        <tr><td>Nazwa kategori: </td><td><input type="text" id="inputKategoria" name="inputKategoria" maxlenght="50"  required></td></tr>
                        
                    </table>
                    <div style="text-align: left;">
                       <input type="submit" class="btn btn-success"></input>
                          <input type="reset" value="Reset" class="btn btn-danger"></input>

                   </div>
                  </form>;
<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
      
      $nazwa=$_POST['inputKategoria'];
      $sql = "INSERT INTO forum_kateg (nazwa)
      VALUES ('$nazwa')";
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
</body>
</html>