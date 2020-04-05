<?php 
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

class User {
    private $UserID;
    private $FirstName;
    private $LastName;
    private $UserName;
    private $Email;
    private $Phone;
    private $Gender;
    private $Age;
    private $Pass;


    // getters
    public function getUserID() {
        return $this->UserID;
    }
    public function getFirstName() {
        return $this->FirstName;
    }
    public function getLastName() {
        return $this->LastName;
    }
    public function getUserName() {
        return $this->UserName;
    }
    public function getEmail() {
        return $this->Email;
    }
    public function getPhone() {
        return $this->Phone;
    }
    public function getGender() {
        return $this->Gender;
    }
    public function getAge() {
        return $this->Age;
    }
    public function getPass() {
        return $this->Pass;
    }


    // setter
    public function setUserID(int $id) {
        $this->UserID = $id;
    }
    public function setFirstName(string $fName) {
        $this->FirstName = $fName;
    }
    public function setLastName(string $lName) {
        $this->LastName = $lName;
    }
    public function setUserName(string $uName) {
        $this->UserName = $uName;
    }
    public function setEmail(string $email) {
        $this->Email = $email;
    }
    public function setPhone(string $phone) {
        $this->Phone = $phone;
    }
    public function setGender(string $gender) {
        $this->Gender = $gender;
    }
    public function setAge(int $age) {
        $this->Age = $age;
    }
    public function setPass(string $pass) {
        $this->Pass = $pass;
    }

    // verify password
    public function verifyPassword(string $passwordToVerify) {

        $storedHash = password_hash($passwordToVerify, PASSWORD_DEFAULT);
        
        return password_verify($passwordToVerify, $storedHash);
        

    }
    

}

?>