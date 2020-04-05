<?php
// CREATE TABLE Client(
//     ClientID INT(11) NOT NULL,
//     UserID INT(11) NOT NULL,
//     PRIMARY KEY(ClientID),
//     FOREIGN KEY(UserID) REFERENCES User(UserID) ON DELETE CASCADE ON UPDATE CASCADE
// );

class Client {
    private $ClientID;
    private $UserID;
    private $FirstName;
    private $LastName;

    //getter
    public function getClientID() {
        return $this->ClientID;
    }
    public function getUserID() {
        return $this->UserID;
    }
    public function getFirstName() {
        return $this->FirstName;
    }
    public function getLastName() {
        return $this->LastName;
    }

    //setter
    public function setClientID(int $cID) {
        $this->ClientID = $cID;
    }
    public function setUserID(int $uID) {
        $this->UserID = $uID;
    }
    public function setFirstName(string $fName) {
        $this->FirstName = $fName;
    }
    public function setLastName(string $lName) {
        $this->LastName = $lName;
    }
    
}

?>