<?php


//Require configuration
require_once('config.php');

//Require Entities
require_once('entities\Client.php');
require_once('entities\Medicine.php');
require_once('entities\Transaction.php');
require_once('entities\User.php');

// require_once('..\JJG_Pharma\application\entities\User.class.php');

//Require Utillity Classes
require_once('PDOAgent.class.php');
require_once('Utilities\UserDAO.class.php');

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
        // switch ("TABLE") {
        //     case "User":
        //     break;
        //     case "Client":
        //     break;
        //     case "Doctor":
        //     break;
        //     case "Medicine":
        //     break;
        //     case "Transaction":
        //     break;
        // }
    $result = "Hello from REST API, You've made it!";

    // $result = CustomerMapper::createCustomer($nc);
    //Return the results
    // var_dump($result);
    $user = UserDAO::getUser(1);
    header('Content-Type: application/json');
    echo json_encode($user->jsonSerialize());
    // echo json_encode(array("message"=> $result));

    break;

    //If there was a request with an id return that customer, if not return all of them!
    case "GET":
        // $users = UserDAO::getUsers();
        $user = UserDAO::getUser(1);
        header('Content-Type: application/json');
        echo json_encode($user->jsonSerialize());
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