<?php



class MedicineDAO    {

private static $_db;

static function initialize()    {

    //Initialize the database connection
    self::$_db = new PDOAgent('Medicine');

}

// CREATE TABLE Medicine(
//     MedicineID INT(11) NOT NULL AUTO_INCREMENT,
//     MedicineName VARCHAR(50),
//     Treatment VARCHAR(500),
//     Description VARCHAR(500),
//     PRIMARY KEY(MedicineID)
// );

//CREATE a single Medicine
static function createMedicine(Medicine $newMedicine): int   {

    //Generate the INSERT STATEMENT for the Medicine;
   $sql = "INSERT INTO Medicine (MedicineID, MedicineName, Treatment, Description)
            VALUES (:medicineid, :medicinename, :treatment, :description);";

    //prepare the query
    self::$_db->query($sql);

    //Setup the bind parameters
   self::$_db->bind(":medicineid", $newMedicine->getMedicineID());
   self::$_db->bind(":medicinename", $newMedicine->getMedicineName());
   self::$_db->bind(":treatment", $newMedicine->getTreatment());
   self::$_db->bind(":description", $newMedicine->getDescription());

    //Execute the query
    self::$_db->execute();

    //Return the last inserted ID!!
   return self::$_db->lastInsertedId();

}

//READ a single medicine
static function getMedicine($id){

    $sql = "SELECT * FROM Medicine
            WHERE MedicineID = :id;";

    //prepare the query
    self::$_db->query($sql);

    //Setup the bind parameters
    self::$_db->bind(":id", $id);

    //Execute the query
    self::$_db->execute();

    //Return the Medicine!
    return self::$_db->singleResult();
}

//READ a list of Medicine
static function getAllMedicine(){

    //Prepare the query
    $sql = "SELECT * FROM Medicine;";
    self::$_db->query($sql);
    //Execute the query
    self::$_db->execute();
    //Get the row
    return self::$_db->resultSet();
}

//UPDATE 
static function updateMedicine(Medicine $Medicine): int   {
   

        //Create the query
        //can't update the password here
        $sql = "UPDATE Medicine
                SET MedicineID = :medicineid,
                MedicineName = :medicinename,
                Treatment = :treatment,
                Description = :description
                WHERE MedicineID = :medicineid;";
        //Query...
        self::$_db->query($sql);

        //Bind
        self::$_db->bind(":medicineid", $Medicine->getMedicineID());
        self::$_db->bind(":medicinename", $Medicine->getClientID());
        self::$_db->bind(":treatment", $Medicine->getMedicineID());
        self::$_db->bind(":description", $Medicine->getPrescriptionID());


        //Execute the query
        self::$_db->execute();

    //Get the number of affected rows
    return self::$_db->rowCount();
}


//DELETE
static function deleteMedicine(int $id): int {
    try {
        $sql = "DELETE FROM Medicine
            WHERE MedicineID=:id;";
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


}

?>