<body oncontextmenu="return false">
<script>
  function pokaz_data() 
  {
    var x = document.getElementById("poka_data_2");
    var y = document.getElementById("pole_wysz_2");
      x.style.display = "block";
      y.style.display = "none";
 } 
   function ukryj_data() 
  {
     var x = document.getElementById("poka_data_2");
    var y = document.getElementById("pole_wysz_2");
      x.style.display = "none";
      y.style.display = "block";
 }         
</script>
<form method="GET" action="gui_admin.php" name="wyszukiwarka"/>
              <input type="text" name="pole_wysz_2" id='pole_wysz_2' style="display: block" />
              <input type="date" name="poka_data_2"  id="poka_data_2" style="display: none" />
               <select name="wyb_wysz_2">
                <?php  
                 

                    $zapytanie = "DESCRIBE user_bans";
                    $wynik = $conn->query($zapytanie);
                    if($wynik->num_rows > 0)
                    {
                      while ($row = $wynik -> fetch_assoc())
                      {
                        if ($row['Field'] == 'data')
                        {
                           echo('<option value="'.$row['Field'].'" onclick="pokaz_data()">Wyszukaj po '.$row['Field'].'</option>');
                        }
                        else 
                        {
                          echo('<option value="'.$row['Field'].'" onclick="ukryj_data()">Wyszukaj po '.$row['Field'].'</option>');
                        }
                       
                        

                      }
                      

                  }


                ?>
               	  

              </select> 
              <input type="submit" value="Wyszukaj" class="btn btn-info" />

</form>
</body>