<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contenedores extends CI_Controller {

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
            $this->load->helper(array('url','form'));
        }
    }

    public function index()
    {
        $this->data['output'] = 'Dentro del sistema';

        $this->load->view('template/header', $this->data);
        $this->load->view('contenedores/index');
        $this->load->view('template/footer');
    }
}

//fin de arhivo contenedores.php controllaer