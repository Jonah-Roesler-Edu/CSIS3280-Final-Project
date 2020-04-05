<?php

// require_once('application\classes\RestClient.class.php');

require_once(CLASSES_DIR  . "RestClient.class.php");
// require_once('application\controllers\RestClient.class.php');



class News extends CI_Controller {


    public function __construct()
    {
            parent::__construct();
            $this->load->model('news_model');
            $this->load->helper('url_helper');
    }

    public function index()
{
        $data['news'] = $this->news_model->get_news();
        $data['title'] = 'News archive';

        $this->load->view('templates/header', $data);
        $this->load->view('news/index', $data);
        $this->load->view('pages/home');
        $this->load->view('templates/footer');

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                var_dump($_POST);
                echo "Post gets thrown back to here from here!";
        }
        $postArr = array(
                "action" => $_POST["action"]
        );
        // $restclient = new RestClient();

        // echo file_get_contents('http://google.ca');
        $test = RestClient::call("POST", $postArr);

        var_dump($test);
        var_dump($data);
}

    public function view($slug = NULL)
    {
            $data['news_item'] = $this->news_model->get_news($slug);

            if (empty($data['news_item']))
            {
                    show_404();
            }
    
            $data['title'] = $data['news_item'][0]->getTitular();
    
            $this->load->view('templates/header', $data);
            $this->load->view('news/view', $data);
            $this->load->view('templates/footer');
    }

    
}