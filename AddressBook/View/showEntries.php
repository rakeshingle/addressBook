<?php
$jsonObj = $model->showEntries();
?>
 <center>
    <table border="2" style="width: 100%;text-align: center;">
        <tr><th>Name</th><th>First Name</th><th>Street</th><th>Zipcode</th><th>City</th><th></th></tr>
           <?php
              $arrAddresses = json_decode($jsonObj);
              if(count($arrAddresses) > 0)
              {
                for ($i=0; $i < count($arrAddresses); $i++)
                {
                  echo "<tr>";
                    echo "<td>".$arrAddresses[$i]->name."</td>";
                    echo "<td>".$arrAddresses[$i]->first_name."</td>";
                    echo "<td>".$arrAddresses[$i]->steert."</td>";
                    echo "<td>".$arrAddresses[$i]->zipcode."</td>";
                    echo "<td>".$arrAddresses[$i]->city."</td>";
                    
                    echo "<td><a href='index.php?a=editEntries&m=list&id=".$arrAddresses[$i]->id."'>Edit</a></td>";
                  echo "</tr>";
                }

              }else
              {
                  echo "No Data Found!";
              }
             ?>
    </table>
     <div><a href="index.php?a=createXMLfile&m=list">Export list to XML</a></div>
</center>
