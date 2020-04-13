<?php



class ClientDAO    {

private static $_db;

static function initialize()    {

    //Initialize the database connection
    self::$_db = new PDOAgent('Client');

}

// CREATE TABLE Client(
//     ClientID INT(11) NOT NULL AUTO_INCREMENT,
//     UserID INT(11) NOT NULL,
//     PRIMARY KEY(ClientID),
//     FOREIGN KEY(UserID) REFERENCES User(UserID) ON DELETE CASCADE ON UPDATE CASCADE
// );

//CREATE a single Client
static function createClient(Client $newClient): int   {

    //Generate the INSERT STATEMENT for the user;
   $sql = "INSERT INTO Client (UserID)
            VALUES (:userid);";

    //prepare the query
    self::$_db->query($sql);

    //Setup the bind parameters
   self::$_db->bind(":userid", $newClient->getUserID());

    //Execute the query
    self::$_db->execute();

    //Return the last inserted ID!!
   return self::$_db->lastInsertedId();

}

//READ a single Client
static function getClient($id){

    $sql = "SELECT * FROM Client
            WHERE ClientID = :id;";

    //prepare the query
    self::$_db->query($sql);

    //Setup the bind parameters
    self::$_db->bind(":id", $id);

    //Execute the query
    self::$_db->execute();

    //Return the Client!
    return self::$_db->singleResult();
}

//READ a single Client
static function getClientByUser($id){

    $sql = "SELECT * FROM Client
            WHERE UserID = :id;";

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
static function getClients(){

    //Prepare the query
    $sql = "SELECT * FROM Client;";
    self::$_db->query($sql);
    //Execute the query
    self::$_db->execute();
    //Get the row   
    return self::$_db->resultSet();
}

//UPDATE 
static function updateClient(Client $Client): int   {
   
// CREATE TABLE Client(
//     ClientID INT(11) NOT NULL AUTO_INCREMENT,
//     UserID INT(11) NOT NULL,
//     PRIMARY KEY(ClientID),
//     FOREIGN KEY(UserID) REFERENCES User(UserID) ON DELETE CASCADE ON UPDATE CASCADE
// );

        //Create the query
        //can't update the password here
        $sql = "UPDATE Client
                SET ClientID = :clientid,
                UserID = :userid
                WHERE ClientID = :id;";
        //Query...
        self::$_db->query($sql);

        //Bind
        self::$_db->bind(":clientid", $Client->getClientID());
        self::$_db->bind(":userid", $Client->getUserID());
        
        //Execute the query
        self::$_db->execute();

    //Get the number of affected rows
    return self::$_db->rowCount();
}

//DELETE
static function deleteClient(int $id): int {
    try {
        $sql = "DELETE FROM Client
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

}

?>