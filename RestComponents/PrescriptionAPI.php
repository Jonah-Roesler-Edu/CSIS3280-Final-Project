<?php

//require configuration
require_once('config.php');

// require entities
require_once('entities/Prescription.php');
// require_once('JJG_Pharma\application\classes\Medicine.php');
// require_once('JJG_Pharma\entities\Medicine.php');


//Require Utillity Classes
require_once('PDOAgent.class.php');
require_once('Utilities/PrescriptionDAO.class.php');

/*
Create  - INSERT - POST
Read    - SELECT - GET
Update  - UPDATE - PUT
DELETE  - DELETE - DELETE
*/

// CREATE TABLE Prescription(
//     PrescriptionID INT(11) NOT NULL AUTO_INCREMENT,
//     ClientID INT(11) NOT NULL,
//     MedicineName VARCHAR(50),
//     Description VARCHAR(500), 
//     -- Something like dosage, etc
//     PRIMARY KEY(PrescriptionID),
//     FOREIGN KEY(ClientID) REFERENCES Client(ClientID) ON DELETE CASCADE ON UPDATE CASCADE
// );


PrescriptionDAO::initialize();

//Pull the request data
// parse_str(file_get_contents('php://input'), $requestData);
$requestData = json_decode(file_get_contents('php://input'));

// CODEIGNITER CUSTOM $this->input->raw_input_stream;
// $requestData = json_decode($this->input->raw_input_stream);


//Do something based on the request
switch ($_SERVER["REQUEST_METHOD"])   {

    case "POST":    //Picked up a POST, Its Insert time!
     
    // new Prescription
    $prescritpion = new Prescription();
    $prescritpion->setClientID($requestData->ClientID);
    $prescritpion->setMedicineName($requestData->MedicineName);
    $prescritpion->setDescription($requestData->Description);

    $result = PrescriptionDAO::createPrescription($prescritpion);

    //Return the results
    header('Content-Type: application/json');
    echo json_encode($result);
   
    break;

    case "GET":
      
    if (isset($requestData->ClientID))    {

        //Get the client's prescriptions
        $prescritpions = PrescriptionDAO::getPrescriptionsByClient($requestData->ClientID);
        
        //Walk the customers and add them to a serialized array to return.
        $jsonPrescriptions = array();

        //PLEASE DONT PUT VAR DUMPS IN HERE AS IT BREAKS IT
        foreach ($prescritpions as $prescritpion)    {
            // var_dump($medicine);
            $jsonPrescriptions[] = $prescritpion->jsonSerialize();
        }
       
        //Set the header
        header('Content-Type: application/json');
        //Return the entire array
        echo json_encode($jsonPrescriptions); 

    } else if (isset($requestData->PrescriptionID)) {
        $prescritpion = PrescriptionDAO::getPrescription($requestData->PrescriptionID);

        //Set the header
        header('Content-Type: application/json');
        //Return the entire array
        echo json_encode($prescritpion->jsonSerialize()); 
    }
    break;
   
    case "PUT":

        //Must be an update, build the new medicine object
        $prescritpion = new Prescription();
        $prescritpion->setPrescriptionID($requestData->PrescriptionID);
        $prescritpion->setClientID($requestData->ClientID);
        $prescritpion->setMedicineName($requestData->MedicineName);
        $prescritpion->setDescription($requestData->Description);
       
        $result = PrescriptionDAO::updatePrescription($prescritpion);
        //Set the header
        header('Content-Type: application/json');
        //Return the number of rows affected
        echo json_encode($result);

    break;

    case "DELETE":
        //In YARC send the request as key=value
        //Pull the ID, send it to delete via the customer mapper and return the result.
        $result = PrescriptionDAO::deletePrescription($requestData->PrescriptionID);

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
