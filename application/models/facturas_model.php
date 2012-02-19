<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Facturas_model extends CI_Model
{
    private $table_name = null;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();

        $this->table_name = 'facturas_pedimentos';
    }

    public function get_datos($id)
    {
        $query = $this->db->get_where($this->table_name, array('id_pedimento' => $id));

        $lst_faturas = array();
        foreach ($query->result() as $row)
        {
            $lst_faturas[] = $row;
        }

        return $lst_faturas;
    }
}