<?php
class addressBookModel
{
  public $servername = "localhost";
  public $username = "root";
  public $password = "";
  public $dbname = "address_book_db";
  public $connection;

  function __construct()
  {
    // Create connection
     $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    // Check connection
    if ($this->connection->connect_error) {
        die("Connection failed: " . $this->connection->connect_error);
    }
  }

  public function showEntries()
  {
    $sql = "SELECT * FROM address_book_tbl";
    $result = $this->connection->query($sql);

    if ($result->num_rows > 0) {
        $rows = array();
        while($row = $result->fetch_assoc()) {
            array_push($rows, $row);
        }
        return json_encode($rows);
    } else {
        return false;
    }

    disconnectFromDatabase();
  }

  public function getCities()
  {
    $sql = "SELECT * FROM city_tbl";
    $result = $this->connection->query($sql);

    if ($result->num_rows > 0) {
        $rows = array();
        while($row = $result->fetch_assoc()) {
            array_push($rows, $row);
        }
        return json_encode($rows);
    } else {
        return false;
    }

    disconnectFromDatabase();
  }

  public function addEntries($array)
  {
    $sql = "INSERT INTO address_book_tbl(name, first_name, steert, zipcode, city, created_date, modified_date)
            VALUES ('".$array[0]."','".$array[1]."','".$array[2]."','".$array[3]."','".$array[4]."',now(),now())";
    $result = $this->connection->query($sql);

    if ($result === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $this->connection->error;
    }
    // disconnectFromDatabase();
    $this->connection->close();
  }

   public function getEntryById($id=0)
  {
    $sql = "SELECT * FROM address_book_tbl WHERE id =".$id;
    $result = $this->connection->query($sql);

    if ($result->num_rows > 0) {
        $rows = array();
        while($row = $result->fetch_assoc()) {
            array_push($rows, $row);
        }
        return json_encode($rows);
    } else {
        return false;
    }

    disconnectFromDatabase();
  }
  
  public function editEntries($array, $id)
  {
    $sql = "UPDATE address_book_tbl SET name = '".$array[0]."', first_name = '".$array[1]."', steert = '".$array[2]."', zipcode = '".$array[3]."', city = '".$array[4]."', modified_date = now() where id = ".$id;
    $result = $this->connection->query($sql);

    if ($result === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $this->connection->error;
    }
    $this->connection->close();
  }
  
  function disconnectFromDatabase(){
    $this->connection->close();
  }
}


?>
