<?php 

class Pdfs_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	//obtenemos las provincias para cargar en el select
	public function getMatriculano()
	{
		$query = $this->db->get("hojamatricula");
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $fila)
			{
				$data[] = $fila;
			}
				return $data;
		}
	}
    //obtenemos las localidades dependiendo de la provincia escogida
    function getMatricula($id)
	{
        $query = $this->db->query('SELECT * from hojamatricula where IDHOJAMATRICULA = '.$id);
        $data["estudiante"] = array();
	    if($query->num_rows()>0)
	    {
		foreach ($query->result() as $fila)
		{
			$data["estudiante"] = $fila->IDHOJAMATRICULA;
		}
			return $data["estudiante"];
	     }
	}    
}
/*pdf_model.php
 * el modelo
 */