<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proveedores extends CI_Controller {

    private $data = null;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('ion_auth');
        $this->load->library('grocery_CRUD');

        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('auth/login', 'refresh');
        }else{
            $this->load->library('session');
            #$this->load->library('salidas_lib');

            $this->load->model(array('configuracion_model'));
            $this->config->set_item('nombre_sistema',$this->configuracion_model->get_nombre_sistema());
            $this->load->helper(array('url','form'));
        }


    }

    public function listado()
    {
        $crud = new grocery_CRUD();

        $crud->set_table('proveedores');

        $crud->set_theme('datatables');

        $output = $crud->render();
        $this->load->view('template/header',$output);
        $this->load->view('proveedores/listado',$output);
        $this->load->view('template/footer');
    }

}



/* Location: ./application/controllers/proveedores.php */