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
<?php

  include 'c_baza.php';
    $id = $_POST['id_p'];
    $tytul = $_POST['tytul'];
    $tresc = $_POST['news_edi'];
    
             $zapytanie1 ="UPDATE news SET tytul='$tytul',tresc='$tresc' WHERE id='$id'";
              $wynik1 = $conn->query($zapytanie1);
    $result=$conn->query($sql);
    echo '<div class="alert alert-success" role="alert"> <strong>';
      echo "Dane zostały zmienione </strong>";
      echo "</div>";
    header("Refresh: 2; URL=gui_admin.php");
?>
</body>
</html>