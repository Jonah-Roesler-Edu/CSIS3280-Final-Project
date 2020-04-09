<?php
    class Prescription {
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

        private $PrescriptionID;
        private $ClientID;
        private $DoctorID;
        private $MedicineID;
        private $Description;

     
         //GETTERS
         public function getPrescriptionID() {
            return $this->PrescriptionID;
        }
        public function getClientID() {
            return $this->ClientID;
        }
        public function getDoctorID() {
            return $this->DoctorID;
        }
        public function getMedicineID() {
            return $this->MedicineID;
        }
        
        public function getDescription() {
            return $this->Description;
        }
      
      
        //SETTERS 
        public function setPrescriptionID($newPresc) {
            $this->PrescriptionID = $presc;
        }
        public function setClientID($newClient) {
            $this->ClientID = $newClient;
        }
        public function setDoctorID($newDoc) {
            $this->DoctorID = $newDoc;
        }
        public function setMedicineID($newMedicineId) {
            $this->MedicineID = $newMedicineID;
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