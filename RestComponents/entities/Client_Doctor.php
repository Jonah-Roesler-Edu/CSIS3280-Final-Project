<?php
class Client_Doctor{
    private $ClientID;


    private $DoctorID;
    // private $DoctorType;
    
    // getter
    public function getClientID() {
        return $this->ClientID;
    }
     

    public function getDoctorID() {
        return $this->DoctorID;
    }
    // public function getDoctorType(){
    //     return $this->DoctorType;
    // }

    // setter
    public function setClientID(int $cID){
        $this->ClientID = $cID;
    }

     
    public function setDoctorID(int $dID){
        $this->DoctorID = $dID;
    }  
    // public function setDoctorType(int $docterType){
    //     $this->DoctorType = $docterType;
    // }

    public function JsonSerialize() {
        $obj = get_object_vars($this);
        return $obj;
    }
    
}
?>