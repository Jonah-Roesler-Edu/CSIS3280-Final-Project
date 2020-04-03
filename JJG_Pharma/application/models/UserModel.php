
<?php
class UserModel extends CI_Model {

    public function __construct()
    {
            $this->load->database();
    }

    public function getUsers($slug = false)
    {
        if ($slug === FALSE)
        {
                $query = $this->db->get('User');
                return $query->result_array();
        }

        $query = $this->db->get_where('Users', array('slug' => $slug));
        return $query->row_array();
    }

}

?>