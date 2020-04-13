<?php



class PrescriptionDAO   {

private static $_db;

static function initialize()    {

    //Initialize the database connection
    self::$_db = new PDOAgent('Prescription');

}

// CREATE TABLE Prescription(
//     PrescriptionID INT(11) NOT NULL AUTO_INCREMENT,
//     ClientID INT(11) NOT NULL,
//     MedicineName VARCHAR(50),
//     Description VARCHAR(500), 
//     -- Something like dosage, etc
//     PRIMARY KEY(PrescriptionID),
//     FOREIGN KEY(ClientID) REFERENCES Client(ClientID) ON DELETE CASCADE ON UPDATE CASCADE
// );


//CREATE a single Prescription
static function createPrescription(Prescription $newPrescription): int   {

    //Generate the INSERT STATEMENT for the user;
    //Id missing because AUTO INCREMENT
   $sql = "INSERT INTO Prescription (ClientID, MedicineName, Description)
            VALUES (:clientid, :medicinename, :description);";

    //prepare the query
    self::$_db->query($sql);

    //Setup the bind parameters
//    self::$_db->bind("prescriptionid", $newPrescription->getPrescriptionID());
   self::$_db->bind(":clientid", $newPrescription->getClientID());
   self::$_db->bind(":medicinename", $newPrescription->getMedicineName());
   self::$_db->bind(":description", $newPrescription->getDescription());

    //Execute the query
    self::$_db->execute();

    //Return the last inserted ID!!
   return self::$_db->lastInsertedId();

}

//READ a single Prescription
static function getPrescription($id){

    $sql = "SELECT * FROM Prescription
            WHERE PrescriptionID = :id;";

    //prepare the query
    self::$_db->query($sql);

    //Setup the bind parameters
    self::$_db->bind(":id", $id);

    //Execute the query
    self::$_db->execute();

    //Return the User!
    return self::$_db->singleResult();
}

//READ a list of Users
static function getPrescriptionsByClient($id){

    //Prepare the query
    $sql = "SELECT * FROM Prescription WHERE ClientID = :id;";
    self::$_db->query($sql);

    self::$_db->bind(":id", $id);
    //Execute the query
    self::$_db->execute();
    //Get the row
    return self::$_db->resultSet();
}

//UPDATE 
static function updatePrescription(Prescription $Prescription): int   {
   

        //Create the query
        //Can't update ID

        $sql = "UPDATE Prescription
                SET
                ClientID = :clientid,
                MedicineName = :medicinename,
                Description = :description
                WHERE PrescriptionID = :prescriptionid;";
        //Query...
        self::$_db->query($sql);

        //Bind
        self::$_db->bind(":prescriptionid", $Prescription->getPrescriptionID());
        self::$_db->bind(":clientid", $Prescription->getClientID());
        self::$_db->bind(":medicinename", $Prescription->getMedicineName());
        self::$_db->bind(":description", $Prescription->getDescription());

        //Execute the query
        self::$_db->execute();

    //Get the number of affected rows
    return self::$_db->rowCount();
}

//if you want to update only one field:
    // static function updateField(User $User ,$field, $value): int   {
    //     $sql = "UPDATE User
    //     SET ".$field." = :value,
    //     WHERE UserID = :id;";

    //     self::$_db->bind(":value", $User->get());
    //     self::$_db->bind(":id", $User->get());
    //     // self::$_db->bind(":", $newUser->get()); might need if going to bind :field instead
    //     //not sure if the binding of an attribute NAME will work but might try that later.

    //     return self::$_db->rowCount();
    // }

//DELETE
static function deletePrescription(int $id): int {
    try {
        $sql = "DELETE FROM Prescription
            WHERE PrescriptionID=:id;";
    self::$_db->query($sql);
    //bind
    self::$_db->bind(":id",$id);
    //Execute the query
    self::$_db->execute();
    //Get the row
    return self::$_db->rowCount();
    }catch(PDOException $ex){
        echo $ex->rowCount();
    }

    //Return the amount of affected rows.
    return self::$_db->rowCount();
}

}

?>
