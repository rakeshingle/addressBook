<?php

    if ($strErrorMsg != "")
    {
        echo "<div style='color: red;text-align:center;'>".$strErrorMsg."</div>";
    }
    $jsonEntry = $model->getEntryById($id);
    $arrAddressEntry = json_decode($jsonEntry);
    if (count($arrAddressEntry) > 0)
    {
?>
        <form action="index.php?a=updateEntry&m=list&id=<?php echo $arrAddressEntry[0]->id; ?>" method="post">
            <center>
                <div style="border:1px solid gray;">
                    <table border="0" style="width: 25%;">
                        <tr><td>Name</td><td><input type="text" name="name"  value="<?php echo $arrAddressEntry[0]->name; ?>"></input></td></tr>
                        <tr><td>First Name</td><td><input type="text" name="first_name" value="<?php echo $arrAddressEntry[0]->first_name; ?>"></input></td></tr>
                        <tr><td>Street</td><td><input type="text" name="street" value="<?php echo $arrAddressEntry[0]->steert; ?>"></input></td></tr>
                        <tr><td>Zipcode</td><td><input type="text" name="zipcode" value="<?php echo $arrAddressEntry[0]->zipcode; ?>"></input></td></tr>
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
                                  if ($arrAddressEntry[0]->city == $arrCities[$i]->city){
                                    echo "<option name='".$arrCities[$i]->city."' selected>".$arrCities[$i]->city."</option>";
                                  } else {
                                    echo "<option name='".$arrCities[$i]->city."'>".$arrCities[$i]->city."</option>";
                                  }
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
<?php
    }
?>
