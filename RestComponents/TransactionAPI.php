<?php

//require configuration
require_once('config.php');

// require entities
require_once('entities/Transaction.php');

//Require Utillity Classes
require_once('Utilities/PDOAgent.class.php');
require_once('Utilities/TransactionDAO.class.php');

/*
Create  - INSERT - POST
Read    - SELECT - GET
Update  - UPDATE - PUT
DELETE  - DELETE - DELETE
*/


TransactionDAO::initialize();

//Pull the request data
// parse_str(file_get_contents('php://input'), $requestData);
$requestData = json_decode(file_get_contents('php://input'));


//Do something based on the request
switch ($_SERVER["REQUEST_METHOD"])   {

    case "POST":    //Picked up a POST, Its Insert time!
     
    // new Transaction
    $nt = new Transaction();
    $nt->setClientID($requestData->ClientID);
    $nt->setPrescriptionID($requestData->PrescriptionID);
    $nt->setTransDate($requestData->TransDate);

    $result = TransactionDAO::createTransaction($nt);

    //Return the results
    header('Content-Type: application/json');
    echo json_encode($result);
   
    break;

    //If there was a request with an id return that medicine, if not return all of them!
    case "GET":
      
    if (isset($requestData->id))    {

        //Return the customer object
        $st = TransactionDAO::getTransaction($requestData->id);

        //Set the header
        header('Content-Type: application/json');
        //Barf out the JSON version
        echo json_encode($st->jsonSerialize());

    } else {

        //All the customers!
        $transactions = TransactionDAO::getTransactions();
        
        
        //Walk the customers and add them to a serialized array to return.
        $serializedTransaction = array();

        foreach ($transactions as $transaction)    {
            $serializedTransaction[] = $transaction->jsonSerialize();
        }
       
        //Set the header
        header('Content-Type: application/json');
        //Return the entire array
        echo json_encode($serializedTransaction);            
    }
    break;
   
    case "PUT":

        //Must be an update, build the new Transaction object
        $et = new Transaction();
        $et->setClientID($requestData->ClientID);
        $et->setMedicineID($requestData->MedicineID);
        // $et->setPrescriptionID($requestData->PrescriptionID);
        $et->setTransDate($requestData->TransDate);
       
        $result = TransactionDAO::updateTransaction($em);
        //Set the header
        header('Content-Type: application/json');
        //Return the number of rows affected
        echo json_encode($result);

    break;

    case "DELETE":
        //In YARC send the request as key=value
        //Pull the ID, send it to delete via the customer mapper and return the result.
        $result = TransactionDAO::deleteTransaction($requestData->id);

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
