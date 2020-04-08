<?php



class Prescription    {

private static $_db;

static function initialize()    {

    //Initialize the database connection
    self::$_db = new PDOAgent('Prescription');

}

// CREATE TABLE Prescription(
//     PrescriptionID INT(11) NOT NULL AUTO_INCREMENT,
//     ClientID INT(11) NOT NULL,
//     DoctorID INT(11),
//     MedicineID INT(11) NOT NULL,
//     Description VARCHAR(500), 
//     -- Something like dosage, etc
//     PRIMARY KEY(PrescriptionID),
//     FOREIGN KEY(ClientID) REFERENCES Client(ClientID) ON DELETE CASCADE ON UPDATE CASCADE,
//     FOREIGN KEY(DoctorID) REFERENCES Doctor(DoctorID) ON DELETE SET NULL,
//     FOREIGN KEY(MedicineID) REFERENCES Medicine(MedicineID) ON DELETE CASCADE ON UPDATE CASCADE
// );


//CREATE a single Prescription
static function createPrescription(Prescription $newPrescription): int   {

    //Generate the INSERT STATEMENT for the user;
    //Id missing because AUTO INCREMENT
   $sql = "INSERT INTO Prescription (ClientID, DoctorID, MedicineID, Description)
            VALUES (:clientid, :doctorid, :medicineid, :description);";

    //prepare the query
    self::$_db->query($sql);

    //Setup the bind parameters
//    self::$_db->bind("prescriptionid", $newPrescription->getPrescriptionID());
   self::$_db->bind(":clientid", $newPrescription->getClientID());
   self::$_db->bind(":doctorid", $newPrescription->getDoctorID());
   self::$_db->bind(":medicineid", $newPrescription->getMedicineID());
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
static function getPrescriptions(){

    //Prepare the query
    $sql = "SELECT * FROM Prescription;";
    self::$_db->query($sql);
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
                DoctorID = :doctorid,
                MedicineID = :medicineid,
                Description = :description
                WHERE PrescriptionID = :prescriptionid;";
        //Query...
        self::$_db->query($sql);

        //Bind
        self::$_db->bind(":clientid", $Prescription->getClientID());
        self::$_db->bind(":doctorid", $Prescription->getDoctorID());
        self::$_db->bind(":medicineid", $Prescription->getMedicineID());
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
    return self::$_db->row();
    }catch(PDOException $ex){
        echo $ex->rowCount();
    }

    //Return the amount of affected rows.
    return self::$_db->rowCount();
}

static function getClientPrescriptions($id) {
    $sql = "SELECT * FROM Prescription WHERE ClientID = :clientid";  

    self::$_db->query();
    self::$_db->bind(":clientid", $id);

    self::$_db->execute();

    return self::$_db->resultSet();
}

}

?>
