<?php

class Client_DoctorDAO  {

private static $_db;

static function initialize()    {

    //Initialize the database connection
    self::$_db = new PDOAgent('Client_Doctor');

}

// CREATE TABLE Client_Doctor(
//     ClientID INT(11) NOT NULL,
//     DoctorID INT(11) NOT NULL,
//     PRIMARY KEY(ClientID,DoctorID),
//     FOREIGN KEY(ClientID) REFERENCES Client(ClientID) ON DELETE CASCADE ON UPDATE CASCADE,
//     FOREIGN KEY(DoctorID) REFERENCES Doctor(DoctorID) ON DELETE CASCADE ON UPDATE CASCADE
// );

//CREATE a single client


static function createClient_Doctor(Client_Doctor $newClient_Doctor) {
      //Generate the INSERT STATEMENT for the client;
    //Id missing because AUTO INCREMENT
   $sql = "INSERT INTO Client_Doctor (ClientID, DoctorID)
   VALUES (:clientid, :doctorid);";

//prepare the query
self::$_db->query($sql);

//Setup the bind parameters
//    self::$_db->bind("prescriptionid", $newPrescription->getPrescriptionID());
self::$_db->bind(":clientid", $newClient_Doctor->getClientID());
self::$_db->bind(":doctorid", $newClient_Doctor->getDoctorID());

//Execute the query
self::$_db->execute();

//Return the last inserted ID!!
return self::$_db->lastInsertedId();
}



//get a single client doctor
static function getClient_Doctor($cID,$dID) {
    $sql = "SELECT ClientID, DoctorID FROM Client_Doctor WHERE ClientID = :clientid AND DoctorID = :doctorid;";
    self::$_db->query($sql);

    //Setup the bind parameters
    self::$_db->bind(":clientid", $cID);
    self::$_db->bind(":doctorid", $dID);

    //Execute the query
    self::$_db->execute();

    //Return the User!
    return self::$_db->singleResult();
    

}

static function getClient_Doctors(){

    //Prepare the query
    $sql = "SELECT * FROM Client_Doctor;";
    self::$_db->query($sql);
    //Execute the query
    self::$_db->execute();
    //Get the row
    return self::$_db->resultSet();
}

// Update One Client


static function updateClient_Doctor(Profile $updateClient_Doctor) {
    $sql = "UPDATE Client_Doctor SET DoctorID = :doctorid WHERE ClientID = :id;";
    self::$_db->query($sql);
    // bind
    self::$_db->bind(":id", $updateClient_Doctor->getClientID());
    //Execute the query
    self::$_db->execute();
    //Get the number of affected rows
    return self::$_db->rowCount();
}



//DELETE


static function deleteClient_Doctor(int $id): int {
    try {
        $sql = "DELETE FROM Client_Doctor
            WHERE ClientID=:id;";
    self::$_db->query($sql);
    //bind
    self::$_db->bind(":id",$id);
    //Execute the query
    self::$_db->execute();
    //Get the row
    return self::$_db->row();
    }catch(PDOException $ex){
        echo $ex->rowCount();
    }

    //Return the amount of affected rows.
    return self::$_db->rowCount();
}

static function getProfileUser($id){

    $sql = "SELECT UserID, UserName, FirstName, LastName, UserName, Email, Phone, Age, DoctorID FROM User u, Doctor d
            WHERE u.UserID = d.UserID AND UserID = :id;";

    //prepare the query
    self::$_db->query($sql);

    //Setup the bind parameters
    self::$_db->bind(":id", $id);

    //Execute the query
    self::$_db->execute();

    //Return the User!
    return self::$_db->singleResult();

}





}

?>