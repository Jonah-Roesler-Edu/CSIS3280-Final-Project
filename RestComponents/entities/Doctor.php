<?php
// CREATE TABLE Doctor(
//     DoctorID INT(11) NOT NULL AUTO_INCREMENT,
//     DoctorType VARCHAR(50),
//     UserID INT(11) NOT NULL,
//     PRIMARY KEY(DoctorID),
//     FOREIGN KEY(UserID) REFERENCES User(UserID) ON DELETE CASCADE ON UPDATE CASCADE
// );

class Client {
    private $DoctorID;
    private $DoctorType;
    private $UserID;
    // private $FirstName;
    // private $LastName;

    //getter
    public function getDoctorID() {
        return $this->DoctorID;
    }
    public function getDoctorType() {
        return $this->DoctorType;
    }
    public function getUserID() {
        return $this->UserID;
    }
    
    // public function getFirstName() {
    //     return $this->FirstName;
    // }
    // public function getLastName() {
    //     return $this->LastName;
    // }

    //setter
    public function setDoctorID(int $dID) {
        $this->DoctorID = $dID;
    }
    public function setDoctorType($dType) {
        $this->DoctorType = $dType;
    }
    public function setUserID(int $uID) {
        $this->UserID = $uID;
    }
    // public function setFirstName(string $fName) {
    //     $this->FirstName = $fName;
    // }
    // public function setLastName(string $lName) {
    //     $this->LastName = $lName;
    // }

    public function jsonSerialize() {
        $obj = get_object_vars($this);
        return $obj;
    }
    
}

?>