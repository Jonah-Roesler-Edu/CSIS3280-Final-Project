<?php

//CI form validation from
//https://codeigniter.com/userguide3/libraries/form_validation.html?highlight=password%20match#setting-validation-rules

//require RESTCLIENT
require_once(APPPATH . "/classes/RestClient.class.php");
require_once(APPPATH . "/classes/LoginManager.class.php");
require_once(APPPATH . "/entities/User.php");


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
                // var_dump($user);
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

            //if there is post data then it is time to update
            if(isset($_POST) && !empty($_POST)){
                var_dump($_POST);
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
            $data["title"] = "";
            //if the action is set to edit then give them the update form
            if(isset($_GET["action"]) && $_GET["action"] == "edit"){
                $this->load->helper('form');
                $this->load->library('form_validation');

                $this->form_validation->set_rules('firstname', 'First Name', 'required');
                $this->form_validation->set_rules('lastname', 'Last NAme', 'required');
                
                $this->form_validation->set_rules('email', 'Email', 'required');
                $this->form_validation->set_rules('phone', 'Phone', 'required');
                $this->form_validation->set_rules('gender', 'Gender', 'required');
                $this->form_validation->set_rules('age', 'Age', 'required');
               
        
                 
                if ($this->form_validation->run() === FALSE)
                {
                    $this->load->view('templates/header', $data);
                    $this->load->view('patron/updateForm');
                    $this->load->view('templates/footer');
        
                }
                else{

                    $this->load->view('templates/header', $data);
                    $this->load->view('patron/successfulUpdate');
                    $this->load->view('templates/footer');
                }
            }else if(isset($_GET["action"]) && $_GET["action"] == "delete"){
                //send a delete request to the api
            } else{
                //load the info
            $this->load->view('templates/header', $data);
                    $this->load->view('patron/userInfo', $data);
                    $this->load->view('templates/footer', $data);
            
            }



        }

    }
}