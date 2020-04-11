<?php

//http://example.com/[controller-class]/[controller-method]/[arguments]

//require RESTCLIENT
require_once(APPPATH . "/classes/RestClient.class.php");
<<<<<<< HEAD
require_once(APPPATH . "classes/LoginManager.class.php");
=======
require_once(APPPATH . "/classes/Medicine.php");
>>>>>>> 55b9cb0a5b0de31b347043f1ac18826648176399

class MyController extends CI_Controller {

    
    public function index() {
        LoginManager::verifyLogin();
        var_dump($_SESSION);
        echo "TEST INDEX";
    }

     public function view($page = 'search')
    {
        if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
        {
            //PAGE NOT FOUND
            show_404();
        }

        //data associative array = array of objects from $page
        $data['title'] = ucfirst($page); //ucfirst = uppercase first letter

        //view("PATH", PASS_DATA)
        $this->load->view('templates/header', $data);
        $this->load->view('templates/links', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer', $data);

    }

    public function test($page = 'medicine')
    {
        if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
        {
            //PAGE NOT FOUND
            show_404();
        }

        //data associative array = array of objects from $page
        $data['title'] = ucfirst($page); //ucfirst = uppercase first letter

        $testArray = array( "test" => "hello"
        );

        $returnMessage = RestClient::call("GET", $testArray, "medicine");
        // var_dump($returnMessage);
        $medicines = array();
        foreach($returnMessage as $stdMed) {
            $newMed = new Medicine();
            $newMed->setMedicineID($stdMed->MedicineID);
            $newMed->setMedicineName($stdMed->MedicineName);
            $newMed->setTreatment($stdMed->Treatment);
            $newMed->setDescription($stdMed->Description);
            $medicines[] = $newMed;
        }

        $data['medicines'] = $medicines;

        //load helpers
        $this->load->helper(array('html', 'url'));

        //view("PATH", PASS_DATA)
        $this->load->view('templates/header', $data);
        // $this->load->view('templates/links', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer', $data);
    }

}

?>
