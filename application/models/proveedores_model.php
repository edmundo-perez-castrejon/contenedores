<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Proveedores_model extends CI_Model
{
    private $table_name = null;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();

        $this->table_name = 'proveedores';
    }

    public function get_datos($id)
    {
        $query = $this->db->get_where($this->table_name, array('id' => $id));

        return  $query->row();
    }
}