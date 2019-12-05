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
	$zapytanie = "DELETE FROM user_bans WHERE id_u='$id'";
	$result = $conn->query($zapytanie);
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