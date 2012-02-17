<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedimentos extends CI_Controller {

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

        $crud->set_table('pedimentos');

        $crud->set_theme('datatables');

        $crud->set_relation('id_proveedor','proveedores','rfc');
        $crud->set_relation('id_cliente','users','username');

        $crud->display_as('id_proveedor','Proveedor')
                ->display_as('id_cliente','Cliente');

        $crud->set_rules('pedimento','Numero de Pedimento','required|is_unique[pedimentos.pedimento]|exact_length[16]|alpha_numeric');
        $crud->set_rules('conocimiento_embarque','Conocimiento de embarque','required|is_unique[pedimentos.conocimiento_embarque]|exact_length[16]|alpha_numeric');
        $crud->set_rules('cantidad_contenedores','Cantidad de contenedores','required|numeric|greater_than[0]');

        #Facturas
        $crud->add_action('Facturas', '', 'pedimentos/facturas');

        $output = $crud->render();
        $this->load->view('template/header',$output);
        $this->load->view('pedimentos/listado',$output);
        $this->load->view('template/footer');
    }

    public function facturas($id_pedimento){

        $crud = new grocery_CRUD();
        $crud->set_table('facturas_pedimentos');
        $crud->set_theme('datatables');

        $crud->where('id_pedimento', $id_pedimento);

        $crud->columns('numero_factura');
        $crud->change_field_type('id_pedimento', 'hidden');

        #agregar regla para unicidad de factura


        $crud->callback_before_insert(array($this,'before_insert_factura'));

        $output = $crud->render();

        $this->load->model('pedimentos_model');

        $datos_pedimento  = $this->pedimentos_model->get_datos($id_pedimento);

        $data['datos_pedimento'] = $datos_pedimento;


        $this->load->view('template/header',$output);
        $this->load->view('pedimentos/datos_pedimento', $data);
        $this->load->view('pedimentos/listado',$output);
        $this->load->view('template/footer');

    }

    public function before_insert_factura($post_array){
        $totalSegment = $this->uri->total_segments();

        $str = '';
        for($i=0; $i<$totalSegment; $i++){
            $str .= '_'. $this->uri->segment($i);
        }

//        $post_array['email'] = $str;
        $post_array['id_pedimento'] = $this->uri->segment($totalSegment-1);

        return $post_array;

    }
}



/* Location: ./application/controllers/proveedores.php */