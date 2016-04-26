<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Close extends CI_Controller {

   public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('Model_global');
    }

   // Show view Page
    public function index(){        
        $this->session->sess_destroy();
        if ($this->Model_global->comprobarlogin()){            
            $this->load->view("login");                   
        }
    }
}

?>