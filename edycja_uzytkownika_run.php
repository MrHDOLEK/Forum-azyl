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
//Spr czy dany user ma odpowiednia moc uprawnien
if ($_SESSION["moc_upr"] >= 100)
{  
  
  $id = $_GET['inputID'];
  $nick=$_GET['inputNazwa'];
  $email=$_GET['inputEmail'];
  $data=$_GET['inputData'];
  //szyfrowanie
  $salt = "azyl46515215115615616";
  $haslo = $_GET['inputHaslo'].$salt;
  $haslo = sha1($haslo);

  $sql = "UPDATE user_login SET nick = '$nick',email = '$email',haslo = '$haslo',data = '$data' WHERE id='$id'";
  $result=$conn->query($sql);
  $ranga = $_GET['ranga'];
  $sql_ranga = "UPDATE user_ranga SET id_u = '$id',id_r = '$ranga' WHERE id_u='$id'";
  $wynik_ranga=$conn->query($sql_ranga);





  echo '<div class="alert alert-success" role="alert"> <strong>';
    echo "Dane zostały zmienione </strong>";
    echo "</div>";
  header("Refresh: 2; URL=gui_admin.php");
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