<?php

//require configuration
require_once('config.php');

// require entities
require_once('entities/Medicine.php');

//Require Utillity Classes
require_once('PDOAgent.class.php');
require_once('Utilities/MedicineDAO.class.php');

/*
Create  - INSERT - POST
Read    - SELECT - GET
Update  - UPDATE - PUT
DELETE  - DELETE - DELETE
*/


MedicineDAO::initialize();

//Pull the request data
// parse_str(file_get_contents('php://input'), $requestData);
$requestData = json_decode(file_get_contents('php://input'));

// CODEIGNITER CUSTOM $this->input->raw_input_stream;
// $requestData = json_decode($this->input->raw_input_stream);


//Do something based on the request
switch ($_SERVER["REQUEST_METHOD"])   {

    case "POST":    //Picked up a POST, Its Insert time!
     
    // new Medicine
    $nm = new Medicine();
    $nm->setMedicineName($requestData->MedicineName);
    $nm->setTreatment($requestData->Treatment);
    $nm->setDescription($requestData->Description);

    $result = MedicineDAO::createMedicine($nm);

    //Return the results
    header('Content-Type: application/json');
    echo json_encode($result);
   
    break;

    //If there was a request with an id return that medicine, if not return all of them!
    case "GET":
      
    if (isset($requestData->id))    {

        //Return the customer object
        $sm = MedicineDAO::getMedicine($requestData->id);

        //Set the header
        header('Content-Type: application/json');
        //Barf out the JSON version
        echo json_encode($sm->jsonSerialize());

    } else {

        //All the customers!
        $medicines = MedicineDAO::getAllMedicine();
        
        
        //Walk the customers and add them to a serialized array to return.
        $serializedMedicine = array();

        foreach ($medicines as $medicine)    {
            var_dump($medicine);
            $serializedMedicine[] = $medicine->jsonSerialize();
        }
       
        //Set the header
        header('Content-Type: application/json');
        //Return the entire array
        echo json_encode($serializedMedicine);            
    }
    break;
   
    case "PUT":

        //Must be an update, build the new medicine object
        $em = new Medicine();
        $em->setMedicineName($requestData->id);
        $em->setTreatment($requestData->Treatment);
        $em->setDescription($requestData->Description);
       
        $result = MedicineDAO::updateMedicine($em);
        //Set the header
        header('Content-Type: application/json');
        //Return the number of rows affected
        echo json_encode($result);

    break;

    case "DELETE":
        //In YARC send the request as key=value
        //Pull the ID, send it to delete via the customer mapper and return the result.
        $result = MedicineDAO::deleteMedicine($requestData->id);

        //Set the header
        header('Content-Type: application/json');
        //return the confirmation of deletion
        echo json_encode($result);
        
    break; 

    default:
        echo json_encode(array("message"=> "Você fala HTTP?"));
    break;
}



?>
