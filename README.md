# CSIS3280-Final-Project
Pharma project



PROJECT STATUS: GOT REST API WORKING, NOW TO EXPLAIN AND FILL IN THE STUFF, DISPLAY FROM DB, ETC

TO OPERATE CURRENT CODE IGNITER PROJECT
- Add JJG_Pharma as Wampserver Alias
- open alias in wampserver

MASTER FILE (point wamp here)
    RestComponents
        [restAPI, entities, and PDOAgent is here]
    CodeIgniter Project Folder
        [our JJG_Pharma is here]

To see RestAPI working 
http://localhost/JJG_Pharma/JJG_Pharma/index.php/MyController/test
(yes I know there is 2 JJG_Pharmas)
![test routing 01](https://i.pinimg.com/originals/9a/d8/62/9ad862ff14ac2a592d542606ba348960.jpg)

[TEMPORARY WRITEUP]
This project is a database project for a "Over the Counter" pharmacy. Think something like in Safeway/London Drugs/Costco pharma
(it may possibly sell both normal medicine and ones requiring a prescription)

What it does is it keeps records on:
    clients
    doctors
    medicines
    prescriptions (if any)

In addition to this it will keep track of
    transactions
        Through transactions it will keep track of these for medical reasons:
            which clients puchased what medicine
            what doctors prescribed what medicine
    
IN GENERAL
a client will:
    -Browse the pharmacy for medicines (maybe sorted by type)
    -either Purchase online/puchase to pick up in store
    -submit prescription to pick up in store
