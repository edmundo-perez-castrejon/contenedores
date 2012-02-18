<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Seguimiento_model extends CI_Model
{
    private $table_name = null;

    /*
     * id integer
     * id_pedimento integer
     * estatus tinyint
     * descripcion varchar
     * fecha date
     */

    public function __construct()
    {
        parent::__construct();
        $this->load->database();

        $this->table_name = 'seguimiento';
    }

    public function get_datos($id)
    {
        $query = $this->db->get_where($this->table_name, array('id' => $id));

        return  $query->row();
    }

    public function nuevo($data)
    {
        $this->db->insert($this->table_name, $data);

    }
}