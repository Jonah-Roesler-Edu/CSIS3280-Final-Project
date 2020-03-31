<?php

//http://example.com/[controller-class]/[controller-method]/[arguments]
class MyController extends CI_Controller {

    
    public function index() {
        echo "TEST INDEX";
    }

    public function view($page = 'login')
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
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/links', $data);
        $this->load->view('templates/footer', $data);
    }

}

?>