<?php



class UserDAO    {

private static $_db;

static function initialize()    {

    //Initialize the database connection
    self::$_db = new PDOAgent('Transaction');

}

// CREATE TABLE Transaction(
//     TransactionID INT(11) NOT NULL AUTO_INCREMENT,
//     ClientID INT(11) NOT NULL,
//     MedicineID INT(11) NOT NULL,
//     PrescriptionID INT(11) NOT NULL,
//     Price DECIMAl,
//     TransDate date,
//     PRIMARY KEY(TransactionID),
//     FOREIGN KEY(ClientID) REFERENCES Client(ClientID) ON DELETE CASCADE ON UPDATE CASCADE,
//     FOREIGN KEY(MedicineID) REFERENCES Medicine(MedicineID) ON DELETE CASCADE ON UPDATE CASCADE,
//     FOREIGN KEY(PrescriptionID) REFERENCES Prescription(PrescriptionID) ON DELETE CASCADE ON UPDATE CASCADE
// );


//CREATE a single Transaction
static function createTransaction(Transaction $newTrans): int   {

    //Generate the INSERT STATEMENT for the user;
   $sql = "INSERT INTO Transaction (ClientID, MedicineID, PrescriptionID, Price, TransDate)
            VALUES (:clientid, :medicineid, :prescriptionid, :price, :transdate);";

    //prepare the query
    self::$_db->query($sql);

    //Setup the bind parameters
   self::$_db->bind("clientid", $newTrans->getClientID());
   self::$_db->bind(":medicineid", $newTrans->getMedicineID());
   self::$_db->bind(":prescriptionid", $newTrans->getPrescriptionID());
   self::$_db->bind(":price", $newTrans->getPrice());
   self::$_db->bind(":transdate", $newTrans->getTransDate());

    //Execute the query
    self::$_db->execute();

    //Return the last inserted ID!!
   return self::$_db->lastInsertedId();

}

//READ a single User
static function getTransaction($id){

    $sql = "SELECT * FROM Transaction
            WHERE TransactionID = :id;";

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
static function getTransactions(){

    //Prepare the query
    $sql = "SELECT * FROM Transaction;";
    self::$_db->query($sql);
    //Execute the query
    self::$_db->execute();
    //Get the row
    return self::$_db->resultSet();
}

//UPDATE 
static function updateUser(User $User): int   {
   
       // CREATE TABLE User(
//     UserID INT(11) NOT NULL,
//     FirstName VARCHAR(50),
//     LastName VARCHAR(50),
//     UserName VARCHAR(50),
//     Email VARCHAR(50),
//     Phone VARCHAR(50),
//     Gender VARCHAR(50),
//     Age INT(11),
//     Pass VARCHAR(250),
//     PRIMARY KEY(UserID)
// );

        //Create the query
        //can't update the password here
        $sql = "UPDATE User
                SET FirstName = :first_name,
                LastName = :last_name,
                UserName = :username,
                Email = :email,
                Phone = :phone,
                Gender = :gender,
                Age = :age
                WHERE UserID = :id;";
        //Query...
        self::$_db->query($sql);

        //Bind
        self::$_db->bind(":first_name", $User->getFirstName());
        self::$_db->bind(":last_name", $User->getLastName());
        self::$_db->bind(":username", $User->getUserName());
        self::$_db->bind(":email", $User->getEmail());
        self::$_db->bind(":phone", $User->getPhone());
        self::$_db->bind(":gender", $User->getGender());
        self::$_db->bind(":age", $User->getAge());
        
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
static function deleteTransaction(int $id): int {
    try {
        $sql = "DELETE FROM User
            WHERE TransactionID=:id;";
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

static function getClientTransactions($id) {
    $sql = "SELECT * FROM Transaction WHERE ClientID = :clientid";

    self::$_db->query();
    self::$_db->bind(":clientid", $id);

    self::$_db->execute();

    return self::$_db->resultSet();
}

}

?>