<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

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

    public function grocery_usuarios()
    {
        $crud = new grocery_CRUD();

        $crud->where('username!=',"'root'", FALSE);

        $crud->set_table('users');
        $crud->set_relation_n_n('proveedores','proveedores_users','proveedores','id_user','id_proveedor','rfc');

        $crud->set_theme('datatables');
        $crud->columns('username','active','first_name','last_name', 'proveedores');

        $crud->fields('username','password','email','active','first_name','last_name','proveedores');

        $crud->change_field_type('password','password');

        $crud->display_as('username','Usuario')
            ->display_as('email','Correo Electronico')
            ->display_as('first_name','Nombre')
            ->display_as('last_name','Apellidos');

        $output = $crud->render();
        $this->load->view('template/header',$output);
        $this->load->view('admin/listado_usuarios',$output);
        $this->load->view('template/footer');
    }

    public function configuracion()
    {
        $crud = new grocery_CRUD();

        $crud->set_theme('datatables');
        $crud->set_table('configuracion');

        $crud->set_field_upload('imagen_frontal','images/front');
        $crud->unset_add();

        $crud->unset_delete();

        $output = $crud->render();

        $this->load->view('template/header',$output);
        $this->load->view('admin/configuracion',$output);
        $this->load->view('template/footer');
    }

}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */