<head>
  <script src="ckeditor/ckeditor.js"></script>
</head>
<body oncontextmenu="return false">
<?php
   include 'c_baza.php';
  $id = $_GET['id'];  
  $start = new DateTime($results->start);
  $start->format('Y-m-d'); 
  $data = date('Y-m-d');
?>
<form method="POST" id="dodanie" action="/ban_uzytkownicy.php">
                   <table>
                    <?php
                      echo '<tr><td>Id użytkownika:</td><td><input type="text" id="inputID" name="inputID" maxlenght="50" 
                       value='.$id.'  readonly></td></tr>';
                    ?>
                        
                        <tr><td>Ban time: </td>
                        <td>Do: <input type="date" id="do" name="do"  required>
                        </td></tr>
                        <tr><td>Powód: </td><td><textarea class="form-control" rows="5" id="powod" maxlength="255" name="powod" required></textarea></td></tr>
                        <?php
                        echo '<tr><td>Data: </td><td><input type="date" id="inputData" name="inputData" value='.$data.' required readonly></td></tr>';
                        ?>
                        
                    </table>
                    <div style="text-align: left;">
                      <input type="submit"></input>
                      <input type="reset" value="Reset">

                   </div>
                  </form>;
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
      $data_do = $_POST['do'];
      $powod=$_POST['powod'];
      $ban_time = (strtotime($data_do) - strtotime($data)) / (60*60*24);
      $id_u = $_POST['inputID'];
      $sql = "INSERT INTO user_bans (id_u,ban_time,powod,data)
      VALUES ('$id_u','$ban_time','$powod','$data')";
      if ($conn->query($sql) === TRUE) 
          {
            
        } 
        else 
        {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
        echo "<script type=\"text/javascript\">window.alert('Udało się zbanować');</script>";
        header("Location: gui_admin.php");
        exit;


  }
?>
<script>
    CKEDITOR.replace( 'powod' );
</script>
</body>