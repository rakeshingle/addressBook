<?php
class addressBookController extends defaultController
{
    public $model = null;
    public $errorMessage = "";

    public function __construct()
    {
        $this->model = new addressBookModel();
    }

    public function showEntries($value = 0)
    {
        $model = $this->model;
        include 'View/header.php';
        include 'View/showEntries.php';
        include 'View/footer.php';
    }

    public function addEntries()
    {
        $model = $this->model;
        $strErrorMsg = $this->errorMessage;
        
        include 'View/header.php';
        include 'View/addEntries.php';
        include 'View/footer.php';
    }

    public function saveEntries()
    {
      $name = $_POST['name'];
      $first_name = $_POST['first_name'];
      $street = $_POST['street'];
      $zipcode = $_POST['zipcode'];
      $city = $_POST['city'];
      
        // Required field names
        $required = array('name', 'first_name', 'street', 'zipcode', 'city');

        // Loop over field names, make sure each one exists and is not empty
        $error = false;
        foreach($required as $field) {
          if (empty($_POST[$field])) {
            $error = true;
          }
        }

      if (!$error)
      {
        $params = array($name, $first_name, $street, $zipcode, $city);
        $model = $this->model;

        $result = $model->addEntries($params);

        if($result == true)
        {
            $this->showEntries();
        } 
      }else{
          // All fields required
          $this->errorMessage = "All fields are required!";
          $this->addEntries();
      }
    }
    
    public function editEntries($id = 0)
    {
        $model = $this->model;
        $strErrorMsg = $this->errorMessage;
        
        include 'View/header.php';
        include 'View/editEntries.php';
        include 'View/footer.php';
    }
    
    public function updateEntry($id=0)
    {
      $name = $_POST['name'];
      $first_name = $_POST['first_name'];
      $street = $_POST['street'];
      $zipcode = $_POST['zipcode'];
      $city = $_POST['city'];

    // Required field names
    $required = array('name', 'first_name', 'street', 'zipcode', 'city');

    // Loop over field names, make sure each one exists and is not empty
    $error = false;
    foreach($required as $field) {
      if (empty($_POST[$field])) {
        $error = true;
      }
    }      
      
    if (!$error)
    {
      $params = array($name, $first_name, $street, $zipcode, $city);
      $model = $this->model;

      $result = $model->editEntries($params, $id);

      if($result == true)
      {
          showEntries();
      }
    }else{
        // All fields are required.
        $this->errorMessage = "All fields are required!";
        $this->editEntries($id);

    }
   }
   
   public function createXMLfile()
   {
    include 'View/header.php';   
    $model = $this->model;
    $jsonObj = $model->showEntries();
    $arrAddressbook = json_decode($jsonObj);
    
    if(count($arrAddressbook) > 0)
    {
  
        $filePath = 'addressbook.xml';

        $dom     = new DOMDocument('1.0', 'utf-8'); 

        $root      = $dom->createElement('addressbook'); 

        for($i=0; $i<count($arrAddressbook); $i++){

          $Id               =  $arrAddressbook[$i]->id;  

          $strName          =   htmlspecialchars($arrAddressbook[$i]->name);

          $strFirstName     =  htmlspecialchars($arrAddressbook[$i]->first_name); 

          $strStreet        =  htmlspecialchars($arrAddressbook[$i]->steert); 

          $strCity          =  htmlspecialchars($arrAddressbook[$i]->city); 

          $strZipcode       =  $arrAddressbook[$i]->zipcode;

          $domUserAddress = $dom->createElement('user');

          $domUserAddress->setAttribute('id', $Id);

          $name     = $dom->createElement('name', $strName); 

          $domUserAddress->appendChild($name); 

          $firstname   = $dom->createElement('first_name', $strFirstName); 

          $domUserAddress->appendChild($firstname); 

          $street    = $dom->createElement('street', $strStreet); 

          $domUserAddress->appendChild($street); 

          $zipcode     = $dom->createElement('zipcode', $strZipcode); 

          $domUserAddress->appendChild($zipcode); 

          $city = $dom->createElement('city', $strCity); 

          $domUserAddress->appendChild($city);

          $root->appendChild($domUserAddress);

       }

       $dom->appendChild($root); 

       $result = $dom->save($filePath); 
       
    if ($result == FALSE){
        echo "Error occured while generating XML. Please try again!";
    } else {
       echo "Addressbook XML generated successfully with name: ".$filePath;
    }
    }else{
        echo "No Data to export";   
    }
    include 'View/footer.php';
 }
}
?>
