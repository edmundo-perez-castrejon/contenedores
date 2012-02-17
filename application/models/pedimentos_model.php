<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Pedimentos_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_datos($id_pedimento)
    {
        $query = $this->db->query('SELECT * FROM pedimentos where id = '.$id_pedimento.' LIMIT 1');


        return  $query->row();
    }
}