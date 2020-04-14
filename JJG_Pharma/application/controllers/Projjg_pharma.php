<?php

//CI form validation from
//https://codeigniter.com/userguide3/libraries/form_validation.html?highlight=password%20match#setting-validation-rules

//require RESTCLIENT
require_once(APPPATH . "/classes/RestClient.class.php");
require_once(APPPATH . "/classes/LoginManager.class.php");
require_once(APPPATH . "/entities/User.php");

require_once(APPPATH . "/entities/Medicine.php");
// require_once("entities/Medicine.php");
// require_once("entities/Prescription.php");


class Projjg_pharma extends CI_Controller {

    public function __construct()
    {
            parent::__construct();
            
            // $this->load->helper('url_helper');
            $this->load->helper(array('html', 'url'));
            $this->load->helper(array('form'));
    }

    public function index() {
        echo "TEST INDEX";
    }
    
    public function register(){
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('firstname', 'First Name', 'required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required');
        $this->form_validation->set_rules('username', 'User name', 'callback_username_check');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('age', 'Age', 'required|is_natural');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('password2', 'Password confirmation', 'required|matches[password]');
        

        $data['title'] = "Register"; 
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('patron/registrationForm');
            $this->load->view('templates/footer');

        }
        else{
            $this->load->view('templates/header', $data);
            $this->load->view('patron/registrationSuccess');
            $this->load->view('templates/footer');
        }


    }

    public function username_check($str)
        {
            //send a call to the 'API to check if the username is ok
            //first assemble the data to send
            $toCheck = array("tocheck" => $str);

             $checked = RestClient::call("GET",$toCheck,"register");

                if ($checked->ok)
                {
                        $this->form_validation->set_message('username_check', 'The username is already taken');
                        return FALSE;
                }
                else
                {
                        return TRUE;
                }
        }


    public function login($page = "login")
    {
        
        //check if the user is already logged in
        if(LoginManager::verifyLogin()){
            //if they're logged in send them somewhere (probably browse)
            //for now just simple page to say they're logged in.
            $data['title'] = "";
            $this->load->view('templates/header', $data);
            $this->load->view('patron/loginSuccess', $data);
            $this->load->view('templates/footer', $data);
        } else{
            //if the user isn't logged in
            //validate the form
            $this->load->helper('form');
            $this->load->library('form_validation');

            // $this->form_validation->set_rules('userLogin', 'User name', 'callback_username_check_login');
            $this->form_validation->set_rules('userLogin', 'username', 'required');
            $this->form_validation->set_rules('passLogin', 'password', 'required');

            if ($this->form_validation->run() === FALSE){
                //if the form isn't filled out or didn't validate
                //sshow the form
                $data['title'] = "Login"; 
                $this->load->view('templates/header', $data);
                $this->load->view('patron/loginform', $data);
                $this->load->view('templates/footer', $data);
            
            } else{
                    //check post for the login info and validate
                if(isset($_POST) && !empty($_POST)){
                    // UserDAO::initialize();
                
                    $user = RestClient::call("GET",$_POST,"register");
                    if(!isset($_SESSION)){
                        session_start();
                    }
                    $data['title'] = "";
                    if($user !== false && $user != null){
                        $_SESSION['loggedin'] = $user->UserName;
                        $this->load->view('templates/header', $data);
                        $this->load->view("patron/loginSuccess", $data);
                        $this->load->view('templates/footer', $data);
                    } else{
                        session_destroy();
                        $this->load->view('templates/header', $data);
                        $this->load->view('patron/loginFailed', $data);
                        $this->load->view('patron/loginForm', $data);
                        $this->load->view('templates/footer', $data);
                    }
                }
            }
        }
    }//end login

    public function username_check_login($str)
    {
        //send a call to the 'API to check if the username is ok
        //first assemble the data to send
        $toCheck = array("tocheck" => $str);

         $checked = RestClient::call("GET",$toCheck,"register");

            if ($checked->ok===false)
            {
                    $this->form_validation->set_message('username_check_login', "The username doesn't exist");
                    return FALSE;
            }
            else
            {
                    return TRUE;
            }
    }


    public function logout(){
        
        session_start();
        session_destroy();

        $data["title"] = "Successfully Logged Out";
        $this->load->view('templates/header', $data);
        $this->load->view('patron/logoutSuccess');
        $this->load->view('templates/footer', $data);
    }//end logout

    public function profile($message=""){

        if(LoginManager::verifyLogin() === false || empty($_SESSION)){
            //if no one is logged in then send them back to the login page
            //or whatever (maybe browse)
            $this->load->helper('form');
            $this->load->library('form_validation');

            $data['title'] = "Login"; 
                    $this->load->view('templates/header', $data);
                    $this->load->view('patron/loginform', $data);
                    $this->load->view('templates/footer', $data);

        } else{

            //if there is post data then it is time to update
            if(isset($_POST) && !empty($_POST)){
                // var_dump($_POST);
                // $user = new User();
                
                // $user->setFirstName($_POST["firstname"]);
                // $user->setLastName($_POST["lastname"]);
                // $user->setEmail($_POST["email"]);
                // $user->setPhone($_POST["phone"]);
                // $user->setGender($_POST["gender"]);
                // $user->setAge($_POST["age"]);
                $postData = array(
                    "UserName" => $_SESSION["loggedin"],
                    "FirstName" => $_POST["firstname"],
                    "LastName" => $_POST["lastname"],
                    "Email" => $_POST["email"],
                    "Phone" => $_POST["phone"],
                    "Gender" => $_POST["gender"],
                    "Age" => $_POST["age"]
                    
                );
                //Call the RestClient with PUT
                $changedRows = RestClient::call("PUT",$postData,"profile");

               
            }
        

            //if logged in then show the user their info with an option to update it
            
            //first get the user info from the database
            $requestData = array("id" => $_SESSION["loggedin"]);
            $juser = RestClient::call("GET",$requestData,"profile");
            //next print it to the table
            // var_dump($juser);
            $user = new User();
            $user->setUserID($juser->UserID);
            $user->setFirstName($juser->FirstName);
            $user->setLastName($juser->LastName);
            $user->setUserName($juser->UserName);
            $user->setEmail($juser->Email);
            $user->setPhone($juser->Phone);
            $user->setGender($juser->Gender);
            $user->setAge($juser->Age);

            $data["u"] = $user;
            $data["title"] = "Profile";
            //if the action is set to edit then give them the update form
            if(isset($_GET["action"]) && $_GET["action"] == "edit"){
                $data["title"] = "Update Info";
                $this->load->helper('form');
                $this->load->library('form_validation');

                $this->form_validation->set_rules('firstname', 'First Name', 'required');
                $this->form_validation->set_rules('lastname', 'Last Name', 'required');
                
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
                $this->form_validation->set_rules('phone', 'Phone', 'required');
                $this->form_validation->set_rules('gender', 'Gender', 'required');
                $this->form_validation->set_rules('age', 'Age', 'required|is_natural');
               
        
                 
                if ($this->form_validation->run() === FALSE)
                {//if form doesn't validate properly
                   if(validation_errors() != ''){
                       unset($data["u"]);
                   }
                    $this->load->view('templates/header', $data);
                    if(isset($data["u"])){
                        $this->load->view('patron/updateFormFirst', $data);
                    }
                    else{
                        $this->load->view('patron/updateForm', $data);
                    }
                    $this->load->view('templates/footer');
        
                }
                else{

                    $this->load->view('templates/header', $data);
                    $this->load->view('patron/successfulUpdate');
                    $this->load->view('templates/footer');
                }
            }else if(isset($_GET["action"]) && $_GET["action"] == "delete"){
                //send a delete request to the api
                //ask if you're really sure you want to delete
                $this->load->helper(array('form', 'url'));
                $this->load->view('templates/header', $data);
                $this->load->view('patron/confirmDelete');
                $this->load->view('templates/footer');

            } else{
                //load the info
            $this->load->view('templates/header', $data);
                    $this->load->view('patron/userInfo', $data);
                    $this->load->view('templates/footer', $data);
            
            }
            
        }
    }//end profile

    public function delete(){
        $this->load->helper(array('form', 'url'));
        if(LoginManager::verifyLogin() === false || empty($_SESSION)){
            $data['title'] = ""; 
            $this->load->view('templates/header', $data);
            $this->load->view('patron/loginform', $data);
            $this->load->view('templates/footer', $data);
        } else{
            $data['title'] = ""; 

            $deleteData = array("username" => $_SESSION["loggedin"]);
            echo RestClient::call("DELETE",$deleteData,"profile");
            session_destroy();
            $this->load->view('templates/header', $data);
            $this->load->view('patron/deleteSuccess', $data);
            $this->load->view('patron/loginform', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    public function medicine(){
        //For testing
        // $_SESSION['loggedin'] = "cprydden0";

        $data['transaction'] = "";

        //if PURCHASE was pressed
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            //verify login
            if(isset($_POST['medicineid']) && !empty($_POST['medicineid'])) {

                //IF LOGIN = FALSE >> backto login
                if(LoginManager::verifyLogin() === false || empty($_SESSION)){
                    //if no one is logged in then send them back to the login page
                    //or whatever (maybe browse)
                    // $this->load->helper('form');
                    // $this->load->library('form_validation');
        
                    // $data['title'] = "Login"; 
                    //         $this->load->view('templates/header', $data);
                    //         $this->load->view('patron/loginform', $data);
                    //         $this->load->view('templates/footer', $data);

                    redirect('JJG_Pharma/index.php/login');
                } else {
                    //For testing
                    // $_SESSION['loggedin'] = "cprydden0";
                    //Create new transaction

                    $user = RestClient::call("GET", array("id" => $_SESSION['loggedin'] ), "user");
                    // var_dump($user);

                    $client = RestClient::call("GET", array("id"=>$user->UserID),"client");
                    // var_dump($client);

                    $transactionData = array(
                        "clientID" => $client->ClientID,
                        "medicineID" => $_POST['medicineid'],
                        "transactionDate" => date("Y-m-d")
                    );
                    try {
                        $return = RestClient::call("POST", $transactionData, "transaction");
                        // var_dump($return);
                        if($return == null) {
                            throw new Exception("Transaction failed!");
                        } else {
                            // echo "Transaction successful!";
                            $data['transaction'] = "Transaction Successful!";
                        }
                    } catch (Exception $e) {
                        // echo $e->getMessage();
                        $data['transaction'] = "Transaction Failed!";
                    }
                }
            }
        }
        $stdMed = RestClient::call("GET", array(), "medicine");
        // var_dump($stdMed);
        $medicines = array();
        foreach($stdMed as $medicine) {
            $newMed = new Medicine();
            $newMed->setMedicineID($medicine->MedicineID);
            $newMed->setMedicineName($medicine->MedicineName);
            $newMed->setDescription($medicine->Description);
            $newMed->setTreatment($medicine->Treatment);
            $medicines[] = $newMed;
        }

        //load helpers
        $this->load->helper(array('html', 'url'));

        $data['title'] = "Medicine";
        $data['medicines'] = $medicines;

        $this->load->view('templates/header', $data);
        $this->load->view('pages/medicine', $data);
        $this->load->view('templates/footer', $data);
    }

    public function transaction() {
        if(LoginManager::verifyLogin() === false || empty($_SESSION)){
            //if no one is logged in then send them back to the login page

            redirect('JJG_Pharma/index.php/login');
        } else {

            $user = RestClient::call("GET", array("id" => $_SESSION['loggedin'] ), "user");
            // var_dump($user);
    
            $client = RestClient::call("GET", array("id"=>$user->UserID),"client");
            // var_dump($client);
    
            $stdTrans = RestClient::call("GET", array("id"=>$client->ClientID), "transaction");
            // var_dump($stdTrans);
            if($stdTrans != null){
    
                $transactionData = array();
    
                // $med = RestClient::call("GET", array("id"=>1),"medicine");
                // var_dump($med);
                foreach($stdTrans as $transaction) {
                    $transactionLine = array();
                    $transactionLine["transaction"] = $transaction;
                    $transactionLine["medicine"] = RestClient::call("GET", array("id"=>$transaction->MedicineID),"medicine");
                    $transactionData[] = $transactionLine;
                }
                $data["transactions"] = $transactionData;
            }else {
                $data["transactions"] = array();
            }
            $data['title'] = "Purchases";
                
            //load helpers
            $this->load->helper(array('html', 'url'));
    
            $this->load->view('templates/header', $data);
            $this->load->view('pages/transaction', $data);
            $this->load->view('templates/footer', $data);

        }
    }

    public function prescription()  {
        //For testing
        // $_SESSION['loggedin'] = "cprydden0";

        //IF user not logged in >> return to login
        if(LoginManager::verifyLogin() === false || empty($_SESSION)){
            //if no one is logged in then send them back to the login page
            redirect('JJG_Pharma/index.php/login');
        }
        else {

            //retrieve user and user prescriptions
            $user = RestClient::call("GET", array("id" => $_SESSION['loggedin'] ), "user");
            // var_dump($user);

            $client = RestClient::call("GET", array("id"=>$user->UserID),"client");
            // var_dump($client);

            $prescriptions = RestClient::call("GET", array("ClientID"=>$client->ClientID), "prescription");
            // var_dump($prescriptions);

            //If POST >> Create, Delete Update
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                switch($_POST["submit"]) {
                    case "create":

                        $newPres = array(
                            "MedicineName" => $_POST["medicinename"],
                            "Description" => $_POST["description"],
                            "ClientID" => $client->ClientID
                        );
                        $result = RestClient::call("POST", $newPres, "prescription");
                        // var_dump($result);
                    break;
                    case "delete":
                        $delPres = array(
                            "PrescriptionID" => $_POST["prescriptionid"],
                        );
                        $result = RestClient::call("DELETE", $delPres, "prescription");
                        // var_dump($result);
                    break;
                    case "edit":
                        $editPres = array(
                            "ClientID" => $client->ClientID,
                            "PrescriptionID" => $_POST["prescriptionid"],
                            "MedicineName" => $_POST["medicinename"],
                            "Description" => $_POST["description"]
                        );
                        $result = RestClient::call("PUT", $editPres, "prescription");
                        // var_dump($result);
                    break;
                }
                redirect('JJG_Pharma/index.php/prescription');
            }

            $data['title'] = "Prescriptions";
            $data["prescriptions"] = $prescriptions;

            //load helpers
            $this->load->helper(array('html', 'url'));

            $this->load->view('templates/header', $data);
            //if edit chosen >> display edit form
            if( isset($_GET["submit"]) && $_GET["submit"] == "edit") {
                $editPrescription = RestClient::call("GET", array("PrescriptionID" => $_GET["prescriptionid"]), "prescription");
                // var_dump($editPrescription);
                $data["editprescription"] = $editPrescription;
                $this->load->view('patron/prescriptionUpdate', $data);   
            }
            $this->load->view('pages/prescription', $data);
            $this->load->view('templates/footer', $data);
        }
    }
    
}