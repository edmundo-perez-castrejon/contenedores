<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Configuracion_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_imagen_frontal()
    {
        $query = $this->db->query('SELECT imagen_frontal FROM configuracion LIMIT 1');

        $row = $query->result();

        return $row[0]->imagen_frontal;
    }

    public function get_nombre_sistema()
    {
        $query = $this->db->query('SELECT nombre_sistema FROM configuracion LIMIT 1');

        $row = $query->result();

        return $row[0]->nombre_sistema;
    }

}