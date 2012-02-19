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
            $this->load->model(array('pedimentos_model','clientes_model','proveedores_model','seguimiento_model'));
            $this->load->helper(array('url','form'));
        }


    }

    public function listado()
    {
        $crud = new grocery_CRUD();

        $crud->set_table('pedimentos');



        $crud->set_relation('id_proveedor','proveedores','rfc');
        $crud->set_relation('id_cliente','users','username');
        //$crud->set_relation('id','facturas_pedimento','numero_factura');

        if(!$this->ion_auth->is_admin())
        {

            $crud->where('id_cliente',$this->session->userdata('user_id'));
            $crud->columns('pedimento','id_proveedor','cantidad_contenedores','conocimiento_embarque','numero_cuenta_gastos','fecha_cuenta_gastos');

            $crud->unset_edit();
            $crud->unset_add();
            $crud->unset_delete();

            $crud->add_action('Ver detalle del pedimento',base_url().'images/report_magnify.png','pedimentos/detalle');

        }else{
            $crud->set_theme('datatables');
            $crud->columns('pedimento','id_cliente','id_proveedor','cantidad_contenedores','numero_cuenta_gastos','fecha_cuenta_gastos');
            #Facturas
            $crud->add_action('Facturas', '', 'pedimentos/facturas');

            #Estatus
            $crud->add_action('Seguimiento', '', 'pedimentos/seguimiento');
            #Callback para insertar los ESTATUS
            $crud->callback_after_insert(array($this,'after_insert_pedimento'));

            #Solo vera alguns campos para la edicion
            $crud->edit_fields('cantidad_contenedores','id_proveedor','id_cliente','numero_cuenta_gastos','fecha_cuenta_gastos');

            $crud->set_rules('pedimento','Numero de Pedimento','required|is_unique[pedimentos.pedimento]|exact_length[16]|alpha_numeric');
            $crud->set_rules('conocimiento_embarque','Conocimiento de embarque','required|is_unique[pedimentos.conocimiento_embarque]|exact_length[16]|alpha_numeric');
            $crud->set_rules('cantidad_contenedores','Cantidad de contenedores','required|numeric|greater_than[0]');

        }

        $crud->display_as('id_proveedor','Proveedor')
                ->display_as('id_cliente','Cliente')
                ->display_as('numero_cuenta_gastos','No.Cta Gastos')
                ->display_as('fecha_cuenta_gastos','Fech.Cta Gastos')
                ->display_as('cantidad_contenedores','No.Contenedores');


        $output = $crud->render();
        $this->load->view('template/header',$output);
        $this->load->view('pedimentos/listado',$output);
        $this->load->view('template/footer');
    }

    public function facturas($id_pedimento)
    {

        $crud = new grocery_CRUD();
        $crud->set_table('facturas_pedimentos');
        //$crud->set_theme('datatables');

        if(!$this->ion_auth->is_admin())
        {
            $crud->unset_operations();
        }
        $crud->where('id_pedimento', $id_pedimento);

        $crud->columns('numero_factura');
        $crud->change_field_type('id_pedimento', 'hidden');

        #agregar el id automaticamente
        $crud->callback_before_insert(array($this,'before_insert_factura'));

        $output = $crud->render();

        $data['datos_pedimento']    = $this->pedimentos_model->get_datos($id_pedimento);
        $data['datos_cliente']      = $this->clientes_model->get_datos($data['datos_pedimento']->id_cliente);
        $data['datos_proveedor']    = $this->proveedores_model->get_datos($data['datos_pedimento']->id_proveedor);

        $this->load->view('template/header',$output);
        $this->load->view('pedimentos/datos_pedimento', $data);
        $this->load->view('pedimentos/listado',$output);
        $this->load->view('template/footer');

    }

    public function seguimiento($id_pedimento)
    {
        $crud = new grocery_CRUD();
        $crud->set_table('seguimiento');
        //$crud->set_theme('datatables');

        $crud->where('id_pedimento', $id_pedimento);

        $crud->unset_delete();
        $crud->unset_add();
        $crud->columns('estatus','descripcion','fecha');


        $crud->set_rules('fecha','Fecha de seguimiento','required');
        $crud->change_field_type('id_pedimento', 'hidden');

        $data['datos_pedimento']    = $this->pedimentos_model->get_datos($id_pedimento);
        $data['datos_cliente']      = $this->clientes_model->get_datos($data['datos_pedimento']->id_cliente);
        $data['datos_proveedor']    = $this->proveedores_model->get_datos($data['datos_pedimento']->id_proveedor);


        $output = $crud->render();

        $this->load->view('template/header',$output);
        $this->load->view('pedimentos/datos_pedimento', $data);
        $this->load->view('pedimentos/listado',$output);
        $this->load->view('template/footer');
    }

    public function before_insert_factura($post_array)
    {
        $totalSegment = $this->uri->total_segments();

        $str = '';
        for($i=0; $i<$totalSegment; $i++){
            $str .= '_'. $this->uri->segment($i);
        }

//        $post_array['email'] = $str;
        $post_array['id_pedimento'] = $this->uri->segment($totalSegment-1);

        return $post_array;

    }

    public function after_insert_pedimento($post_array, $id)
    {

        $comma_separated = implode(",", $post_array);
        /*
        * id integer
        * id_pedimento integer
        * estatus tinyint
        * descripcion varchar
        * fecha date
        */
        $data['id_pedimento'] = $id;
        $data['descripcion'] = "Arribo de la carga";
        $this->seguimiento_model->nuevo($data);

        $data['id_pedimento'] = $id;
        $data['descripcion'] = "Revalidacion del conocimiento de embarque";
        $this->seguimiento_model->nuevo($data);

        $data['id_pedimento'] = $id;
        $data['descripcion'] = "Revalidación previos";
        $this->seguimiento_model->nuevo($data);

        $data['id_pedimento'] = $id;
        $data['descripcion'] = "Pago pedimento";
        $this->seguimiento_model->nuevo($data);

        $data['id_pedimento'] = $id;
        $data['descripcion'] = "Salida de contenedores";
        $this->seguimiento_model->nuevo($data);

        $data['id_pedimento'] = $id;
        $data['descripcion'] = "Entrega de vacios";
        $this->seguimiento_model->nuevo($data);

        $data['id_pedimento'] = $id;
        $data['descripcion'] = "Corte de moras";
        $this->seguimiento_model->nuevo($data);

    }

    public function detalle($id_pedimento)
    {
        $crud = new grocery_CRUD();
        $crud->set_table('seguimiento');
        //$crud->set_theme('datatables');

        $crud->where('id_pedimento', $id_pedimento);

        $crud->unset_operations();
        $crud->columns('estatus','descripcion','fecha');

        $data['datos_pedimento']    = $this->pedimentos_model->get_datos($id_pedimento);
        $data['datos_cliente']      = $this->clientes_model->get_datos($data['datos_pedimento']->id_cliente);
        $data['datos_proveedor']    = $this->proveedores_model->get_datos($data['datos_pedimento']->id_proveedor);


        $output = $crud->render();
        $data['output'] = $output;

        #Obtener las facturas
        $this->load->model('facturas_model');
        $lst_facturas = $this->facturas_model->get_datos($id_pedimento);
        $facturas_str = '';

        foreach($lst_facturas as $factura)
        {
            $facturas_str .= $factura->numero_factura.', ';
        }
        $facturas_str = substr($facturas_str,1,strlen($facturas_str)-3).'.';

        $data['datos_proveedor']->facturas = $facturas_str;


        $this->load->view('template/header',$output);
        $this->load->view('pedimentos/detalle',$data);
        $this->load->view('template/footer');
    }

    public function finalizados()
    {
        $crud = new grocery_CRUD();

        $crud->set_table('pedimentos');

        $crud->set_relation('id_proveedor','proveedores','rfc');
        $crud->set_relation('id_cliente','users','username');
        //$crud->set_relation('id','facturas_pedimento','numero_factura');


        //$crud->where('id_cliente',$this->session->userdata('user_id'));
        $crud->where('numero_cuenta_gastos>0','',FALSE);

        $crud->columns('pedimento','id_proveedor','cantidad_contenedores','conocimiento_embarque','numero_cuenta_gastos','fecha_cuenta_gastos');

        $crud->unset_edit();
        $crud->unset_add();
        $crud->unset_delete();

        $crud->add_action('Ver detalle del pedimento',base_url().'images/report_magnify.png','pedimentos/detalle');
        //$crud->unset_operations();


        $crud->display_as('id_proveedor','Proveedor')
            ->display_as('id_cliente','Cliente')
            ->display_as('numero_cuenta_gastos','No.Cta Gastos')
            ->display_as('fecha_cuenta_gastos','Fech.Cta Gastos')
            ->display_as('cantidad_contenedores','No.Contenedores');

        $output = $crud->render();
        $output->title = "Pedimentos finalizados";


        $this->load->view('template/header',$output);
        $this->load->view('pedimentos/finalizados',$output);
        $this->load->view('template/footer');
    }
}



/* Location: ./application/controllers/proveedores.php */