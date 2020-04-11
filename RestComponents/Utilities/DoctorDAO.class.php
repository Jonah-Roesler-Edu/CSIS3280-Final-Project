<?php


// private $DoctorID;
// private $DoctorType;
// private $UserID;
class DoctorDAO    {

private static $_db;

static function initialize()    {

    //Initialize the database connection
    self::$_db = new PDOAgent('Doctor');

}

//CREATE a single Client
static function createDoctor(Doctor $newDoctor): int   {

    //Generate the INSERT STATEMENT for the user;
   $sql = "INSERT INTO Doctor (DoctorID, DoctorType, UserID)
            VALUES (:doctorid, :doctortype, :userid);";

    //prepare the query
    self::$_db->query($sql);

    //Setup the bind parameters
   self::$_db->bind(":doctorid", $newDoctor->getDoctorID());
   self::$_db->bind(":doctortype", $newDoctor->getDoctorType());
   self::$_db->bind(":userid", $newDoctor->getMedicineID());

    //Execute the query
    self::$_db->execute();

    //Return the last inserted ID!!
   return self::$_db->lastInsertedId();

}

//READ a single Client
static function getDoctor($id){

    $sql = "SELECT * FROM Doctor
            WHERE DoctorID = :id;";

    //prepare the query
    self::$_db->query($sql);

    //Setup the bind parameters
    self::$_db->bind(":id", $id);

    //Execute the query
    self::$_db->execute();

    //Return the Client!
    return self::$_db->singleResult();
}

//READ a list of Client
static function getDoctors(){

    //Prepare the query
    $sql = "SELECT * FROM Doctor;";
    self::$_db->query($sql);
    //Execute the query
    self::$_db->execute();
    //Get the row   
    return self::$_db->resultSet();
}

//UPDATE 
static function updateDoctor(Doctor $doctor): int   {

        //Create the query
        $sql = "UPDATE Doctor
                SET DoctorID = :doctorid,
                DoctorType = :doctortype,
                UserID = :userid
                WHERE DoctorID = :id;";
        //Query...
        self::$_db->query($sql);

        //Bind
        self::$_db->bind(":doctorid", $doctor->getClientID());
        self::$_db->bind(":doctortype", $doctor->getDoctorType());
        self::$_db->bind(":userid", $doctor->getUserID());
        
        //Execute the query
        self::$_db->execute();

    //Get the number of affected rows
    return self::$_db->rowCount();
}

//DELETE
static function deleteDoctor(int $id): int {
    try {
        $sql = "DELETE FROM Doctor
            WHERE DoctorID=:id;";
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