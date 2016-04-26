<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

   public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('Model_global');
    }

   // Show view Page
    public function index(){        
        if ($this->Model_global->comprobarlogin()){
            $this->session->sess_destroy();
            $this->load->view("login");                   
        }
    }
    
    //comprobar()

    public function entrar(){
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $nombre = $this->input->post('nombre');
        $rol = "";
        $grado = "";
        if ($this->Model_global->get_login($email,$password,$nombre) ) {

            $query = $this->db->query('SELECT * from users where CORREO = "'.$email.'" AND NOMBRE = "'.$nombre.'"');
            foreach ($query->result() as $row){
                $rol = $row->IDROL;
                $grado = $row->GRADOASIGNADO;
            }

            $this->session->set_userdata('EMAIL',$email);
            $this->session->set_userdata('NOMBRE',$nombre);
            $this->session->set_userdata('SESSION',"True");
             $this->session->set_userdata('IDROL',$rol);
             $this->session->set_userdata('GRADO',$grado);
            echo "Bienvenido ".$this->session->userdata('NOMBRE',$nombre);
        }else{
            echo "Datos incorrectos, Intente nuevamente";
            $this->session->sess_destroy();
        }
    }
}

?>


