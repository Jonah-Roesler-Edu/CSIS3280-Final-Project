<?php
require_once(CLASSES_DIR  . "Article.class.php");
class News_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }


    public function get_news($slug = FALSE)
    {
            if ($slug === FALSE)
            {
                    $query = $this->db->get('news');
                    return $query->custom_result_object("Article");
            }

            $query = $this->db->get_where('news', array('slug' => $slug));
            return $query->custom_result_object("Article");
    }

}