<?php

//require configuration
require_once('config.php');

// require entities
require_once('entities/User.php');
require_once('entities/Doctor.php');

//Require Utillity Classes
require_once('Utilities/PDOAgent.class.php');
require_once('Utilities/UserDAO.class.php');
require_once('Utilities/DoctorDAO.class.php');
// require_once('Utilities/Client_DoctorDAO.class.php');


/*
Create  - INSERT - POST
Read    - SELECT - GET
Update  - UPDATE - PUT
DELETE  - DELETE - DELETE
*/


UserDAO::initialize();
DoctorDAO::initialize();

//Pull the request data
// parse_str(file_get_contents('php://input'), $requestData);
$requestData = json_decode(file_get_contents('php://input'));

// CODEIGNITER CUSTOM $this->input->raw_input_stream;
// $requestData = json_decode($this->input->raw_input_stream);


//Do something based on the request
switch ($_SERVER["REQUEST_METHOD"])   {

    case "POST":    //Picked up a POST >> INSERT ENTITY
     
    // new Medicine
    $newDoctor = new Doctor();
    $newDoctor->setDoctorType($requestData->DoctorType);
    $newDoctor->setUserID($requestData->UserID);
    
    $result = DoctorDAO::createDoctor($newDoctor);

    //Return the results
    header('Content-Type: application/json');
    echo json_encode($result);
   
    break;

    //If there was a request with an id return that medicine, if not return all of them!
    case "GET":
      
    if (isset($requestData->id))    {

        //Return the customer object
        $doctor = DoctorDAO::getDoctor($requestData->id);

        //Set the header
        header('Content-Type: application/json');
        //Barf out the JSON version
        echo json_encode($doctor->jsonSerialize());

    } else {

        //All the customers!
        $doctors = DoctorDAO::getDoctors();
        
        //Walk the customers and add them to a serialized array to return.
        $serializedDoctors = array();

        foreach ($doctors as $doctor)    {
            // var_dump($medicine);
            $serializedDoctors[] = $doctor->jsonSerialize();
        }
       
        //Set the header
        header('Content-Type: application/json');
        //Return the entire array
        echo json_encode($serializedDoctors);             
    }
    break;
   
    case "PUT":

        //Must be an update, build the new Doctor object
        $doctor = new Doctor();
        $doctor->setUserID($requestData->UserID);
        $doctor->setDoctorType($requestData->DoctorType);

       
        $result = DoctorDAO::updateDoctor($doctor);

        //Set the header
        header('Content-Type: application/json');
        //Return the number of rows affected
        echo json_encode($result);

    break;

    case "DELETE":
        //In YARC send the request as key=value
        //Pull the ID, send it to delete via the customer mapper and return the result.
        $result = DoctorDAO::deleteDoctor($requestData->id);

        //Set the header
        header('Content-Type: application/json');
        //return the confirmation of deletion
        echo json_encode($result);
        
    break; 

    default:
        // echo json_encode(array("message"=> "Você fala HTTP?"));
    break;
}



?>