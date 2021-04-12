<?php
      $link = mysqli_connect("localhost","speedway1","speedway1","hhh");
    
      // Check connection
      if($link === false){
       die("ERROR: Could not connect. " . mysqli_connect_error());
      }
    
      $sql = "SELECT * FROM fuel";
      if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result)>0){
          echo "<div class=\"table-responsive\">";
            echo "<table class=\"table table-bordered\">";
            echo "<thead>";
            echo "<tr align=\"center\">";
            echo "<th>FEDEX</th>";              
            echo "<th>UPS</th>";
            echo "<th>DHL</th>";
            echo "<th>TNT</th>";
            echo "<th>SKY</th>";
            echo "<th>AIRWINGS</th>";
            echo "<th>ARAMEX</th>";
            echo "</tr>";
            echo "</thead>";
            
            while($row = mysqli_fetch_array($result)){
              echo "<caption align=\"top\">" . "CURRENT FUEL FOR " . $row['month'] . " MONTH" . "</caption>";
             
              echo "<tbody>";
              echo "<tr>";
              echo "<td align=\"center\">" . $row['fedex'] . "%". "</td>";               
              echo "<td align=\"center\">" . $row['ups'] . "%". "</td>";
              echo "<td align=\"center\">" . $row['dhl'] . "%". "</td>";
              echo "<td align=\"center\">" . $row['tnt'] . "%". "</td>";
              echo "<td align=\"center\">" . $row['sky'] . "%". "</td>";
              echo "<td align=\"center\">" . $row['airwings'] . "%". "</td>";
              echo "<td align=\"center\">" . $row['aramex'] . "%". "</td>";
              echo "</tr>";
              echo "</tbody>";
              
              
          echo "</div>";
         
          }
          
        }
        
      } 
 ?>
