<!DOCTYPE html>
<html>
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
</head>
<body oncontextmenu="return false">
<?php
    include 'c_baza.php';  
    $id = $_GET['id'];
?>
 <div class="container">
	<!-- Odczytywanie wiadomosci -->
	<div id="Form_wysw">
		<h3>Nadawca:</h3>
	<?php
		$zapytanie = "SELECT * FROM azyl_zapytania WHERE id='$id'";
		$wynik = $conn->query($zapytanie);

            if($wynik->num_rows > 0)
            {
                
                while($row = $wynik -> fetch_assoc())
                {
                  $mail = $row['email'];
                    echo '      
                <form method="GET" id="wyswietl">
                   <table>

                        <tr><td>Imie i nazwisko</td><td><input type="text"  maxlenght="50" value="'.$row["imie_i_nazwisko"].'" readonly></td></tr>
                        <tr><td>temat</td><td><input type="text"  maxlenght="50" value="'.$row["temat"].'" readonly></td></tr>
                        <tr><td>Tresc</td><td><input type="text"  maxlenght="255" value="'.$row["tresc_wiadomosci"].'" readonly></td></tr>
                        <tr><td>Data</td><td><input type="date" id="inputData" name="inputData" maxlenght="40" value="'.$row["data"].'" readonly></td></tr>
                    </table>
                </form>';
           }
              echo '</table>';
                        }
            else{
                echo "Brak danych";
            }
     ?>
	</div>
	<!-- Wysylanie odp form -->
	<div id="Form_odp">
		<h3>Odpowiedz:</h3>
			<form method="GET" id="Odp" action="/azyl_zapytania_odp_run.php">
			                   <table>
			                        <tr><td>Imię:</td><td>
			                        	<input type="text" id="inputAutor" name="inputAutor" maxlength="50" required></td></tr>
			                       
			                        <tr><td>Temat:</td><td>
			                        	<input type="text" id="inputTemat" name="inputTemat" maxlength="50" required></td></tr>	
			                        <tr><td>Tresc :</td><td>
			                        	<textarea class="form-control" rows="5" id="tresc" maxlength="255" name="tresc" required></textarea></td></tr>
			                        <?php
			                        	echo '<input type="hidden" id="nadawca_email" name="nadawca_email" maxlenght="50" value="'.$mail.'" readonly>';
			                        	echo '<input type="hidden" id="id" name="id" maxlenght="50" value="'.$id.'" readonly>';
			                        ?>
			                    </table>
			                   <div style="text-align: left;">
			                      <input type="submit" class="btn btn-info"></input>
			                      <input type="reset" value="Reset" class="btn btn-danger">
			                      
			                   </div>
			</form>
	</div>
</div>
<script>
    CKEDITOR.replace( 'tresc' );
</script>
</body>
</html>
