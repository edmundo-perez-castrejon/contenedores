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
            #$this->load->model(array('contratos_model','clientes_model','buques_model','bodegas_model','destinos_model'));
            $this->load->helper(array('url','form'));
        }


    }

    public function listado()
    {
        $crud = new grocery_CRUD();

        $crud->set_table('proveedores');

        $crud->set_theme('datatables');
        /*$crud->columns('username','active','first_name','last_name','claves','id_empresa');

        $crud->fields('username','password','email','active','first_name','last_name','claves','id_empresa');

        $crud->change_field_type('password','password');

        $crud->display_as('username','Usuario')
            ->display_as('email','Correo Electronico')
            ->display_as('first_name','Nombre')
            ->display_as('last_name','Apellidos')
            ->display_as('id_empresa','Empresa tratante')
            ->display_as('claves','Contratos');

*/
        $output = $crud->render();
        $this->load->view('template/header',$output);
        $this->load->view('proveedores/listado',$output);
        $this->load->view('template/footer');
    }

}



/* Location: ./application/controllers/proveedores.php */