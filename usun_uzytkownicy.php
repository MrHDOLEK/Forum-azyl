<!DOCTYPE html>
<html>
<head>
  <title>Forum-azyl.pl</title>
  <meta charset="utf-8">
  <?php
    include 'c_baza.php';
  ?>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="style_forum.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body oncontextmenu="return false">
<?php
//Spr czy dany user ma odpowiednia moc uprawnien
if ($_SESSION["moc_upr"] >= 100)
{  

  $id = $_GET['id'];
  //usuwanie postow i komenatrzy usera
    $usuwanie_usera_kom = "DELETE FROM forum_odpowiedzi WHERE id_u='$id'";
    $wynik_kom = $conn->query($usuwanie_usera_kom);
  //
    $usuwanie_usera_postow = "DELETE FROM azyl_posty WHERE id_u='$id'";
    $wynik_post = $conn->query($usuwanie_usera_postow);
  //usuwanie usera z rangi
    $usuwanie_usera_rangi = "DELETE FROM user_ranga WHERE id_u='$id'";
    $wynik_ranga = $conn->query($usuwanie_usera_rangi);
  //usuwanie usera calkowicie
    $usuwanie_usera = "DELETE FROM user_login WHERE id='$id'";
    $wynik_usera = $conn->query($usuwanie_usera);
    echo '<p class="bg-success">Rekord został usunięty nastąpi przeniesienie</p>';
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