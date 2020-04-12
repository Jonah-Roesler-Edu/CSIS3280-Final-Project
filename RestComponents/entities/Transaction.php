<?php
    // CREATE TABLE Transaction(
    //     TransactionID INT(11) NOT NULL,
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

    // CREATE TABLE Prescription(
    //     PrescriptionID INT(11) NOT NULL,
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
    class Transaction{
        private $TransactionID;
        private $ClientID;
        private $MedicineID;
        // private $PrescriptionID;
        // private $MedicineName;
        // private $Price;
        private $TransDate;


        //GETTERS
        public function getTransactionID() {
            return $this->TransactionID;
        }
        public function getClientID() {
            return $this->ClientID;
        }
        public function getMedicineID() {
            return $this->MedicineID;
        }
        // public function getClientName() {
        //     return $this->ClientName;
        // }
        // public function getPrescriptionID() {
        //     return $this->PrescriptionID;
        // }
        // public function getMedicineName() {
        //     return $this->MedicineName;
        // }
        // public function getPrice() {
        //     return $this->Price;
        // }
        public function getTransDate() {
            return $this->TransDate;
        }

        //SETTERS 
        public function setTransactionID($newTrans) {
            $this->TransactionID = $newTrans;
        }
        public function setClientID($newClient) {
            $this->ClientID = $newClient;
        }
        public function setMedicineID($newClient) {
            $this->MedicineID = $newClient;
        }
        // public function setClientName($newName) {
        //     $this->ClientName = $newName;
        // }
        // public function setPrescriptionID($newPrescription) {
        //     $this->PrescriptionID = $newPrescription;
        // }
        // public function setMedicineName($newMed) {
        //     $this->MedicineName = $newMed;
        // }
        // public function setPrice($newPrice) {
        //     $this->Price = $newPrice;
        // }
        public function setTransDate($newDate) {
            $this->TransDate = $newDate;
        }

        public function jsonSerialize() {
 
            //using this method here because there is no sensitive data recorded
            $obj = get_object_vars($this);
            return $obj;
        }
    }
    

?>
