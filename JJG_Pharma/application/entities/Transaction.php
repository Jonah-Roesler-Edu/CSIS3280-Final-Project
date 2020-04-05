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
        private $ClientName;
        private $PrescriptionID;
        private $MedicineName;
        private $Price;
        private $TransDate;
    }
    

?>