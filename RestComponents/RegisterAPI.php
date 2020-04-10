<?php

//require configuration
require_once('config.php');

// require entities
require_once('entities/User.php');

//Require Utillity Classes
require_once('Utilities/PDOAgent.class.php');
require_once('Utilities/UserDAO.class.php');

/*
Create  - INSERT - POST
Read    - SELECT - GET
Update  - UPDATE - PUT
DELETE  - DELETE - DELETE
*/


UserDAO::initialize();

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

    //Return the results
    header('Content-Type: application/json');
    echo json_encode($result);
   
    break;

    //If there was a request with an id return that medicine, if not return all of them!
    case "GET":
      
    if (isset($requestData->id))    {

        //Return the customer object
        $su = UserDAO::getUser($requestData->id);

        //Set the header
        header('Content-Type: application/json');
        //Barf out the JSON version
        echo json_encode($su->jsonSerialize());

    } else {

        //All the customers!
        $users = UserDAO::getUsers();
        
        
        //Walk the customers and add them to a serialized array to return.
        $serializedUsers = array();

        foreach ($users as $user)    {
            // var_dump($medicine);
            $serializedUsers[] = $user->jsonSerialize();
        }
       
        //Set the header
        header('Content-Type: application/json');
        //Return the entire array
        echo json_encode($serializedUsers);            
    }
    break;
   
    case "PUT":

        //Must be an update, build the new medicine object
        $eu = new User();
        $eu->setMedicineName($requestData->id);
        $eu->setFirstName($requestData->FirstName);
        $eu->setLastName($requestData->LastName);
        $eu->setUserName($requestData->UserName);
        $eu->setEmail($requestData->Email);
        $eu->setPhone($requestData->Phone);
        $eu->setGender($requestData->Gender);
        $eu->setAge($requestData->Age);
        $eu->setPass($requestData->Pass);
       
        $result = UserDAO::updateUser($eu);
        //Set the header
        header('Content-Type: application/json');
        //Return the number of rows affected
        echo json_encode($result);

    break;

    case "DELETE":
        //In YARC send the request as key=value
        //Pull the ID, send it to delete via the customer mapper and return the result.
        $result = UserDAO::deleteUser($requestData->id);

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
