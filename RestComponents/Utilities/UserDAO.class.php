<?php



class UserDAO    {

private static $_db;

static function initialize()    {

    //Initialize the database connection
    self::$_db = new PDOAgent('User');

}

//CREATE a single User 
static function createUser(User $newUser): int   {
    //it would probably be good if we made the UserID autoincrement 
        // [0] Done -Jonah

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

    //Generate the INSERT STATEMENT for the user;
//    $sql = "INSERT INTO User (UserID, FirstName, LastName, UserName, Email, Phone, Gender, Age, Pass)
//             VALUES (:userid, :first_name, :last_name, :username, :email, :phone, :gender, :age, :pass);";

    $sql = "INSERT INTO User (FirstName, LastName, UserName, Email, Phone, Gender, Age, Pass)
    VALUES (:first_name, :last_name, :username, :email, :phone, :gender, :age, :pass);";

    //prepare the query
    self::$_db->query($sql);

    //Setup the bind parameters
//    self::$_db->bind("userid", $newUser->getUserID);
   self::$_db->bind(":first_name", $newUser->getFirstName());
   self::$_db->bind(":last_name", $newUser->getLastName());
   self::$_db->bind(":username", $newUser->getUserName());
   self::$_db->bind(":email", $newUser->getEmail());
   self::$_db->bind(":phone", $newUser->getPhone());
   self::$_db->bind(":gender", $newUser->getGender());
   self::$_db->bind(":age", $newUser->getAge());
   self::$_db->bind(":pass", $newUser->getPass());

    //Execute the query
    self::$_db->execute();

    //Return the last inserted ID!!
   return self::$_db->lastInsertedId();

}

//READ a single User
static function getUser($username){

    $sql = "SELECT * FROM User WHERE UserName = :username;";

    //prepare the query
    self::$_db->query($sql);

    //Setup the bind parameters
    self::$_db->bind(":username", $username);

    //Execute the query
    self::$_db->execute();

    //Return the User!
    return self::$_db->singleResult();

}

static function getUserWithStats($username){

    $sql = "SELECT u.UserID, u.FirstName, u.UserName, u.LastName, u.Email, u.Phone, u.Gender, u.Age
    , count(t.transactionid) as NoOfTransactions
    from client c,user u,transaction t
    where u.username = :username
    and u.userid=c.userid
    and c.clientid = t.clientid;";

    //prepare the query
    self::$_db->query($sql);

    //Setup the bind parameters
    self::$_db->bind(":username", $username);

    //Execute the query
    self::$_db->execute();

    //Return the User!
    return self::$_db->singleResult();

}

static function getUserByID($userID){

    $sql = "SELECT * FROM User
            WHERE UserID = :userid;";

    //prepare the query
    self::$_db->query($sql);

    //Setup the bind parameters
    self::$_db->bind(":username", $userID);

    //Execute the query
    self::$_db->execute();

    //Return the User!
    return self::$_db->singleResult();

}

//READ a list of Users
static function getUsers(){


    //Prepare the query
    $sql = "SELECT * FROM User;";
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
                Email = :email,
                Phone = :phone,
                Gender = :gender,
                Age = :age
                WHERE UserName = :username;";
        //Query...
        self::$_db->query($sql);

        //Bind
        self::$_db->bind(":first_name", $User->getFirstName());
        self::$_db->bind(":last_name", $User->getLastName());
        self::$_db->bind(":email", $User->getEmail());
        self::$_db->bind(":phone", $User->getPhone());
        self::$_db->bind(":gender", $User->getGender());
        self::$_db->bind(":age", $User->getAge());
        self::$_db->bind(":username", $User->getUserName());
        
        //Execute the query
        self::$_db->execute();

    //Get the number of affected rows
    return self::$_db->rowCount();
}

//if you want to update only one field:
    static function updateField(User $User ,$field, $value): int   {
        $sql = "UPDATE User
        SET ".$field." = :value,
        WHERE UserID = :id;";

        self::$_db->bind(":value", $User->get());
        self::$_db->bind(":id", $User->get());
        // self::$_db->bind(":", $newUser->get()); might need if going to bind :field instead
        //not sure if the binding of an attribute NAME will work but might try that later.

        return self::$_db->rowCount();
    }

//DELETE
static function deleteUser($username): int {

    try {
        $sql = "DELETE FROM User
            WHERE UserName=:username;";
    self::$_db->query($sql);
    //bind
    self::$_db->bind(":username",$username);
    //Execute the query
    self::$_db->execute();
    //Get the row
    }catch(PDOException $ex){
        echo $ex->rowCount();
    }

    //Return the amount of affected rows.
    return self::$_db->rowCount();
}

}

?>