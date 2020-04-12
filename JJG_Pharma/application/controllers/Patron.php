<?php

//CI form validation from
//https://codeigniter.com/userguide3/libraries/form_validation.html?highlight=password%20match#setting-validation-rules

//require RESTCLIENT
require_once(APPPATH . "/classes/RestClient.class.php");
require_once(APPPATH . "/classes/LoginManager.class.php");
require_once("entities/Medicine.php");

class Patron extends CI_Controller {

    public function __construct()
    {
            parent::__construct();
            
            // $this->load->helper('url_helper');
            $this->load->helper(array('html', 'url'));
    }

    public function index() {
        echo "TEST INDEX";
    }
    
    public function register(){
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('firstname', 'First Name', 'required');
        $this->form_validation->set_rules('lastname', 'Last NAme', 'required');
        $this->form_validation->set_rules('username', 'User name', 'callback_username_check');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('age', 'Age', 'required');
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
            $data['title'] = "Login";
            $this->load->view('templates/header', $data);
            $this->load->view('patron/loginSuccess', $data);
            $this->load->view('templates/footer', $data);
        } else{
            //if the user isn't logged in
             //check post for the login info and validate
             if(isset($_POST) && !empty($_POST)){
                // UserDAO::initialize();
            
                $user = RestClient::call("GET",$_POST,"register");
                var_dump($user);
                if($user !== false && $user != null){
                    $data['title'] = "Login";
                    $_SESSION['loggedin'] = $user->UserName;
                    $this->load->view('templates/header', $data);
                    $this->load->view('patron/loginSuccess', $data);
                    $this->load->view('templates/footer', $data);
                } 

            } else{
                //if there is no post data load the form
                $this->load->helper('form');
                $this->load->library('form_validation');

                $this->form_validation->set_rules('userLogin', 'username', 'required');
                $this->form_validation->set_rules('passLogin', 'password', 'required');

                if ($this->form_validation->run() === FALSE){
                    //if the form isn't filled out or didn't validate
                    //sshow the form
                    $data['title'] = "Login"; 
                    $this->load->view('templates/header', $data);
                    $this->load->view('patron/loginform', $data);
                    $this->load->view('templates/footer', $data);
                }

            }
        }
    }//end login

    public function logout(){
        
        session_start();
        session_destroy();
        echo anchor('JJG_Pharma/index.php/login', 'Login again!'); 

    }//end logout

    public function profile(){

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
            //if logged in then show the user their info with an option to update it
            ?> user info will be here<?php
            //first get the user info from the database

            //next print it to the table


        }

    }

    public function medicine(){

        $data['transaction'] = "";

        //if PURCHASE was pressed
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            //verify login
            if(isset($_POST['medicineid']) && !empty($_POST['medicineid'])) {

                //IF LOGIN = FALSE >> backto login
                if(LoginManager::verifyLogin() === false || empty($_SESSION)){
                    //if no one is logged in then send them back to the login page
                    //or whatever (maybe browse)
                    $this->load->helper('form');
                    $this->load->library('form_validation');
        
                    $data['title'] = "Login"; 
                            $this->load->view('templates/header', $data);
                            $this->load->view('patron/loginform', $data);
                            $this->load->view('templates/footer', $data);
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
                    var_dump($return);
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
    
}