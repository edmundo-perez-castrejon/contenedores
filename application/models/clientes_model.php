<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Clientes_model extends CI_Model
{
    private $table_name = null;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();

        $this->table_name = 'users';
    }

    public function get_datos($id)
    {
        $query = $this->db->get_where('users', array('id' => $id));

        return  $query->row();
    }
}