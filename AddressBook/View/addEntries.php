<?php 
    if ($strErrorMsg != "")
    {
        echo "<div style='color: red;text-align:center;'>".$strErrorMsg."</div>";
    }
?>
<form action="index.php?a=saveEntries&m=list&id=0" method="post" >
    <center>
        <div style="border:1px solid gray;">
            <table border="0" style="width: 25%;">
                <tr><td>Name</td><td><input type="text" name="name"  placeholder="Name"></input></td></tr>
                <tr><td>First Name</td><td><input type="text" name="first_name" placeholder="First Name"></input></td></tr>
                <tr><td>Street</td><td><input type="text" name="street" placeholder="street"></input></td></tr>
                <tr><td>Zipcode</td><td><input type="text" name="zipcode" placeholder="Zipcode"></input></td></tr>
                <tr><td>City</td>
                    <td>
                    <?php
                      $jsonCity = $model->getCities();
                      $arrCities = json_decode($jsonCity);
                      if(count($arrCities) > 0)
                      {
                        echo "<select name='city' placeholder='City'>";
                        for ($i=0; $i < count($arrCities); $i++)
                        {
                          echo "<option name='".$arrCities[$i]->city."'>".$arrCities[$i]->city."</option>";
                        }
                        echo "</select>";
                      }
                     ?>
                    </td>
                </tr>
                <tr><td colspan="2" style="text-align: center;"><input type="submit" name="Save"></input></td></tr>
            </table>
        </div>
    </center>
</form>
