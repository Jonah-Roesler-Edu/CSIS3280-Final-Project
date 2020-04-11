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

    public function test($page = 'medicine')
    {
        if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
        {
            //PAGE NOT FOUND
            show_404();
        }

        //data associative array = array of objects from $page
        $data['title'] = ucfirst($page); //ucfirst = uppercase first letter

            var_dump($_GET);
            $testArray = array(
                "test value" => "test",
                "hello" => "Hello there!"
            );
            $returnMessage = json_decode(RestClient::call("GET", $testArray, "medicine"));
            var_dump($returnMessage);


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
