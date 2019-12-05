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
        include 'c_baza.php';  
        $results->start;
        $start = new DateTime($results->start);
        $start->format('Y-m-d'); 
        $id_kat = $_GET['id'];
        $sql_kate = "SELECT * FROM forum_kateg WHERE id_k = '$id_kat'";
        $wynik_kate = $conn->query($sql_kate);
      ?>
    <form method="post" id="Edycja" action="/dodawanie_tabeli_posty_user.php" onreset='if (!confirm("Czy na pewno chcesz zresetować cały formularz?")) return false'>
                       <table>
                            <tr><td>Id :</td><td><input type="text" id="inputID" name="inputID" maxlength="50" readonly></td></tr>
                            <tr><td>Id_Kategori :</td><td>
                            <select name="kategorie">
    							<?php
    								while($row = mysqli_fetch_array($wynik_kate)) 
    								{
    								  echo('<option value="'.$row['id_k'].'">'.$row['nazwa'].'</option>');
    								}
    							?>
    						</select></td></tr>
                            <tr><td>Tytuł postu :</td><td><input type="text" id="inputTytul" name="inputTytul" maxlength="50" required></td></tr>
                            <?php
                            echo '<tr><td>Nick :</td><td><input type="text" id="inputNick" name="inputNick" maxlength="50" value="'.$_SESSION["nick"].'" readonly></td></tr>';
                            ?>
                            <tr><td>Tresc :</td><td><textarea class="form-control" rows="5" id="tresc" maxlength="255" name="tresc" required></textarea></td></tr>
                            
                        </table>
                       <div style="text-align: left;">
                           <input type="submit" class="btn btn-success"></input>
                          <input type="reset" value="Reset" class="btn btn-danger"></input>
                          
                       </div>
                      </form>
                      <script>
                        CKEDITOR.replace( 'tresc' );
                      </script>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
          $id_kateg=$_POST['kategorie'];
          $tytul=$_POST['inputTytul'];
          $wlasciciel =$_POST['inputNick'];
          $tresc = $_POST['tresc'];
          $data = date('Y-m-d');
          $sql = "INSERT INTO azyl_posty (id_k,tytul_postu,wlasciciel,tresc,data)
          VALUES ('$id_kateg','$tytul','$wlasciciel','$tresc','$data')";
          if ($conn->query($sql) === TRUE) 
              {
                
            } 
            else 
            {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
            echo "<script type=\"text/javascript\">window.alert('Udało sie zapisać');</script>";
            header("Location: forum.php");
            exit;


      }
    ?>
</div>
</body>
</html>