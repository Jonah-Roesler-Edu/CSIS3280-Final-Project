
<?php
class Test extends CI_Controller {

    public function __construct()
    {
            parent::__construct();
            $this->load->model('UserModel');
            $this->load->helper('url_helper');
    }

    public function index()
    {
            $data['users'] = $this->UserModel->getUsers();
            var_dump($data);
    }

    public function view($slug = NULL)
    {
            $data['user_item'] = $this->UserModel->getUsers($slug);
            var_dump($data);
    }
}

?>