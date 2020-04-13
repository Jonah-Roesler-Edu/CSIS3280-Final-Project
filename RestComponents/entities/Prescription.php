<?php
    class Prescription {
// CREATE TABLE Prescription(
//     PrescriptionID INT(11) NOT NULL AUTO_INCREMENT,
//     ClientID INT(11) NOT NULL,
//     MedicineName VARCHAR(50),
//     Description VARCHAR(500), 
//     -- Something like dosage, etc
//     PRIMARY KEY(PrescriptionID),
//     FOREIGN KEY(ClientID) REFERENCES Client(ClientID) ON DELETE CASCADE ON UPDATE CASCADE
// );

        private $PrescriptionID;
        private $ClientID;
        private $MedicineName;
        private $Description;

     
         //GETTERS
         public function getPrescriptionID() {
            return $this->PrescriptionID;
        }
        public function getClientID() {
            return $this->ClientID;
        }
        public function getMedicineName() {
            return $this->MedicineName;
        }
        public function getDescription() {
            return $this->Description;
        }
      
      
        //SETTERS 
        public function setPrescriptionID($newPresc) {
            $this->PrescriptionID = $newPresc;
        }
        public function setClientID($newClient) {
            $this->ClientID = $newClient;
        }
        public function setMedicineName($newMed) {
            $this->MedicineName = $newMed;
        }
        public function setDescription($newDesc) {
            $this->Description = $newDesc;
        }
        

        public function jsonSerialize() {
 
            //using this method here because there is no sensitive data recorded
            $obj = get_object_vars($this);
            return $obj;
        }
    }

    
?>