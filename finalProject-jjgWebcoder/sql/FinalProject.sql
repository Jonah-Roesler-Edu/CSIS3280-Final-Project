DROP DATABASE IF EXISTS pharmadb;
CREATE DATABASE pharmadb;
USE pharmadb;
-- select * from Transaction;
CREATE TABLE User(
    UserID INT(11) NOT NULL AUTO_INCREMENT,
    FirstName VARCHAR(50),
    LastName VARCHAR(50),
    UserName VARCHAR(50),
    Email VARCHAR(50),
    Phone VARCHAR(50),
    Gender VARCHAR(50),
    Age INT(11),
    Pass VARCHAR(250),
    PRIMARY KEY(UserID)
);

CREATE TABLE Client(
    ClientID INT(11) NOT NULL AUTO_INCREMENT,
    UserID INT(11) NOT NULL,
    PRIMARY KEY(ClientID),
    FOREIGN KEY(UserID) REFERENCES User(UserID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Doctor(
    DoctorID INT(11) NOT NULL AUTO_INCREMENT,
    DoctorType VARCHAR(50),
    UserID INT(11) NOT NULL,
    PRIMARY KEY(DoctorID),
    FOREIGN KEY(UserID) REFERENCES User(UserID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Client_Doctor(
    ClientID INT(11) NOT NULL,
    DoctorID INT(11) NOT NULL,
    PRIMARY KEY(ClientID,DoctorID),
    FOREIGN KEY(ClientID) REFERENCES Client(ClientID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(DoctorID) REFERENCES Doctor(DoctorID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Medicine(
    MedicineID INT(11) NOT NULL AUTO_INCREMENT,
    MedicineName VARCHAR(50),
    Treatment VARCHAR(500),
    Description VARCHAR(500),
    PRIMARY KEY(MedicineID)
);

CREATE TABLE Prescription(
    PrescriptionID INT(11) NOT NULL AUTO_INCREMENT,
    ClientID INT(11) NOT NULL,
    DoctorID INT(11),
    MedicineID INT(11) NOT NULL,
    Description VARCHAR(500), 
    -- Something like dosage, etc
    PRIMARY KEY(PrescriptionID),
    FOREIGN KEY(ClientID) REFERENCES Client(ClientID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(DoctorID) REFERENCES Doctor(DoctorID) ON DELETE SET NULL,
    FOREIGN KEY(MedicineID) REFERENCES Medicine(MedicineID) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE Transaction(
    TransactionID INT(11) NOT NULL AUTO_INCREMENT,
    ClientID INT(11) NOT NULL,
    MedicineID INT(11) NOT NULL,
    PrescriptionID INT(11) NOT NULL,
    Price DECIMAl,
    TransDate date,
    PRIMARY KEY(TransactionID),
    FOREIGN KEY(ClientID) REFERENCES Client(ClientID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(MedicineID) REFERENCES Medicine(MedicineID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(PrescriptionID) REFERENCES Prescription(PrescriptionID) ON DELETE CASCADE ON UPDATE CASCADE
);


INSERT INTO User VALUES 
(1,'Colver','Prydden','cprydden0','cprydden0@dedecms.com','585-686-1406','Male',49,'$2y$10$JHV0Y0yfYhTA2rTA//1CweCZWwfkGEHxK/TnT8VIJIwjDTlGkCCDi')
,(2,'Mollie','Stuttard','mstuttard1','mstuttard1@taobao.com','251-305-9376','Female',39,'$2y$10$NcCTPaKoYLWDqE17Ufnlsui0OH8D6jT4P9.n5B6Thcl/AD7pcICnS')
,(3,'Hetti','Orritt','horritt2','horritt2@netvibes.com','223-257-6637','Female',45,'$2y$10$KGCumBzgbriICSTRaHJNTOQqqAzWvEvxOls6UuG.Q9blN2cdL16Am')
,(4,'Piggy','Chadwell','pchadwell3','pchadwell3@weibo.com','246-899-8894','Male',10,'$2y$10$E.W0gCZb78jqFamiWPy.re4znaEZFXcZnLeYDr7NU7n4PrE/7fYLi')
,(5,'Shawna','Matantsev','smatantsev4','smatantsev4@timesonline.co.uk','688-404-8801','Female',66,'$2y$10$0fNIQtbC7VHMbJS/XB6ma.1MxIPHVbFcuu947Ao1U2BDy8cVHJpU.')
,(6,'Ainslie','Tuther','atuther5','atuther5@bbc.co.uk','489-143-1765','Female',78,'$2y$10$RHh9rkd4e.xVnDecn7Yepe5zyVybjnoCkyaxrwyIH/TL1png1.Cp2')
,(7,'Karlik','Marien','kmarien6','kmarien6@diigo.com','468-356-5579','Male',71,'$2y$10$s/iHmmBqZJIx30iL3f4eluzNJT7v13tmrKuC4ZjMCAX0cm3O.Xcay')
,(8,'Audie','McCombe','amccombe7','amccombe7@usnews.com','633-165-2217','Female',35,'$2y$10$imly.3qHRyZKVT7G9S.Ucuba8i/XfM9DkoW5YzYiPrz9IABEeWAzm'),
(9,'firstName', 'lastName', 'username', 'email@email.com', '111-111-1111', 'Male', 30, 'password');



INSERT INTO Client VALUES(1,1);
INSERT INTO Client VALUES(2,2);
INSERT INTO Client VALUES(3,3);
INSERT INTO Client VALUES(4,4);
INSERT INTO Client VALUES(5,5);

INSERT INTO Doctor VALUES(1,"Cardiologists",6);
INSERT INTO Doctor VALUES(2,"Allergists",7);
INSERT INTO Doctor VALUES(3,"Dermatologists",8);

INSERT INTO Client_Doctor VALUES(1,1);
INSERT INTO Client_Doctor VALUES(2,3);
INSERT INTO Client_Doctor VALUES(1,3);

INSERT INTO Medicine VALUES(1,"Aspirin","reduce pain and fever","Follow you doctor advices");
INSERT INTO Medicine VALUES(2,"Biotin","enhance nail, hair and nerve","Follow you doctor advices");
INSERT INTO Medicine VALUES(3,"Paracetamol","The treatment of painfull, headache ","Follow you doctor advices");
INSERT INTO Medicine VALUES(4,"Phenytoin","slowing down impulses in the brain that cause seizures","Follow you doctor advices");

INSERT INTO Prescription VALUES(1,1,1,1, "100 mg, apply sparingly");
INSERT INTO Prescription VALUES(2,2,2,2, "200 pills");
INSERT INTO Prescription VALUES(3,3,2,1, "100 pills");


INSERT INTO Transaction VALUES(1,3,1,2,200, '2020-01-02');
INSERT INTO Transaction VALUES(2,2,2,2,300, '2020-04-01');
INSERT INTO Transaction VALUES(3,1,3,3,150, '2020-04-02');
INSERT INTO Transaction VALUES(4,2,1,1,80, '2020-04-03');






-- INSERT INTO Dose VALUES(1, "Aspirin"
--     ,"200 tablets"
--     ,"Starch, Lactose, Sodium Saccharin, Citric Acid Anhydrous, Calcium Carbonate, Talc and Sodium Lauryl Sulphate"
--     ,"adults and children 12 years and over: take 1 or 2 tablets every 4 hours children under 12 years: consult a doctor"
--     ,"Pain reliever/fever reducer"
--     ,"Aspirin may cause a severe allergic reaction: hives, facial swelling, asthma (wheezing)"
-- );
-- INSERT INTO Dose VALUES(2, "Biotin"
--     ,"20 Caplets"
--     ,"Vitamin B"
--     ,"The adequate intakes (AI) for biotin are 30 mcg for adults over 18 years and pregnant women, and 35 mcg for breast-feeding women"
--     ,"Biotin is commonly used for hair loss, brittle nails, nerve damage, and many other conditions"
--     ,"Possibly safe"
-- );
-- INSERT INTO Dose VALUES(3, "Paracetamol"
--     ,"500 Tablets"
--     ,"mild analgesic and antipyretic"
--     ,"adults and children 16 years and over Two tablets every four hours as required. Not more than eight tablets in 24 hours. Do not take for more than 3 days without consulting your doctor"
--     ,"the treatment of most painful and febrile conditions, for example, headache including migraine, toothache, neuralgia, colds and influenza, sore throat, backache, rheumatic pain and dysmenorrhoea"
--     ,"Liver damage is possible in adults who have taken 10g or more of paracetamol. Ingestion of 5g or more of paracetamol may lead to liver damage if the patient has risk factors"
-- );
-- INSERT INTO Dose VALUES(4, "Phenytoin"
--     ,"200 Tablets"
--     ,"actose, magnesium stearate, sugar and talc."
--     ,"adults and children 16 years and over Two tablets every four hours as required. Not more than eight tablets in 24 hours. Do not take for more than 3 days without consulting your doctor"
--     ,"Phenytoin works by slowing down impulses in the brain that cause seizures."
--     ,"signs of an allergic reaction to phenytoin (hives, difficult breathing, swelling in your face or throat) or a severe skin reaction (fever, sore throat, burning in your eyes, skin pain, red or purple"
-- );





