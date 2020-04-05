<?php

//http://example.com/[controller-class]/[controller-method]/[arguments]

//require RESTCLIENT
require_once(APPPATH . "/classes/RestClient.class.php");

class MyController extends CI_Controller {

    
    public function index() {
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

    public function test($page = 'search')
    {
        if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
        {
            //PAGE NOT FOUND
            show_404();
        }

        //data associative array = array of objects from $page
        $data['title'] = ucfirst($page); //ucfirst = uppercase first letter

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            var_dump($_POST);
            $testArray = array(
                "test value" => $_POST["action"],
                "hello" => "Hello there!"
            );
            $returnMessage = RestClient::call("POST", $testArray);
            var_dump($returnMessage);
        }

        //view("PATH", PASS_DATA)
        $this->load->view('templates/header', $data);
        $this->load->view('templates/links', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer', $data);

    }

}

?>
