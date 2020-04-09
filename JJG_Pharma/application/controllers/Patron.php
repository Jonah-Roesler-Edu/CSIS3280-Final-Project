<?php

//require RESTCLIENT
require_once(APPPATH . "/classes/RestClient.class.php");
require_once(APPPATH . "/classes/LoginManager.class.php");

class Patron extends CI_Controller {

    public function index() {
        echo "TEST INDEX";
    }
    
    public function register(){
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('firstname', 'First Name', 'required');
        $this->form_validation->set_rules('lastname', 'Last NAme', 'required');
        $this->form_validation->set_rules('username', 'User name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('age', 'Age', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('password2', 'Password confirmation', 'required');


        $data['title'] = "Register"; 
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('patron/registrationForm');
            $this->load->view('templates/footer');

        }


    }

    public function login()
    {
        if(LoginManager::verifyLogin()){
       
        }
        // var_dump($_SESSION);
        // $_SESSION["loggedin"] = "chimmy";
        var_dump($_SESSION);
        echo "hello";
            if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }



        if(!empty($_POST)){
            if($_POST["action"] == "login"){

            }
        }


        $data['title'] = "Login"; 

        $this->load->view('templates/header', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer', $data);
        }
}