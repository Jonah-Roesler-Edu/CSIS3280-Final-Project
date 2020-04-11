<<<<<<< HEAD
<?php


//Require configuration
require_once('config.php');

//Require Entities
require_once('entities\Client.php');

require_once('entities\User.php');
// require_once('..\JJG_Pharma\application\entities\User.php');

// require_once('..\JJG_Pharma\application\entities\User.class.php');

//Require Utillity Classes
require_once('PDOAgent.class.php');
require_once('Utilities\UserDAO.class.php');
require_once('Utilities\ClientDAO.class.php');

/*
Create  - INSERT - POST
Read    - SELECT - GET
Update  - UPDATE - PUT
DELETE  - DELETE - DELETE
*/

//Instantiate a new Customer Mapper
// CustomerMapper::initialize();

UserDAO::initialize();

//Pull the request data
// parse_str(file_get_contents('php://input'), $requestData);
$requestData = json_decode(file_get_contents('php://input'));

// CODEIGNITER CUSTOM $this->input->raw_input_stream;
// $requestData = json_decode($this->input->raw_input_stream);


//Do something based on the request
switch ($_SERVER["REQUEST_METHOD"])   {

    case "POST":    //Picked up a POST, Its Insert time!
  
         //New User 
        
    $newUser = new User();
    $newUser->setfirstName($requestData->firstname);
    $newUser->setLastName($requestData->lastname);
    $newUser->setUserName($requestData->username);
    $newUser->setEmail($requestData->email);
    $newUser->setPhone($requestData->phone);
    $newUser->setGender($requestData->gender);
    $newUser->setAge($requestData->age);
    $newUser->setPass($requestData->password);

    $result = UserDAO::createUser($newUser);
    //Return the results
    echo json_encode($result);

       

    break;

    
    case "GET":
        //in this api, we are checking a user's password for login if it checks out, then we'll just send back the username

        // $users = UserDAO::getUsers();
        $user = UserDAO::getUser($requestData->userLogin);

        //if the password is correct then send back the user
        if($user !== false){
            if($user->verifyPassword($requestData->passLogin)){
                header('Content-Type: application/json');
                echo json_encode($user->jsonSerialize());
            }
        }

        //if not then send back false

        // if (isset($requestData->id))    {

    //         //Return the customer object
    //         $sc = CustomerMapper::getCustomer($requestData->id);

    //         //Set the header
    //         header('Content-Type: application/json');
    //         //Barf out the JSON version
    //         echo json_encode($sc->jsonSerialize());

    //     } else {

    //         //All the customers!
    //         $customers = CustomerMapper::getCustomers();
            
    //         //Walk the customers and add them to a serialized array to return.
    //         $serializedCustomers = array();

    //         foreach ($customers as $customer)    {
    //             $serializedCustomers[] = $customer->jsonSerialize();
    //         }
    //         //Return the results

    //         //Set the header
    //         header('Content-Type: application/json');
    //         //Return the entire array
    //         echo json_encode($serializedCustomers);            
    //     }
    break;
   
    // case "PUT":
    
    //     //In YARC send the following: Id=6&Name=Sally Hill&City=Vancouver&Address=66 Royal Ave
    //     //Must be an update, build the new customer object
    //     $ec = new Customer();
    //     $ec->setID($requestData->id);
    //     $ec->setName($requestData->Name);
    //     $ec->setCity($requestData->City);
    //     $ec->setAddress($requestData->Address);

    //     $result = CustomerMapper::updateCustomer($ec);
    //     //Set the header
    //     header('Content-Type: application/json');
    //     //Return the number of rows affected
    //     echo json_encode($result);

    // break;

    // case "DELETE":
    //     //In YARC send the request as key=value
    //     //Pull the ID, send it to delete via the customer mapper and return the result.
    //     $result = CustomerMapper::deleteCustomer((int)$requestData->id);

    //     //Set the header
    //     header('Content-Type: application/json');
    //     //return the confirmation of deletion
    //     echo json_encode($result);
        
    // break; 

    default:
        echo json_encode(array("message"=> "Você fala HTTP?"));
    break;
}


?>
=======
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
>>>>>>> 55b9cb0a5b0de31b347043f1ac18826648176399
