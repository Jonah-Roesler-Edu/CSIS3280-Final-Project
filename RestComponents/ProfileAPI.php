<?php

//require configuration
require_once('config.php');

// require entities
require_once('entities/User.php');
require_once('entities/Client_Doctor.php');

//Require Utillity Classes
require_once('Utilities/PDOAgent.class.php');
require_once('Utilities/UserDAO.class.php');
require_once('Utilities/Client_DoctorDAO.class.php');


/*
Create  - INSERT - POST
Read    - SELECT - GET
Update  - UPDATE - PUT
DELETE  - DELETE - DELETE
*/


UserDAO::initialize();
Client_DoctorDAO::initialize();

//Pull the request data
// parse_str(file_get_contents('php://input'), $requestData);
$requestData = json_decode(file_get_contents('php://input'));

// CODEIGNITER CUSTOM $this->input->raw_input_stream;
// $requestData = json_decode($this->input->raw_input_stream);


//Do something based on the request
switch ($_SERVER["REQUEST_METHOD"])   {

    case "POST":    //Picked up a POST, Its Insert time!
     
    // new Medicine
    $nu = new User();
    $nu->setFirstName($requestData->FirstName);
    $nu->setLastName($requestData->LastName);
    $nu->setUserName($requestData->UserName);
    $nu->setEmail($requestData->Email);
    $nu->setPhone($requestData->Phone);
    $nu->setGender($requestData->Gender);
    $nu->setAge($requestData->Age);
    $nu->setPass($requestData->Pass);

    $result = UserDAO::createMedicine($nu);

    $ncd = new Client_Doctor();
    $ncd->setClientID($requestData->ClientID);
    $ncd->setDoctorID($requestData->DoctorID);

    $result2 = Client_DoctorDAO::createClient_Doctor($ncd);

    //Return the results
    header('Content-Type: application/json');
    echo json_encode($result);
    echo json_encode($result2);
   
    break;

    //If there was a request with an id return that medicine, if not return all of them!
    case "GET":
      
    if (isset($requestData->id))    {

        //Return the customer object
        $su = UserDAO::getUser($requestData->id);

        $scd = Client_DoctorDAO::getClient_Doctor($requestData->id);

        //Set the header
        header('Content-Type: application/json');
        //Barf out the JSON version
        echo json_encode($su->jsonSerialize());
        echo json_encode($scd->jsonSerialize());

    } else {

        //All the customers!
        $users = UserDAO::getUsers();
        
        
        //Walk the customers and add them to a serialized array to return.
        $serializedUsers = array();

        foreach ($users as $user)    {
            // var_dump($medicine);
            $serializedUsers[] = $user->jsonSerialize();
        }

        // all Client_Doctor
        $client_doctors = Client_DoctorDAO::getClient_Doctors();
        $serializedClient_Doctor = array();
        foreach($client_doctors as $client_doctor){
            $serializedClient_Doctor[] = $client_doctor->jsonSerialize();
        }
       
        //Set the header
        header('Content-Type: application/json');
        //Return the entire array
        echo json_encode($serializedUsers);    
        echo json_encode($serializedClient_Doctor);           
    }
    break;
   
    case "PUT":

        //Must be an update, build the new medicine object
        $eu = new User();
        $eu->setUser($requestData->id);
        $eu->setFirstName($requestData->FirstName);
        $eu->setLastName($requestData->LastName);
        $eu->setUserName($requestData->UserName);
        $eu->setEmail($requestData->Email);
        $eu->setPhone($requestData->Phone);
        $eu->setGender($requestData->Gender);
        $eu->setAge($requestData->Age);
        $eu->setPass($requestData->Pass);
       
        $result = UserDAO::updateUser($eu);


        $ecd = new Client_Doctor();
        $ecd->setClientID($requestData->id);
        $ecd->setDoctorID($requestData->id);
        $result2 = Client_DoctorDAO::updateClient_Doctor();


        //Set the header
        header('Content-Type: application/json');
        //Return the number of rows affected
        echo json_encode($result);
        echo json_encode($result2);
        


    break;

    case "DELETE":
        //In YARC send the request as key=value
        //Pull the ID, send it to delete via the customer mapper and return the result.
        $result = UserDAO::deleteUser($requestData->id);

        $result2 = Client_DoctorDAO::deleteClient_Doctor($requestData->id);
        //Set the header
        header('Content-Type: application/json');
        //return the confirmation of deletion
        echo json_encode($result);
        echo json_encode($result2);
        
    break; 

    default:
        echo json_encode(array("message"=> "Você fala HTTP?"));
    break;
}



?>