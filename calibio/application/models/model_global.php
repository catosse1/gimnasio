<?php 

class Model_global extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
    //obtenemos las localidades dependiendo de la provincia escogida
    function get_login($email,$password)
	{
        $query = $this->db->query('SELECT * from users where CORREO = "'.$email.'" AND PASSWORD = "'.$password.'"');

	    if($query->num_rows()>0){
	    	echo "Si esta";
	    	header ("Location: ".base_url().'metodos/matricula');
	    	return TRUE;
	    }
	    else{
	    	header ("Location: ".base_url().'login');
	    	echo "No esta";
			return FALSE;
	    }
	}  

	function comprobar()
	{
		if($this->session->userdata('SESSION')=="True"){
	    	return TRUE;
	    }
	    else{
                        echo "Bienvenido";
			header ("Location: ".base_url().'login');
	    }
	}  

	function comprobarlogin()
	{	
		if($this->session->userdata('SESSION') == "True"){                   
	    	header ("Location: ".base_url().'metodos/matricula');
                 echo "Bienvenido";
	    }
	    else{
			return TRUE;
	    }
	}    
}
/*pdf_model.php
 * el modelo
 */