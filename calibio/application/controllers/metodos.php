<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
  
  ini_set('memory_limit', '-1');

class Metodos extends CI_Controller {

   public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('grocery_CRUD');
        $this->load->library('form_validation');
        $this->load->model('Model_global');
        $this->load->model('pdfs_model');
    }

    public function test(){
      echo $this->session->userdata('IDROL');
    }

   // Show view Page
    public function index(){
        $this->Model_global->comprobarlogin();
        $this->load->view("ajax_post_view");
    }

    // Show view Page
    public function tabla1(){
        $this->load->view("tabla1");
    }

    public function _example_output($output = null)
    {
        $this->load->view('example.php',$output);
    }

    // This function call from AJAX
	public function submit()	{
                $data = array(
                    'username' => $this->input->post('name'),
                    'pwd'=>$this->input->post('pwd')
                        );
	        echo json_encode($data);
	}

      public function test_callback($post_array){
          $post_array['field4'] = 'test';
          return $post_array;
      }


    public function matriculaex(){

          echo $this->load->view('menu');

            $this->Model_global->comprobar();

            if ($this->session->userdata('IDROL')==5) {
              header ("Location: ".base_url().'metodos/grado/'.$this->session->userdata('IDROL'));
            }

            try{
                $crud = new grocery_CRUD(); 
                $crud->set_theme('flexigrid');
                $crud->where('ESTADO','1');
                $crud->set_table('hojamatricula');
                //$crud->columns('ESTADO','NOMBRES','APELLIDOS','TARJETAIDENTIDAD','URL_IMG','GRADO','TELEFONO1');
                 $crud->required_fields('FECHAINGRESO','NUMEROACTAMATRICULA','CONTRATO','NUMEROACTAMATRICULA',
                        'COLEGIOANTERIORINMEDIATO', 'LUGARNACIMIENTO','FECHANACIMIENTO','NUMEROREGISTROCIVIL','TARJETAIDENTIDAD',
                        'DIRECCIONRECIDENCIA','NOMBRES','APELLIDOS','GRADO','RH','TELEFONO1');
                 
                $crud->display_as('FECHAINGRESO','FECHA INGRESO');
                $crud->display_as('NUMEROACTAMATRICULA','MATRICULA');
                $crud->display_as('COLEGIOANTERIORINMEDIATO','COLEGIO ANTERIOR');
                $crud->display_as('LUGARNACIMIENTO','LUGAR DE NACIMIENTO');
                $crud->display_as('FECHANACIMIENTO','FECHA NACIMIENTO');
                $crud->display_as('NUMEROREGISTROCIVIL','REGISTRO CIVIL');
                $crud->display_as('TARJETAIDENTIDAD','T.I.');
                $crud->display_as('DIRECCIONRECIDENCIA','DIRECCIÓN');
                $crud->display_as('CVACUNAS','VACUNAS');
                $crud->display_as('SEROLOGIA','SEROLOGÍA');
                $crud->display_as('VISOMETRIA','VISOMETRÍA');
                $crud->display_as('AUDIOMETRIA','AUDIOMETRÍA');
                
                $crud->display_as('NOMBREPADRE','NOMBRE PADRE');
                $crud->display_as('CEDULAPADRE','CÉDULA PADRE');
                $crud->display_as('ESTADOCIVILPADRE','ESTADO CIVIL');
                $crud->display_as('DIRECCIONROPADRE','DIRECCIÓN PADRE');
                $crud->display_as('OCUPACIONPADRE','OCUPACIÓN PADRE');
                $crud->display_as('TELEFONOPADRE','TELÉFONO PADRE');
                $crud->display_as('CORREOPADRE','EMAIL PADRE');
                
                $crud->display_as('NOMBREMADRE','NOMBRE MADRE');
                $crud->display_as('CEDULAMADRE','CÉDULA MADRE');
                $crud->display_as('ESTADOCIVILMADRE','ESTADO CIVIL');
                $crud->display_as('DIRECCIONROMADRE','DIRECCIÓN MADRE');
                $crud->display_as('OCUPACIONMADRE','OCUPACIÓN MADRE');
                $crud->display_as('TELEFONOMADRE','TELÉFONO MADRE');
                $crud->display_as('CORREOMADRE','EMAIL MADRE');
                
                $crud->display_as('SECRETARIA_IDSECRETARIA','SECRETARIA');                

                $crud->field_type('GENERO','dropdown', array('Masculino' => 'Masculino', 'Femenino' => 'Femenino'));
                $crud->field_type('SIMAT','dropdown', array('1' => 'SI', '2' => 'NO'));
                $crud->field_type('CVACUNAS','dropdown', array('1' => 'SI', '2' => 'NO'));
                $crud->field_type('VISOMETRIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                $crud->field_type('SEROLOGIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                $crud->field_type('AUDIOMETRIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                $crud->field_type('ESTRATO','dropdown', array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6'));
                
                //$crud->field_type('NOMBRES','invisible');
                $crud->callback_before_insert(array($this,'test_callback'));

                $crud->field_type('CVACUNAS','dropdown', array('1' => 'SI', '2' => 'NO'));
                $crud->field_type('VISOMETRIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                $crud->field_type('SEROLOGIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                $crud->field_type('AUDIOMETRIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                
                $crud->add_action('Hoja Matricula', 'https://cdn1.iconfinder.com/data/icons/glaze/16x16/mimetypes/source_f.png', 'metodos/ficha','ui-icon-plus');
                $crud->add_action('Observador', 'https://cdn2.iconfinder.com/data/icons/gnomeicontheme/16x16/stock/object/stock_file-with-objects.png', 'metodos/observador','ui-icon-plus');
                $crud->add_action('Registro entrevista', 'https://cdn4.iconfinder.com/data/icons/technology-devices-1/500/magnifier-16.png', 'metodos/registro','ui-icon-plus');

                if (($this->session->userdata('IDROL') == 3) || ($this->session->userdata('IDROL') == 4) || ($this->session->userdata('IDROL') == 5)) {
                    $crud->unset_add();
                    $crud->unset_edit();
                    $crud->unset_delete();
                }

                $crud->field_type('GRADO','dropdown', array('1' => 'Primero', '2' => 'Segundo', '3' => 'Tercero', '4' => 'Cuarto', '5' => 'Quinto', '6' => 'Sexto', '7' => 'Septimo', '8' => 'Octavo', '9' => 'Noveno', '10' => 'Decimo', '11' => 'Undecimo'));

                $crud->field_type('RH','dropdown', array('A+' => 'A+', 'B+' => 'B+', 'AB+' => 'AB+', 'O+' => 'O+', 'A-' => 'A-', 'B-' => 'B-', 'AB-' => 'AB-', 'O-' => 'O-'));
                $crud->field_type('ESTADO','dropdown', array('1' => 'ACTIVO', '2' => 'INACTIVO'));
                $crud->field_type('ESTADOCIVILMADRE','dropdown', array('1' => 'SOLTERO', '2' => 'CASADO','3' =>'VIUDO','4' =>'UNION LIBRE'));
                $crud->field_type('ESTADOCIVILPADRE','dropdown', array('1' => 'SOLTERO', '2' => 'CASADO','3' =>'VIUDO','4' =>'UNION LIBRE'));

                
                //$crud->columns('NUMEROACTAMATRICULA','NOMBRES','APELLIDOS','TARJETAIDENTIDAD','GRADO','TELEFONO1');
                $crud->set_field_upload('URL_IMG','assets/uploads/files');

                
                //$output['mensaje'] = '<div class="alert alert-success"><strong>Matriculas </strong> Activadas.</div>';
                $output = $crud->render();
                $this->_example_output($output);

            }catch(Exception $e){
                show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }    
    
    public function matricula(){

          echo $this->load->view('menu');

            $this->Model_global->comprobar();

            if ($this->session->userdata('IDROL')==5) {
              header ("Location: ".base_url().'metodos/grado/'.$this->session->userdata('IDROL'));
            }

//    
//            
            try{
                $crud = new grocery_CRUD(); 
                $crud->set_theme('flexigrid');
                $crud->where('ESTADO','1');
                $crud->set_table('hojamatricula');
                $crud->set_subject('hojamatricula'); //Se le asigna un alias al crud
                $crud->columns('ESTADO','NOMBRES','APELLIDOS','TARJETAIDENTIDAD','URL_IMG','GRADO','TELEFONO1');
               $crud->required_fields('FECHAINGRESO','NUMEROACTAMATRICULA','CONTRATO','NUMEROACTAMATRICULA',
                        'COLEGIOANTERIORINMEDIATO', 'LUGARNACIMIENTO','FECHANACIMIENTO','NUMEROREGISTROCIVIL','TARJETAIDENTIDAD',
                       'DIRECCIONRECIDENCIA','NOMBRES','APELLIDOS','GRADO','RH','TELEFONO1');
                
              
                $crud->unique_fields('TARJETAIDENTIDAD','NUMEROACTAMATRICULA','CONTRATO','NUMEROREGISTROCIVIL');
                
                $crud->display_as('FECHAINGRESO','FECHA INGRESO');
                $crud->display_as('NUMEROACTAMATRICULA','MATRICULA');
                $crud->display_as('COLEGIOANTERIORINMEDIATO','COLEGIO ANTERIOR');
                $crud->display_as('LUGARNACIMIENTO','LUGAR DE NACIMIENTO');
                $crud->display_as('FECHANACIMIENTO','FECHA NACIMIENTO');
                $crud->display_as('NUMEROREGISTROCIVIL','REGISTRO CIVIL');
                $crud->display_as('TARJETAIDENTIDAD','T.I.');
                $crud->display_as('DIRECCIONRECIDENCIA','DIRECCIÓN');
                $crud->display_as('TELEFONO1','TELÉFONO');
                $crud->display_as('TELEFONO2','TELÉFONO');
                $crud->display_as('CVACUNAS','VACUNAS');
                $crud->display_as('SEROLOGIA','SEROLOGÍA');
                $crud->display_as('VISOMETRIA','VISOMETRÍA');
                $crud->display_as('AUDIOMETRIA','AUDIOMETRÍA');
                
                
                 $crud->display_as('NOMBREPADRE','NOMBRE PADRE');
                $crud->display_as('CEDULAPADRE','CÉDULA PADRE');
                $crud->display_as('ESTADOCIVILPADRE','ESTADO CIVIL');
                $crud->display_as('DIRECCIONROPADRE','DIRECCIÓN PADRE');
                $crud->display_as('OCUPACIONPADRE','OCUPACIÓN PADRE');
                $crud->display_as('TELEFONOPADRE','TELÉFONO PADRE');
                $crud->display_as('CORREOPADRE','EMAIL PADRE');
                
                $crud->display_as('NOMBREMADRE','NOMBRE MADRE');
                $crud->display_as('CEDULAMADRE','CÉDULA MADRE');
                $crud->display_as('ESTADOCIVILMADRE','ESTADO CIVIL');
                $crud->display_as('DIRECCIONROMADRE','DIRECCIÓN MADRE');
                $crud->display_as('OCUPACIONMADRE','OCUPACIÓN MADRE');
                $crud->display_as('TELEFONOMADRE','TELÉFONO MADRE');
                $crud->display_as('CORREOMADRE','EMAIL MADRE');
                
                $crud->display_as('SECRETARIA_IDSECRETARIA','SECRETARIA');                

                $crud->field_type('GENERO','dropdown', array('Masculino' => 'Masculino', 'Femenino' => 'Femenino'));
                $crud->field_type('SIMAT','dropdown', array('1' => 'SI', '2' => 'NO'));
                $crud->field_type('CVACUNAS','dropdown', array('1' => 'SI', '2' => 'NO'));
                $crud->field_type('VISOMETRIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                $crud->field_type('SEROLOGIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                $crud->field_type('AUDIOMETRIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                $crud->field_type('ESTRATO','dropdown', array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6'));

                //$crud->field_type('NOMBRES','invisible');
                $crud->callback_before_insert(array($this,'test_callback'));

                $crud->field_type('CVACUNAS','dropdown', array('1' => 'SI', '2' => 'NO'));
                $crud->field_type('VISOMETRIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                $crud->field_type('SEROLOGIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                $crud->field_type('AUDIOMETRIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                
                $crud->add_action('Hoja Matricula', 'https://cdn1.iconfinder.com/data/icons/glaze/16x16/mimetypes/source_f.png', 'metodos/ficha','ui-icon-plus');
                $crud->add_action('Observador', 'https://cdn2.iconfinder.com/data/icons/gnomeicontheme/16x16/stock/object/stock_file-with-objects.png', 'metodos/observador','ui-icon-plus');
                $crud->add_action('Registro entrevista', 'https://cdn4.iconfinder.com/data/icons/technology-devices-1/500/magnifier-16.png', 'metodos/registro','ui-icon-plus');

                if (($this->session->userdata('IDROL') == 3) || ($this->session->userdata('IDROL') == 4) || ($this->session->userdata('IDROL') == 5)) {
                    $crud->unset_add();
                    $crud->unset_edit();
                    $crud->unset_delete();
                }

                $crud->field_type('GRADO','dropdown', array('1' => 'Primero', '2' => 'Segundo', '3' => 'Tercero', '4' => 'Cuarto', '5' => 'Quinto', '6' => 'Sexto', '7' => 'Septimo', '8' => 'Octavo', '9' => 'Noveno', '10' => 'Decimo', '11' => 'Undecimo'));

                $crud->field_type('RH','dropdown', array('A+' => 'A+', 'B´+' => 'B+', 'AB+' => 'AB+', 'O+' => 'O+', 'A-' => 'A-', 'B-' => 'B-', 'AB-' => 'AB-', 'O-' => 'O-'));
                $crud->field_type('ESTADO','dropdown', array('1' => 'ACTIVO', '2' => 'INACTIVO'));
                $crud->field_type('ESTADOCIVILMADRE','dropdown', array('1' => 'SOLTERO', '2' => 'CASADO','3' =>'VIUDO','4' =>'UNION LIBRE'));
                $crud->field_type('ESTADOCIVILPADRE','dropdown', array('1' => 'SOLTERO', '2' => 'CASADO','3' =>'VIUDO','4' =>'UNION LIBRE'));

                $crud->columns('NUMEROACTAMATRICULA','NOMBRES','APELLIDOS','TARJETAIDENTIDAD','GRADO','TELEFONO1');
                $crud->set_field_upload('URL_IMG','assets/uploads/files');

                
                //$output['mensaje'] = '<div class="alert alert-success"><strong>Matriculas </strong> Activadas.</div>';
                $output = $crud->render();
                $this->_example_output($output);

            }catch(Exception $e){
                show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }
    
    public function ficha($id){
        //echo $primary_key;
        $this->load->library('Pdf');
        $custom_layout = array(215.9,279.4);
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, $custom_layout, true, 'UTF-8', false);
        //$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
 
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Cesar Tosse');
        $pdf->SetTitle('Colegio Gimnasio Calibio');
        $pdf->SetSubject('Desarrollo a la medida.');
        $pdf->SetKeywords('Gimnasio Calibio, Cesar Tosse, 3107455501, Desarrollador de software, guia');
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "COLEGIO GIMNASIO CALIBIO" . ' SOCIEDAD PEDAGOGICA DEL CAUCA TLDA  ', " CODIGO: F-AD-07 VERSION: 02 FECHA: ".date('Y-M-d')."", array(0, 64, 255), array(0, 64, 128));
        $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetMargins(PDF_MARGIN_LEFT, 9, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 
//relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
 
 
// ---------------------------------------------------------
// establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);
 
// Establecer el tipo de letra
 
//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
// Helvetica para reducir el tamaño del archivo.
        //$pdf->SetFont('freemono', '', 14, '', true);
 
// Añadir una página
// Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();
 
//fijar efecto de sombra en el texto
        //$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
 
// Establecemos el contenido para imprimir
        $provincia = $id;
        $provincias = $this->pdfs_model->getMatricula($provincia);
        echo $provincia;
        //IDHOJAMATRICULA
        $prov = "";
        $query = $this->db->query('SELECT * from hojamatricula where IDHOJAMATRICULA = '.$provincia.' and estado=1');
        foreach ($query->result() as $row){
           echo $row->IDHOJAMATRICULA;
        }
        $imagen = "";
        if ($row->URL_IMG == "") {
          $imagen = "default.jpg";
        }else{
          $imagen = $row->URL_IMG;
        }
 
       
        //preparamos y maquetamos el contenido a crear
        $html = '';
        //<link rel=stylesheet href="'.base_url().'css/table.css" type="text/css"/>
        $html = '
      <head>
      <meta charset="utf-8"/>  
      <meta name="description" content="Resumen del contenido de la página">
 
      <!-- Latest compiled and minified CSS -->
   <style>
 
      table, th, td {
          border: 1px solid black;
          border-collapse: collapse;
      }
 
      table.espacio{
        border-spacing:  15px;
      }
 
      p {
        font-size: 12px;
      }
 
      p.tall {
        line-height  40%;
      }
 
      img.center {
          position: absolute;
          top: 0; bottom:0; left: 0; right:0;
          margin: auto;
      }
      h1 {
          text-align:center;
          margin:-10;
          padding:0;
          vertical-align:middle;
          display:table-cell;
      }
 
      p.subtitle {
        text-align: center;
        margin-top: -30px;
        line-height: -40px;
        font-size: 15px;
      }
     
      p.espacio {
        text-align: center;
        line-height: 20px;
      }
 
      p.center {
        text-align: center;
        line-height: 20px;
      }
      p.th {
        text-align: center;
        line-height: 25px;
        font-size: 15px;
      }
 
      p.center3 {
        text-align: center;
        line-height: 1px;
      }
 
      p.center2 {
        text-align: center;
        line-height: 10px;
        font-size: 15px;
      }
 
      p.title {
        margin-bottom: 25px;
        padding:0;
        position: absolute;
        text-align: center;        
        font-size: 25px;
        line-height: 25px;
      }
 
      p.numero{
        line-height: 26px;
        text-align: center;        
        font-size: 14px;
      }
     
      p.t {
        text-align: center;
      }
 
      p.normal {
        margin-top: -20px;
        line-height: 40px;
      }
 
      h5 {
          text-align: center
      }

      b.c {
          text-align: center
      }
 
      </style>
   </head>
 
      <header>
      </header>
      <article>
        <br>
 
        <table>
          <tr>
            <td rowspan="3"><p class="center" ><img class="center" height="70" src="'.base_url().'assets/calibio-popayan.jpg"></p></td>
            <td colspan="6" rowspan="2"><p class="title"> <b>COLEGIO GIMNASIO CALIBÍO</b></p><p class="subtitle">SOCIEDAD PEDAGÓGICA DEL CAUCA LTDA.</p></td>            
            <td colspan="2"><p >CODIGO: F-AD-07</p></td>
          </tr>
          <tr>      
            <td colspan="2"><p class="normal">VERSION: 02</p></td>
          </tr>
          <tr>
            <td colspan="6"><p class="th" align="center"> <b>HOJA DE MATRICULA.</b></p></td>            
            <td colspan="2"><p>FECHA: 28.JUL.2010</p></td>
          </tr>
        </table>
       
        <br>
        <br>
          <table>
            <tr>
              <td colspan="5"><p class="center2"><center><B><br>DATOS DEL ESTUDIANTE</B></p></center><br></td>              
              <td rowspan="4" align="center"><div></div><img height="130" src="'.base_url().'assets/uploads/files/'.$imagen.'"></td>
            </tr>
            <tr>
              <td colspan="2"><p class="tall">Fecha ingreso:<br> <b>POPAYÁN, '.$row->FECHAINGRESO.'</b></p></td>
              <td  colspan="3"><p class="tall">Acta de Matrícula N°.<br><b class="c">'.$row->NUMEROACTAMATRICULA.'</b></p></td>
            </tr>
            <tr>
              <td colspan="3"><p class="tall">Nombres: <br><b>'.$row->NOMBRES.'</b></p></td>
              <td colspan="2"><p class="tall">Apellidos: <br><b>'.$row->APELLIDOS.'</b></p></td>
            </tr>
            <tr>
              <td colspan="3"><p class="tall">Lugar y fecha de nacimiento: <br><b>'.$row->LUGARNACIMIENTO.'.  '.date("d-m-Y",$row->FECHANACIMIENTO).'</b></p></td>
              <td colspan="2"><p class="tall">Registro Civil N°.<br><b>'.$row->NUMEROREGISTROCIVIL.'</b> </p></td>
            </tr>
            <tr>
              <td><p class="tall">RH:<br><b>'.$row->RH.'</b></p></td>
              <td colspan="3"><p class="tall">Tarjeta de identidad o NUIP: <br><b>'.$row->TARJETAIDENTIDAD.'</b></p></td>              
              <td colspan="2"><p class="tall">Edad:<br> <b>'.$row->EDAD.'</b></p></td>
            </tr>
            <tr>
              <td colspan="3"><p class="tall">Dirección residencia: <br><b>'.$row->DIRECCIONRECIDENCIA.'</b></p></td>
              <td colspan="3"><p class="tall">Teléfonos: <br><b>'.$row->TELEFONO1.' - '.$row->TELEFONO2.'</b></p></td>
            </tr>
            <tr>
              <td colspan="2"><p class="tall">E.P.S. <br><b>'.$row->EPS.'</b></p></td>
              <td colspan="2"><p class="tall">Exámenes: <br><b>'.$row->CVACUNAS.'</b></p></td>
              <td colspan="2"><p class="tall">Colegio anterior: <br><b>'.$row->COLEGIOANTERIORINMEDIATO.'</b></p></td>
            </tr>
          </table >
         <br>
         <table border="1px" width="100%"  class="table table-bordered column-options" >
           
            <tr>
               <th colspan="2"><p class="center2"><center><B><br>DATOS DE LOS PADRES</B></center></p><br></th>
            </tr>
            <tr>
               <td><p class="tall">Nombre del Padre: <br><b>'.$row->NOMBREPADRE.'</b></p></td>
               <td><p class="tall">Nombre de la Madre: <br><b>'.$row->NOMBREMADRE.'</b></p></td>
            </tr>
            <tr>
               <td><p class="tall">Cedula de ciudadanía: <br><b>'.$row->CEDULAPADRE.'</b></p></td>
               <td><p class="tall">Cedula de ciudadanía: <br><b>'.$row->CEDULAMADRE.'</b></p></td>
            </tr>
            <tr>
               <td><p class="tall">Dirección de residencia u oficina: <br><b>'.$row->DIRECCIONROPADRE.'</b></p></td>
               <td><p class="tall">Dirección de residencia u oficina: <br><b>'.$row->DIRECCIONMADRE.'</b></p></td>
            </tr>
            <tr>
               <td><p class="tall">Teléfono: <br><b>'.$row->TELEFONOPADRE.'</b></p></td>
               <td><p class="tall">Teléfono: <br><b>'.$row->TELEFONOMADRE.'</b></p></td>
            </tr>
            <tr>
               <td><p class="tall">Email: <br>'.$row->CORREOPADRE.'</p></td>
               <td><p class="tall">Email: <br>'.$row->CORREOMADRE.'</p></td>
            </tr>
         </table>
         <br>
        <table class"espacio">
          <tr>
            <td colspan="2"><h5>Año</h5></td>
            <td colspan="2"><h5>Grado</h5></td>
            <td><h5>Edad</h5></td>
            <td colspan="4"><h5>Firma del Estudainte</h5></td>
            <td colspan="4"><h5>Firma del Padre o Acudiente</h5></td>
          </tr>
          <tr>
          <td colspan="2"><p class="numero">2015 - 2016</p></td>
            <td colspan="2"></td>
            <td></td>
            <td colspan="4"></td>
            <td colspan="4"></td>
          </tr>
          <tr>
          <td colspan="2"><p class="numero">2016 - 2017</p></td>
            <td colspan="2"></td>
            <td></td>
            <td colspan="4"></td>
            <td colspan="4"></td>
          </tr>
          <tr>
          <td colspan="2"><p class="numero">2017 - 2018</p></td>
            <td colspan="2"></td>
            <td></td>
            <td colspan="4"></td>
            <td colspan="4"></td>
          </tr>
          <tr>
          <td colspan="2"><p class="numero">2018 - 2019</p></td>
            <td colspan="2"></td>
            <td></td>
            <td colspan="4"></td>
            <td colspan="4"></td>
          </tr>
          <tr>
          <td colspan="2"><p class="numero">2019 - 2020</p></td>
            <td colspan="2"></td>
            <td></td>
            <td colspan="4"></td>
            <td colspan="4"></td>
          </tr>
          <tr>
          <td colspan="2"><p class="numero">2020 - 2021</p></td>
            <td colspan="2"></td>
            <td></td>
            <td colspan="4"></td>
            <td colspan="4"></td>
          </tr>
        </table>
            <br>
            <table border="1px" width="100%"  class="table table-bordered column-options" >
            <tr>
               <td colspan="2"><p class="t"><b>Damos constancia conocer el Manual de Convivencia y con nuestras firmas <br>nos comprometemos a darle estricto cumplimiento.</b></p></td>
            </tr>
            <tr>
               <td>Padre o Acudiente <br><br>. </td>
               <td>Estudiante <br><br>.</td>
            </tr>
            <tr>
               <td>Rectoria <br><br>.</td>
               <td>Secretaria <br><br>.</td>
            </tr>
         </table>
         <br>
         <br>
         <center><p class="center3"><b>OBSERVACIONES</b></p></center>
         <p class="espacio">______________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________</p>
         <table border="1px" width="100%"  class="table table-bordered column-options" >
           
            <tr>
               <th colspan="2"><p class="t"><b>DATOS DEL ESTUDIANTE <br> Espacio para cambio de datos del estudiate.</b></p></th>
            </tr>
            <tr>
               <td><p>Apellidos:</p><br></td>
               <td><p>Nombres:</p><br></td>
            </tr>
            <tr>
               <td><p>Dirección Residencia:</p><br></td>
               <td><p>Teléfonos:</p><br></td>
            </tr>
            <tr>
               <td><br><br></td>
               <td><br></td>
            </tr>
            <tr>
               <td><br><br></td>
               <td><br><br></td>
            </tr>
            <tr>
               <td><br><br></td>
               <td><br><br></td>
            </tr>
            <tr>
               <td><br><br></td>
               <td><br><br></td>
            </tr>
         </table>
 
         <table border="1px" width="100%"  class="table table-bordered column-options" >
           
            <tr>
               <th colspan="4"><p class="t"><br><b><center>DATOS OTROS COLEGIOS</center><br></b></p></th>
            </tr>
            <tr>
               <td><p class="t">AÑO</p></td>
               <td><p class="t">GRADO</p></td>
               <td><p class="t">EDAD</p></td>
               <td><p class="t">NOMBRE DEL COLEGIO</p></td>
            </tr>
            <tr>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
            </tr>
            <tr>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
            </tr>
            <tr>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
            </tr>
            <tr>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
            </tr>
            <tr>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
            </tr>
            <tr>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
            </tr>
 
           
         </table>
         </article>
';
        //provincias es la respuesta de la función getProvinciasSeleccionadas($provincia) del modelo
       
 
// Imprimimos el texto con writeHTMLCell()
       
       
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        //echo $html;
// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("Localidadedeasd.pdf");
        ob_clean();
        $pdf->Output($nombre_archivo, 'I');
    }

    public function observador($id){
        //echo $primary_key;
        $this->load->library('Pdf');
        $custom_layout = array(215.9,279.4);
//        $custom_layout = array(215.9,340);
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, $custom_layout, true, 'UTF-8', false);
        //$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Cesar Tosse');
        $pdf->SetTitle('Colegio Gimnasio Calibio');
        $pdf->SetSubject('Desarrollo a la medida.');
        $pdf->SetKeywords('Gimasio Calibio, Cesar Tosse, 3107455501, Desarrollador de software, guia');
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "COLEGIO GIMNASIO CALIBIO" . ' SOCIEDAD PEDAGOGICA DEL CAUCA TLDA  ', " CODIGO: F-AD-07 VERSION: 02 FECHA: ".date('Y-M-d')."", array(0, 64, 255), array(0, 64, 128));
        $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetMargins(PDF_MARGIN_LEFT, 9, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 
//relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
 
 
// ---------------------------------------------------------
// establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);
 
// Establecer el tipo de letra
 
//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
// Helvetica para reducir el tamaño del archivo.
        //$pdf->SetFont('freemono', '', 14, '', true);
 
// Añadir una página
// Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();
 
//fijar efecto de sombra en el texto
        //$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
 
// Establecemos el contenido para imprimir
        $provincia = $id;
        $provincias = $this->pdfs_model->getMatricula($provincia);
        echo $provincia;
        //IDHOJAMATRICULA
        $prov = "";
        $query = $this->db->query('SELECT * from hojamatricula where IDHOJAMATRICULA = '.$provincia.' and estado= 1');
        foreach ($query->result() as $row){
           echo $row->IDHOJAMATRICULA;
        }
        $imagen = "";
        if ($row->URL_IMG == "") {
          $imagen = "default.jpg";
        }else{
          $imagen = $row->URL_IMG;
        }

        //preparamos y maquetamos el contenido a crear
        $html = '';
        //<link rel=stylesheet href="'.base_url().'css/table.css" type="text/css"/>
        $html = '

   <head>
      <meta charset="utf-8"/>   
      <meta name="description" content="Resumen del contenido de la página">

      <!-- Latest compiled and minified CSS -->
   <style>    

      table.cabeza, th.cabeza, td.cabeza{
          border: 1px solid black;
          border-collapse: collapse;
      }

      table.cabeza2{
          border: 2px solid black;
          border-collapse: collapse;
      }

      p {
        font-size: 12px;
      }

      p.tall {
        line-height  40%;
      }

      h2 {
          text-align: center
      }

      h6 {
          text-align: center
      }

      h4 {
          text-align: center
      }

      p.subtitle {
        text-align: center
        margin-top: -20px;
      }

      p.normal {
        margin-top: -20px;
      }

      blac{
        color: #ffffff;
      }

      table.test {
        border: red 7px solid;
      }

      +tbody {
        border: blue 7px solid;
      }


      p {
        font-size: 12px;
      }

      p.tall {
        line-height  40%;
      }

      img.center {
          position: absolute;
          top: 0; bottom:0; left: 0; right:0;
          margin: auto;
      }
      h1 {
          text-align:center; 
          margin:-10;
          padding:0;
          vertical-align:middle; 
          display:table-cell; 
      }

      p.subtitle {
        text-align: center;
        margin-top: -30px;
        line-height: -40px;
        font-size: 15px;
      }

      p.center {
        text-align: center;
        line-height: 20px;
      }
      p.to {
        text-align: center;
        line-height: 25px;
         font-size: 15px;
      }

      p.title {
        margin-bottom: 25px;
        padding:0;
        position: absolute;
        text-align: center;        
        font-size: 25px;
        line-height: 25px;
      }

      p.numero{
        line-height: 25px;
        font-size: 12px;

      }
      
      p.t {
        text-align: center; 
      }

      p.normal {
        margin-top: -20px;
        line-height: 40px;
      }

      h5 {
          text-align: center
      }

      </style>
   </head>

      <header>
      </header>
      <article>
        <br>

        <table class="cabeza">
          <tr class="cabeza">
            <td class="cabeza" rowspan="3"><p class="center" ><img class="center" height="70" src="'.base_url().'assets/calibio-popayan.jpg"></p></td>
            <td class="cabeza" colspan="6" rowspan="2"><p class="title"><b> COLEGIO GIMNASIO CALIBÍO </b> </p><p class="subtitle">SOCIEDAD PEDAGÓGICA DEL CAUCA LTDA.</p></td>            
            <td class="cabeza" colspan="2"><p >CODIGO: F-GA-20</p></td>
          </tr>
          <tr class="cabeza">       
            <td colspan="2"><p class="normal">VERSION: 01</p></td>
          </tr>
          <tr class="cabeza">
            <td class="cabeza" colspan="6"><p class="to" align="center"> <b>OBSERVADOR DEL ESTUDIANTE.</b></p></td>            
            <td class="cabeza" colspan="2"><p>FECHA: 20.AGO.2010</p></td>
          </tr>
        </table>

        <br>
        <br>

        <table class="cabeza">
          <tr>
            <td class="cabeza" colspan="8"><h4>DATOS PERSONALES Y FAMILIARES</h4></td>
            <td class="cabeza" colspan="2" rowspan="6" align="center"><p><img height="130" src="'.base_url().'assets/uploads/files/'.$imagen.'"></p></td>
          </tr>
          <tr>
            <td class="" colspan="4"><p class="numero">Nombres: <b>'.$row->NOMBRES.'</b></p></td>
            <td class="" colspan="4"><p class="numero">Apellidos: <b>'.$row->APELLIDOS.'</b></p></td>
          </tr>
          <tr>
            <td class="" colspan="4"><p class="numero">Años cumplidos: <b>'.$row->EDAD.'</b></p></td>
            <td class="" colspan="2"><p class="numero">No. Matricula: <b>'.$row->NUMEROACTAMATRICULA.'</b></p></td>
            <td class="" colspan="2"><p class="numero">Curso: <b>'.$row->GRADO.'</b></p></td>
          </tr>
          <tr>
            <td class="" colspan="4"><p class="numero">No. de hermanos: </p></td>
            <td class="" colspan="2"><p class="numero">Lugar que ocupa: </p></td>
            <td class="" colspan="2"><p class="numero">R.H:  <b>'.$row->RH.'</b></p></td>
          </tr>
          <tr>
            <td class="" colspan="5"><p class="numero">Dirección: <b>'.$row->DIRECCIONRECIDENCIA.'</b></p></td>
            <td class="" colspan="3"><p class="numero">Teléfonos <b>'.$row->TELEFONO1.' '.$row->TELEFONO2.'</b></p></td>
          </tr>
          <tr>
            <td class="" colspan="8"><p class="numero">Emails: <b>'.$row->CORREOPADRE.' &#09;  '.$row->CORREOMADRE.'</b></p></td>
          </tr>
          <tr>
            <td class="" colspan="10"><p class="numero">Con quien vive: ________________________________________________________________________________</p></td>
          </tr>
          <tr>
            <td class="" colspan="6"><p class="numero">Nombre del Padre: <b>'.$row->NOMBREPADRE.'</b></p></td>
            <td class="" colspan="4"><p class="numero">Ocupación: <b>'.$row->OCUPACIONPADRE.'</b></p></td>
          </tr>
          <tr>
            <td class="" colspan="6"><p class="numero">Empresa donde trabaja: <b>'.$row->DIRECCIONROPADRE.'</b></p></td>
            <td class="" colspan="4"><p class="numero">Teléfono: <b>'.$row->TELEFONOPADRE.'</b></p></td>
          </tr>
          <tr>
            <td class="" colspan="6"><p class="numero">Nombre de la Madre: <b>'.$row->NOMBREMADRE.'</b></p></td>
            <td class="" colspan="4"><p class="numero">Ocupación: <b>'.$row->OCUPACIONMADRE.'</b></p></td>
          </tr>
          <tr>
            <td class="" colspan="6"><p class="numero">Empresa donde trabaja: <b>'.$row->DIRECCIONROMADRE.'</b></p></td>
            <td class="" colspan="4"><p class="numero">Teléfono: <b>'.$row->TELEFONOMADRE.'</b></p></td>
          </tr>
        </table>
        <br>
        <br>

        <table class="cabeza" >
          <tr class="cabeza">
            <td class="cabeza" colspan="5"><h4>DATOS ESCOLARES</h4></td>
          </tr>        
        </table>
        Planteles en que ha estudiado:<br>
        
        <table class="cabeza" >
          <tr class="cabeza">
            <td class="cabeza" colspan="3"><p class="t">COLEGIO</p></td>
            <td class="cabeza" colspan="2"><p class="t">CIUDAD</p></td>
            <td class="cabeza" colspan="2"><p class="t">AÑO</p></td>
            <td class="cabeza" colspan="2"><p class="t">CURSO</p></td>
          </tr> 
          <tr class="cabeza">
            <td class="cabeza" colspan="3"></td>
            <td class="cabeza" colspan="2"></td>
            <td class="cabeza" colspan="2"></td>
            <td class="cabeza" colspan="2"></td>
          </tr> 
          <tr class="cabeza">
            <td class="cabeza" colspan="3"></td>
            <td class="cabeza" colspan="2"></td>
            <td class="cabeza" colspan="2"></td>
            <td class="cabeza" colspan="2"></td>
          </tr> 
          <tr class="cabeza">
            <td class="cabeza" colspan="3"></td>
            <td class="cabeza" colspan="2"></td>
            <td class="cabeza" colspan="2"></td>
            <td class="cabeza" colspan="2"></td>
          </tr> 
          <tr class="cabeza">
            <td class="cabeza" colspan="3"></td>
            <td class="cabeza" colspan="2"></td>
            <td class="cabeza" colspan="2"></td>
            <td class="cabeza" colspan="2"></td>
          </tr> 
          <tr class="cabeza">
            <td class="cabeza" colspan="3"></td>
            <td class="cabeza" colspan="2"></td>
            <td class="cabeza" colspan="2"></td>
            <td class="cabeza" colspan="2"></td>
          </tr>        
        </table>
        <br><br>
         <table class="cabeza2" >
          <tr class="cabeza">
            <td class="cabeza" ><h4>PROCESO CONVIVENCIAL, FORMATIVO Y ACADÉMICO</h4></td>
          </tr>        
        </table>
        <br>
        <table>
          <tr class="cabeza">
          <td class="cabeza" ><h6>FECHA - MOTIVO - FIRMAS: DOCENTE Y ESTUDIANTE</h6></td>
          </tr>

          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
         
          
        </table>

        <br><br>
         <table class="cabeza2" >
          <tr class="cabeza">
            <td class="cabeza" ><h4>PROCESO CONVIVENCIONAL, FORMATIVO Y ACADEMICO</h4></td>
          </tr>        
        </table>

        <table>
          <tr class="cabeza">
          <td class="cabeza" ><h6>FECHA - MOTIVO - FIRMAS: DOCENTE Y ESTUDIANTE</h6></td>
          </tr>
        </table>

        <table>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
                    
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
        
          
        </table>

      </article>
';
        //provincias es la respuesta de la función getProvinciasSeleccionadas($provincia) del modelo
        
 
// Imprimimos el texto con writeHTMLCell()
        
        
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        //echo $html;
// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("Localidadedeasd.pdf");
        ob_clean();
        $pdf->Output($nombre_archivo, 'I');
    }

    public function registro($id){
        //echo $primary_key;
        $this->load->library('Pdf');
        $custom_layout = array(215.9,279.4);
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, $custom_layout, true, 'UTF-8', false);
        //$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
 
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Cesar Tosse');
        $pdf->SetTitle('Colegio Gimnasio Calibio');
        $pdf->SetSubject('Desarrollo a la medida.');
        $pdf->SetKeywords('Gimnasio Calibio, Cesar Tosse, 3107455501, Desarrollador de software, guia');
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "COLEGIO GIMNASIO CALIBIO" . ' SOCIEDAD PEDAGOGICA DEL CAUCA TLDA  ', " CODIGO: F-AD-07 VERSION: 02 FECHA: ".date('Y-M-d')."", array(0, 64, 255), array(0, 64, 128));
        $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetMargins(PDF_MARGIN_LEFT, 9, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 
//relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
 
 
// ---------------------------------------------------------
// establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);
 
// Establecer el tipo de letra
 
//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
// Helvetica para reducir el tamaño del archivo.
        //$pdf->SetFont('freemono', '', 14, '', true);
 
// Añadir una página
// Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();
 
//fijar efecto de sombra en el texto
        //$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
 
// Establecemos el contenido para imprimir
        $provincia = $id;
        $provincias = $this->pdfs_model->getMatricula($provincia);
        echo $provincia;
        //IDHOJAMATRICULA
        $prov = "";
        $query = $this->db->query('SELECT * from hojamatricula where IDHOJAMATRICULA = '.$provincia.' and estado =1');
        foreach ($query->result() as $row){
           echo $row->IDHOJAMATRICULA;
        }
        $imagen = "";
        if ($row->URL_IMG == "") {
          $imagen = "default.jpg";
        }else{
          $imagen = $row->URL_IMG;
        }
 
        //preparamos y maquetamos el contenido a crear
        $html = '';
        //<link rel=stylesheet href="'.base_url().'css/table.css" type="text/css"/>
        $html = '
 
   <head>
      <meta charset="utf-8"/>  
      <meta name="description" content="Resumen del contenido de la página">
 
      <!-- Latest compiled and minified CSS -->
   <style>
 
      table.cabeza, th.cabeza, td.cabeza{
          border: 1px solid black;
          border-collapse: collapse;
      }
 
      table.cabeza2{
          border: 2px solid black;
          border-collapse: collapse;
      }
 
      p {
        font-size: 12px;
      }
 
      p.tall {
        line-height  40%;
      }
 
      img.center {
          position: absolute;
          top: 0; bottom:0; left: 0; right:0;
          margin: auto;
      }
      h1 {
          text-align:center;
          margin:-10;
          padding:0;
          vertical-align:middle;
          display:table-cell;
      }
 
      p.subtitle {
        text-align: center;
        margin-top: -30px;
        line-height: -40px;      
        font-size: 15px;
      }
 
      p.center {
        text-align: center;
        line-height: 25px;  
        font-size: 15px;
      }
 
      p.title {
        margin-bottom: 25px;
        padding:0;
        position: absolute;
        text-align: center;        
        font-size: 25px;
        line-height: 25px;
      }
 
      p.numero{
        line-height: 26px;
        text-align: center;        
        font-size: 14px;
      }
     
      p.t {
        text-align: center;
      }
 
      p.normal {
        margin-top: -20px;
        line-height: 40px;
      }
 
      h5 {
          text-align: center
      }
      </style>
   </head>
 
      <header>
      </header>
      <article>
        <br>
 
        <table class="cabeza">
          <tr class="cabeza">
            <td class="cabeza" rowspan="3"><p class="center" ><img class="center" height="70" src="'.base_url().'assets/calibio-popayan.jpg"></p></td>
            <td class="cabeza" colspan="6" rowspan="2"><p class="title"><b> COLEGIO GIMNASIO CALIBÍO</b></p><p class="subtitle">SOCIEDAD PEDAGÓGICA DEL CAUCA LTDA.</p></td>            
            <td class="cabeza" colspan="2"><p >CODIGO: F-GA-18</p></td>
          </tr>
          <tr class="cabeza">      
            <td colspan="2"><p class="normal">VERSION: 01</p></td>
          </tr>
          <tr class="cabeza">
            <td class="cabeza" colspan="6"><p class="center"><b>REGISTRO DE ENTREVISTAS.</b></p></td>            
            <td class="cabeza" colspan="2"><p>FECHA: 20.AGO.2010</p></td>
          </tr>
        </table>
        <br>
        <br>
 
        <table >
          <tr>
            <td colspan="9"><p><B>Nombre del Estudiante: '.$row->NOMBRES.' '.$row->APELLIDOS.'</B></p></td>
            <td colspan="2"><p><B>Grado: '.$row->GRADO.'</B></p></td>
          </tr>
          <tr>
            <td colspan="7"><p><B>Nombre del Padre: '.$row->NOMBREPADRE.'</B></p></td>
            <td colspan="4"><p><B>Ocupación: '.$row->OCUPACIONPADRE.'</B></p></td>
          </tr>
          <tr>
            <td colspan="7"><p><B>Nombre de la Madre: '.$row->NOMBREMADRE.'</B></p></td>
            <td colspan="4"><p><B>Ocupación: '.$row->OCUPACIONMADRE.'</B></p></td>
          </tr>
        </table>
 
        <br>
        <br>
 
        <table class="cabeza">
          <tr>
            <td class="cabeza">Fecha</td>
            <td colspan="11" class="cabeza"><P class="center"><b>ASPECTOS A TRATAR</b></p></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
         
         
        </table>
        <table>
         <tr BGCOLOR="#000000">
              <td><font color="#fff"> Fecha</font></td>
              <td colspan="11"><p color="#fff" class="center">ASPECTOS A TRATAR</p></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td></td>
              <td colspan="11"></td>
          </tr>
         
         
        </table>
 
      </article>
';
        //provincias es la respuesta de la función getProvinciasSeleccionadas($provincia) del modelo
       
 
// Imprimimos el texto con writeHTMLCell()
       
       
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        //echo $html;
// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("Localidadedeasd.pdf");
        ob_clean();
        $pdf->Output($nombre_archivo, 'I');
    }    
    
    public function matriculaoff(){

          echo $this->load->view('menu');

            $this->Model_global->comprobar();

            if ($this->session->userdata('IDROL')==5) {
              header ("Location: ".base_url().'metodos/grado/'.$this->session->userdata('IDROL'));
            }

//    
//            
            try{
                $crud = new grocery_CRUD(); 
                $crud->set_theme('flexigrid');
                $crud->where('ESTADO','2');
                $crud->set_table('hojamatricula');
                $crud->set_subject('hojamatricula'); //Se le asigna un alias al crud
                //$crud->columns('ESTADO','NOMBRES','APELLIDOS','TARJETAIDENTIDAD','URL_IMG','GRADO','TELEFONO1');
                $crud->required_fields('FECHAINGRESO','NUMEROACTAMATRICULA','CONTRATO','NUMEROACTAMATRICULA',
                        'COLEGIOANTERIORINMEDIATO', 'LUGARNACIMIENTO','FECHANACIMIENTO','NUMEROREGISTROCIVIL','TARJETAIDENTIDAD',
                        'DIRECCIONRECIDENCIA','NOMBRES','APELLIDOS','GRADO','RH','TELEFONO1');
                
                $crud->display_as('FECHAINGRESO','FECHA INGRESO');
                $crud->display_as('NUMEROACTAMATRICULA','MATRICULA');
                $crud->display_as('COLEGIOANTERIORINMEDIATO','COLEGIO ANTERIOR');
                $crud->display_as('LUGARNACIMIENTO','LUGAR DE NACIMIENTO');
                $crud->display_as('FECHANACIMIENTO','FECHA NACIMIENTO');
                $crud->display_as('NUMEROREGISTROCIVIL','REGISTRO CIVIL');
                $crud->display_as('TARJETAIDENTIDAD','T.I.');
                $crud->display_as('DIRECCIONRECIDENCIA','DIRECCIÓN');
                $crud->display_as('TELEFONO1','TELÉFONO');
                $crud->display_as('TELEFONO2','TELÉFONO');
                $crud->display_as('CVACUNAS','VACUNAS');
                $crud->display_as('SEROLOGIA','SEROLOGÍA');
                $crud->display_as('VISOMETRIA','VISOMETRÍA');
                $crud->display_as('AUDIOMETRIA','AUDIOMETRÍA');
                
                
                 $crud->display_as('NOMBREPADRE','NOMBRE PADRE');
                $crud->display_as('CEDULAPADRE','CÉDULA PADRE');
                $crud->display_as('ESTADOCIVILPADRE','ESTADO CIVIL');
                $crud->display_as('DIRECCIONROPADRE','DIRECCIÓN PADRE');
                $crud->display_as('OCUPACIONPADRE','OCUPACIÓN PADRE');
                $crud->display_as('TELEFONOPADRE','TELÉFONO PADRE');
                $crud->display_as('CORREOPADRE','EMAIL PADRE');
                
                $crud->display_as('NOMBREMADRE','NOMBRE MADRE');
                $crud->display_as('CEDULAMADRE','CÉDULA MADRE');
                $crud->display_as('ESTADOCIVILMADRE','ESTADO CIVIL');
                $crud->display_as('DIRECCIONROMADRE','DIRECCIÓN MADRE');
                $crud->display_as('OCUPACIONMADRE','OCUPACIÓN MADRE');
                $crud->display_as('TELEFONOMADRE','TELÉFONO MADRE');
                $crud->display_as('CORREOMADRE','EMAIL MADRE');
                
                $crud->display_as('SECRETARIA_IDSECRETARIA','SECRETARIA');                

                $crud->field_type('GENERO','dropdown', array('Masculino' => 'Masculino', 'Femenino' => 'Femenino'));
                $crud->field_type('SIMAT','dropdown', array('1' => 'SI', '2' => 'NO'));
                $crud->field_type('CVACUNAS','dropdown', array('1' => 'SI', '2' => 'NO'));
                $crud->field_type('VISOMETRIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                $crud->field_type('SEROLOGIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                $crud->field_type('AUDIOMETRIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                $crud->field_type('ESTRATO','dropdown', array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6'));

                //$crud->field_type('NOMBRES','invisible');
                $crud->callback_before_insert(array($this,'test_callback'));

                $crud->field_type('CVACUNAS','dropdown', array('1' => 'SI', '2' => 'NO'));
                $crud->field_type('VISOMETRIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                $crud->field_type('SEROLOGIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                $crud->field_type('AUDIOMETRIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                
                $crud->add_action('Hoja Matricula', 'https://cdn1.iconfinder.com/data/icons/glaze/16x16/mimetypes/source_f.png', 'metodos/ficha','ui-icon-plus');
                $crud->add_action('Observador', 'https://cdn2.iconfinder.com/data/icons/gnomeicontheme/16x16/stock/object/stock_file-with-objects.png', 'metodos/observador','ui-icon-plus');
                $crud->add_action('Registro entrevista', 'https://cdn4.iconfinder.com/data/icons/technology-devices-1/500/magnifier-16.png', 'metodos/registro','ui-icon-plus');

                if (($this->session->userdata('IDROL') == 3) || ($this->session->userdata('IDROL') == 4) || ($this->session->userdata('IDROL') == 5)) {
                    $crud->unset_add();
                    $crud->unset_edit();
                    $crud->unset_delete();
                }

                $crud->field_type('GRADO','dropdown', array('1' => 'Primero', '2' => 'Segundo', '3' => 'Tercero', '4' => 'Cuarto', '5' => 'Quinto', '6' => 'Sexto', '7' => 'Septimo', '8' => 'Octavo', '9' => 'Noveno', '10' => 'Decimo', '11' => 'Undecimo'));

                $crud->field_type('RH','dropdown', array('A+' => 'A+', 'B´+' => 'B+', 'AB+' => 'AB+', 'O+' => 'O+', 'A-' => 'A-', 'B-' => 'B-', 'AB-' => 'AB-', 'O-' => 'O-'));
                $crud->field_type('ESTADO','dropdown', array('1' => 'ACTIVO', '2' => 'INACTIVO'));
                $crud->field_type('ESTADOCIVILMADRE','dropdown', array('1' => 'SOLTERO', '2' => 'CASADO','3' =>'VIUDO','4' =>'UNION LIBRE'));
                $crud->field_type('ESTADOCIVILPADRE','dropdown', array('1' => 'SOLTERO', '2' => 'CASADO','3' =>'VIUDO','4' =>'UNION LIBRE'));

                $crud->columns('NUMEROACTAMATRICULA','NOMBRES','APELLIDOS','TARJETAIDENTIDAD','GRADO','TELEFONO1');
                $crud->set_field_upload('URL_IMG','assets/uploads/files');

                
                //$output['mensaje'] = '<div class="alert alert-success"><strong>Matriculas </strong> Activadas.</div>';
                $output = $crud->render();
                $this->_example_output($output);

            }catch(Exception $e){
                show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }
    
     public function matriculaall(){

          echo $this->load->view('menu');

            $this->Model_global->comprobar();

            if ($this->session->userdata('IDROL')==5) {
              header ("Location: ".base_url().'metodos/grado/'.$this->session->userdata('IDROL'));
            }

//    
//            
            try{
                $crud = new grocery_CRUD(); 
                $crud->set_theme('flexigrid');
//                $crud->where('ESTADO','2');
                $crud->set_table('hojamatricula');
                $crud->set_subject('hojamatricula'); //Se le asigna un alias al crud
                //$crud->columns('ESTADO','NOMBRES','APELLIDOS','TARJETAIDENTIDAD','URL_IMG','GRADO','TELEFONO1');
                $crud->required_fields('FECHAINGRESO','NUMEROACTAMATRICULA','CONTRATO','NUMEROACTAMATRICULA',
                        'COLEGIOANTERIORINMEDIATO', 'LUGARNACIMIENTO','FECHANACIMIENTO','NUMEROREGISTROCIVIL','TARJETAIDENTIDAD',
                        'DIRECCIONRECIDENCIA','NOMBRES','APELLIDOS','GRADO','RH','TELEFONO1');
                
                $crud->display_as('FECHAINGRESO','FECHA INGRESO');
                $crud->display_as('NUMEROACTAMATRICULA','MATRICULA');
                $crud->display_as('COLEGIOANTERIORINMEDIATO','COLEGIO ANTERIOR');
                $crud->display_as('LUGARNACIMIENTO','LUGAR DE NACIMIENTO');
                $crud->display_as('FECHANACIMIENTO','FECHA NACIMIENTO');
                $crud->display_as('NUMEROREGISTROCIVIL','REGISTRO CIVIL');
                $crud->display_as('TARJETAIDENTIDAD','T.I.');
                $crud->display_as('DIRECCIONRECIDENCIA','DIRECCIÓN');
                $crud->display_as('TELEFONO1','TELÉFONO');
                $crud->display_as('TELEFONO2','TELÉFONO');
                $crud->display_as('CVACUNAS','VACUNAS');
                $crud->display_as('SEROLOGIA','SEROLOGÍA');
                $crud->display_as('VISOMETRIA','VISOMETRÍA');
                $crud->display_as('AUDIOMETRIA','AUDIOMETRÍA');
                
                
                 $crud->display_as('NOMBREPADRE','NOMBRE PADRE');
                $crud->display_as('CEDULAPADRE','CÉDULA PADRE');
                $crud->display_as('ESTADOCIVILPADRE','ESTADO CIVIL');
                $crud->display_as('DIRECCIONROPADRE','DIRECCIÓN PADRE');
                $crud->display_as('OCUPACIONPADRE','OCUPACIÓN PADRE');
                $crud->display_as('TELEFONOPADRE','TELÉFONO PADRE');
                $crud->display_as('CORREOPADRE','EMAIL PADRE');
                
                $crud->display_as('NOMBREMADRE','NOMBRE MADRE');
                $crud->display_as('CEDULAMADRE','CÉDULA MADRE');
                $crud->display_as('ESTADOCIVILMADRE','ESTADO CIVIL');
                $crud->display_as('DIRECCIONROMADRE','DIRECCIÓN MADRE');
                $crud->display_as('OCUPACIONMADRE','OCUPACIÓN MADRE');
                $crud->display_as('TELEFONOMADRE','TELÉFONO MADRE');
                $crud->display_as('CORREOMADRE','EMAIL MADRE');
                
                $crud->display_as('SECRETARIA_IDSECRETARIA','SECRETARIA');                

                $crud->field_type('GENERO','dropdown', array('Masculino' => 'Masculino', 'Femenino' => 'Femenino'));
                $crud->field_type('SIMAT','dropdown', array('1' => 'SI', '2' => 'NO'));
                $crud->field_type('CVACUNAS','dropdown', array('1' => 'SI', '2' => 'NO'));
                $crud->field_type('VISOMETRIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                $crud->field_type('SEROLOGIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                $crud->field_type('AUDIOMETRIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                $crud->field_type('ESTRATO','dropdown', array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6'));

                //$crud->field_type('NOMBRES','invisible');
                $crud->callback_before_insert(array($this,'test_callback'));

                $crud->field_type('CVACUNAS','dropdown', array('1' => 'SI', '2' => 'NO'));
                $crud->field_type('VISOMETRIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                $crud->field_type('SEROLOGIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                $crud->field_type('AUDIOMETRIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                
                $crud->add_action('Hoja Matricula', 'https://cdn1.iconfinder.com/data/icons/glaze/16x16/mimetypes/source_f.png', 'metodos/ficha','ui-icon-plus');
                $crud->add_action('Observador', 'https://cdn2.iconfinder.com/data/icons/gnomeicontheme/16x16/stock/object/stock_file-with-objects.png', 'metodos/observador','ui-icon-plus');
                $crud->add_action('Registro entrevista', 'https://cdn4.iconfinder.com/data/icons/technology-devices-1/500/magnifier-16.png', 'metodos/registro','ui-icon-plus');

                if (($this->session->userdata('IDROL') == 3) || ($this->session->userdata('IDROL') == 4) || ($this->session->userdata('IDROL') == 5)) {
                    $crud->unset_add();
                    $crud->unset_edit();
                    $crud->unset_delete();
                }

                $crud->field_type('GRADO','dropdown', array('1' => 'Primero', '2' => 'Segundo', '3' => 'Tercero', '4' => 'Cuarto', '5' => 'Quinto', '6' => 'Sexto', '7' => 'Septimo', '8' => 'Octavo', '9' => 'Noveno', '10' => 'Decimo', '11' => 'Undecimo'));

                $crud->field_type('RH','dropdown', array('A+' => 'A+', 'B´+' => 'B+', 'AB+' => 'AB+', 'O+' => 'O+', 'A-' => 'A-', 'B-' => 'B-', 'AB-' => 'AB-', 'O-' => 'O-'));
                $crud->field_type('ESTADO','dropdown', array('1' => 'ACTIVO', '2' => 'INACTIVO'));
                $crud->field_type('ESTADOCIVILMADRE','dropdown', array('1' => 'SOLTERO', '2' => 'CASADO','3' =>'VIUDO','4' =>'UNION LIBRE'));
                $crud->field_type('ESTADOCIVILPADRE','dropdown', array('1' => 'SOLTERO', '2' => 'CASADO','3' =>'VIUDO','4' =>'UNION LIBRE'));

                $crud->columns('NUMEROACTAMATRICULA','NOMBRES','APELLIDOS','TARJETAIDENTIDAD','GRADO','TELEFONO1');
                $crud->set_field_upload('URL_IMG','assets/uploads/files');

                
                //$output['mensaje'] = '<div class="alert alert-success"><strong>Matriculas </strong> Activadas.</div>';
                $output = $crud->render();
                $this->_example_output($output);

            }catch(Exception $e){
                show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
    }

     public function usuario($ESTADO = "1")    {
        echo $this->load->view('menu');


        if (($this->session->userdata('IDROL') == 3) || ($this->session->userdata('IDROL') == 4) || ($this->session->userdata('IDROL') == 5)) {
            header ("Location: ".base_url().'metodos/matricula');
        }else{
          try{
                $this->config->set_item('grocery_crud_dialog_forms',true);
                $this->config->set_item('grocery_crud_default_per_page',20);
                $crud = new grocery_CRUD();            
//                $crud->set_theme('datatables');
                 $crud->set_theme('flexigrid');
                
                $crud->required_fields('IDESTADOUSUARIO','IDROL');
                //$crud->where('ESTADO','Inactiva');
                 $crud->display_as('IDROL','ROL');
                 $crud->display_as('IDESTADOUSUARIO','ESTADO');
                 $crud->display_as('DIRECCION','DIRECCIÓN');
                $crud->display_as('TELEFONO','TELÉFONO');   
                $crud->display_as('GRADOASIGNADO','GRADO ASIGNADO');   
                $crud->display_as('FNACIMIENTO','FECHA NACIMIENTO');   
                $crud->display_as('AREA','AREA ASIGNADA');   
                $crud->set_table('users');
                $crud->set_relation('IDROL','rol','NOMBRE');
                $crud->field_type('IDESTADOUSUARIO','dropdown', array('1' => 'ACTIVO', '2' => 'INACTIVO'));
                $crud->field_type('AUXILIAR','dropdown', array('SI' => 'SI', 'NO' => 'NO'));
                $crud->field_type('GRADOASIGNADO','dropdown', array('1' => 'Primero', '2' => 'Segundo', '3' => 'Tercero', '4' => 'Cuarto', '5' => 'Quinto', '6' => 'Sexto', '7' => 'Septimo', '8' => 'Octavo', '9' => 'Noveno', '10' => 'Decimo', '11' => 'Undecimo'));
               
                $crud->columns('IDROL','NOMBRE','APELLIDO','IDENTIFICACION','CORREO','TELEFONO','CELULAR','FNACIMIENTO', 'GRADOASIGNADO');
                
                
                $output['mensaje'] = '<div class="alert alert-success"><strong>Matriculas </strong> Activadas.</div>';
                $output = $crud->render();
                $this->_example_output($output);

            }catch(Exception $e){
                show_error($e->getMessage().' --- '.$e->getTraceAsString());
            }

        }        
     }
    
     public function usuarioex($ESTADO = "1")    {
        echo $this->load->view('menu');


        if (($this->session->userdata('IDROL') == 3) || ($this->session->userdata('IDROL') == 4)) {
            header ("Location: ".base_url().'metodos/matricula');
        }else{
          try{
                $this->config->set_item('grocery_crud_dialog_forms',true);
                $this->config->set_item('grocery_crud_default_per_page',20);
                $crud = new grocery_CRUD();            
//                $crud->set_theme('datatables');
                 $crud->set_theme('flexigrid');
                
                $crud->required_fields('IDESTADOUSUARIO','IDROL');
                //$crud->where('ESTADO','Inactiva');
                 $crud->display_as('IDROL','ROL');
                 $crud->display_as('IDESTADOUSUARIO','ESTADO');
                 $crud->display_as('DIRECCION','DIRECCIÓN');
                $crud->display_as('TELEFONO','TELÉFONO');   
                $crud->display_as('GRADOASIGNADO','GRADO ASIGNADO');   
                $crud->display_as('FNACIMIENTO','FECHA NACIMIENTO');   
                $crud->display_as('AREA','AREA ASIGNADA');   
                $crud->set_table('users');
                $crud->set_relation('IDROL','rol','NOMBRE');
                $crud->field_type('IDESTADOUSUARIO','dropdown', array('1' => 'ACTIVO', '2' => 'INACTIVO'));
                $crud->field_type('AUXILIAR','dropdown', array('SI' => 'SI', 'NO' => 'NO'));
                $crud->field_type('GRADOASIGNADO','dropdown', array('1' => 'Primero', '2' => 'Segundo', '3' => 'Tercero', '4' => 'Cuarto', '5' => 'Quinto', '6' => 'Sexto', '7' => 'Septimo', '8' => 'Octavo', '9' => 'Noveno', '10' => 'Decimo', '11' => 'Undecimo'));
               
                $crud->columns('IDROL','NOMBRE','APELLIDO','IDENTIFICACION','CORREO','DIRECCION','TELEFONO','CELULAR','FNACIMIENTO','GRADOASIGNADO','AUXILIAR');
                
                
                $output['mensaje'] = '<div class="alert alert-success"><strong>Matriculas </strong> Activadas.</div>';
                $output = $crud->render();
                $this->_example_output($output);

            }catch(Exception $e){
                show_error($e->getMessage().' --- '.$e->getTraceAsString());
            }

        }        
     }     
     
     public function tgs(){
                    echo $this->session->userdata('GRADO');
                  }

     public function grado($grado, $estado=1){

            echo $this->load->view('menu');
            $this->Model_global->comprobar();

            if ($this->session->userdata('IDROL') != 5) {
              try{
              $this->db->where('GRADO',$grado);
              $this->db->where('ESTADO',$estado);
              $this->db->from('hojamatricula');
              $nc = $this->db->count_all_results();
              
              
              for ($i=0; $i < 24; $i++) { 
                $i = $i + 1;
                //echo $i.' - ';
                //echo '<button>'.$i.'</button>';
                $i = $i + 4;      
              }

              //echo " <br>";
                 $query = $this->db->query('SELECT * from hojamatricula where GRADO = '.$grado.'');
                  
                  $contador = 0;
                  $temp = '';
                  $desde = 0;
                  $hasta = 0;

                  foreach ($query->result() as $row){
                     $contador = $contador +1;                     
                     
                     if ($contador == 1 || $contador == 7 || $contador == 13 || $contador == 19 || $contador == 25 || $contador == 31 || $contador == 37 || $contador == 43 || $contador == 49) {
                       $temp = $row->IDHOJAMATRICULA;
                     }

                     if ($contador == 6 || $contador == 12 || $contador == 18 || $contador == 24 || $contador == 30 || $contador == 36 || $contador == 42 || $contador == 48 || $contador == 54) {
                       $select = 'SELECT * from hojamatricula WHERE IDHOJAMATRICULA BETWEEN '.$temp.' AND '.$row->IDHOJAMATRICULA.' AND GRADO = '.$grado.'';
                       //echo '<a target="_blank" href="'.base_url().'metodos/entrefichas/'.encryptIt($select).'/'.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'" class="btn btn-danger"> <img src="https://cdn1.iconfinder.com/data/icons/glaze/16x16/mimetypes/source_f.png" > '.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'</a>  ';
                       //.$temp.' - '.$row->IDHOJAMATRICULA.
                       $hasta = $temp;
                       $desde = $row->IDHOJAMATRICULA;
                     }

                     if ($contador == $nc) {
                      //echo $hasta.' - '.$desde;
                        if ($hasta != $temp || $desde != $row->IDHOJAMATRICULA) {

                          $select = 'SELECT * from hojamatricula WHERE IDHOJAMATRICULA BETWEEN '.$temp.' AND '.$row->IDHOJAMATRICULA.' AND GRADO = '.$grado.'';
                          //echo '<a target="_blank" href="'.base_url().'metodos/entrefichas/'.encryptIt($select).'/'.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'" class="btn btn-danger"> <img src="https://cdn1.iconfinder.com/data/icons/glaze/16x16/mimetypes/source_f.png" > ' .$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'</a>  ';
                        }
                     }
                  }

                  //echo '<br>';
                  $query = $this->db->query('SELECT * from hojamatricula where GRADO = '.$grado);                  
                  $contador = 0;
                  $temp = '';

                  foreach ($query->result() as $row){
                     $contador = $contador +1;                     
                     
                     if ($contador == 1 || $contador == 7 || $contador == 13 || $contador == 19 || $contador == 25 || $contador == 31 || $contador == 37 || $contador == 43 || $contador == 49) {
                       $temp = $row->IDHOJAMATRICULA;
                     }

                     if ($contador == 6 || $contador == 12 || $contador == 18 || $contador == 24 || $contador == 30 || $contador == 36 || $contador == 42 || $contador == 48 || $contador == 54) {
                       $select = 'SELECT * from hojamatricula WHERE IDHOJAMATRICULA BETWEEN '.$temp.' AND '.$row->IDHOJAMATRICULA.' AND GRADO = '.$grado.'';
                       //echo '<a target="_blank" href="'.base_url().'metodos/entreobservador/'.encryptIt($select).'/'.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'" class="btn btn-success"> <img src="https://cdn2.iconfinder.com/data/icons/gnomeicontheme/16x16/stock/object/stock_file-with-objects.png" > '.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'</a>  ';
                     }
                     
                     if ($contador == $nc) {
                      //echo $hasta.' - '.$desde;
                        if ($hasta != $temp || $desde != $row->IDHOJAMATRICULA) {

                          $select = 'SELECT * from hojamatricula WHERE IDHOJAMATRICULA BETWEEN '.$temp.' AND '.$row->IDHOJAMATRICULA.' AND GRADO = '.$grado.'';
                          //echo '<a target="_blank" href="'.base_url().'metodos/entreobservador/'.encryptIt($select).'/'.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'" class="btn btn-success"> <img src="https://cdn2.iconfinder.com/data/icons/gnomeicontheme/16x16/stock/object/stock_file-with-objects.png" > '.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'</a>  ';
                        }
                     }
                  }

                  //echo '<br>';
                  $query = $this->db->query('SELECT * from hojamatricula where GRADO = '.$grado);                  
                  $contador = 0;
                  $temp = '';

                  foreach ($query->result() as $row){
                     $contador = $contador +1;                     
                     
                     if ($contador == 1 || $contador == 7 || $contador == 13 || $contador == 19 || $contador == 25 || $contador == 31 || $contador == 37 || $contador == 43 || $contador == 49) {
                       $temp = $row->IDHOJAMATRICULA;
                     }

                     if ($contador == 6 || $contador == 12 || $contador == 18 || $contador == 24 || $contador == 30 || $contador == 36 || $contador == 42 || $contador == 48 || $contador == 54) {
                       $select = 'SELECT * from hojamatricula WHERE IDHOJAMATRICULA BETWEEN '.$temp.' AND '.$row->IDHOJAMATRICULA.' AND GRADO = '.$grado.'';
                       //echo '<a target="_blank" href="'.base_url().'metodos/entreregistro/'.encryptIt($select).'/'.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'" class="btn btn-|"> <img src="https://cdn4.iconfinder.com/data/icons/technology-devices-1/500/magnifier-16.png" > '.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'</a>  ';
                     }

                     if ($contador == $nc) {
                      //echo $hasta.' - '.$desde;
                        if ($hasta != $temp || $desde != $row->IDHOJAMATRICULA) {

                          $select = 'SELECT * from hojamatricula WHERE IDHOJAMATRICULA BETWEEN '.$temp.' AND '.$row->IDHOJAMATRICULA.' AND GRADO = '.$grado.'';
                          //echo '<a target="_blank" href="'.base_url().'metodos/entreregistro/'.encryptIt($select).'/'.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'" class="btn btn-warning"> <img src="https://cdn4.iconfinder.com/data/icons/technology-devices-1/500/magnifier-16.png" > '.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'</a>  ';
                        }
                     }
                  }

                  

                  //echo $this->session->userdata('IDROL');
                  

                  if ($this->session->userdata('IDROL') == 5) {

                    if($this->session->userdata('GRADO') == $grado){
                        $crud = new grocery_CRUD(); 
                      $crud->set_theme('flexigrid');
                      $crud->where('GRADO',$grado);
                      $crud->set_table('hojamatricula');
                      //$crud->columns('ESTADO','NOMBRES','APELLIDOS','TARJETAIDENTIDAD','URL_IMG','GRADO','TELEFONO1');
                      $crud->display_as('NUMEROACTAMATRICULA','MATRICULA');
                      $crud->display_as('COLEGIOANTERIORINMEDIATO','COLEGIO ANTERIOR');
                      $crud->display_as('SECRETARIA_IDSECRETARIA','SECRETARIA');                
                      

                      $crud->field_type('CVACUNAS','dropdown', array('1' => 'SI', '2' => 'NO'));
                      $crud->field_type('VISOMETRIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                      $crud->field_type('SEROLOGIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                      $crud->field_type('AUDIOMETRIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                      
                      $crud->add_action('Hoja Matricula', 'https://cdn1.iconfinder.com/data/icons/glaze/16x16/mimetypes/source_f.png', 'metodos/ficha','ui-icon-plus');
                      $crud->add_action('Observador', 'https://cdn2.iconfinder.com/data/icons/gnomeicontheme/16x16/stock/object/stock_file-with-objects.png', 'metodos/observador','ui-icon-plus');
                      $crud->add_action('Registro entrevista', 'https://cdn4.iconfinder.com/data/icons/technology-devices-1/500/magnifier-16.png', 'metodos/registro','ui-icon-plus');

                      //if (($this->session->userdata('IDROL') == 3) || ($this->session->userdata('IDROL') == 4) || ($this->session->userdata('IDROL') == 5)) {
                          $crud->unset_add();
                          $crud->unset_edit();
                          $crud->unset_delete();
                      //}

                      $crud->field_type('GRADO','dropdown', array('1' => 'Primero', '2' => 'Segundo', '3' => 'Tercero', '4' => 'Cuarto', '5' => 'Quinto', '6' => 'Sexto', '7' => 'Septimo', '8' => 'Octavo', '9' => 'Noveno', '10' => 'Decimo', '11' => 'Undecimo'));

                      $crud->field_type('RH','dropdown', array('A+' => 'A+', 'B+' => 'B+', 'AB+' => 'AB+', 'O+' => 'O+', 'A-' => 'A-', 'B-' => 'B-', 'AB-' => 'AB-', 'O-' => 'O-'));
                      $crud->field_type('ESTADO','dropdown', array('1' => 'ACTIVO', '2' => 'INACTIVO'));
                      $crud->field_type('ESTADOCIVILMADRE','dropdown', array('1' => 'SOLTERO', '2' => 'CASADO','3' =>'VIUDO','4' =>'UNION LIBRE'));
                      $crud->field_type('ESTADOCIVILPADRE','dropdown', array('1' => 'SOLTERO', '2' => 'CASADO','3' =>'VIUDO','4' =>'UNION LIBRE'));

                      $crud->columns('NUMEROACTAMATRICULA','NOMBRES','APELLIDOS','FECHANACIMIENTO','TARJETAIDENTIDAD','GRADO','TELEFONO1');
                      $crud->set_field_upload('URL_IMG','assets/uploads/files');

                      
                      //$output['mensaje'] = '<div class="alert alert-success"><strong>Matriculas </strong> Activadas.</div>';
                      $output = $crud->render();
                      $this->_example_output($output);
                    }else{
                      header ("Location: ".base_url().'metodos/grado/'.$this->session->userdata('GRADO'));
                    }                                     
                  }

                  elseif ($this->session->userdata('IDROL')==1 || $this->session->userdata('IDROL')==2 || $this->session->userdata('IDROL')==3 || $this->session->userdata('IDROL')==4) {

                    $crud = new grocery_CRUD(); 
                    $crud->set_theme('flexigrid');
                    $crud->where('GRADO',$grado);
                    $crud->set_table('hojamatricula');
                    //$crud->columns('ESTADO','NOMBRES','APELLIDOS','TARJETAIDENTIDAD','URL_IMG','GRADO','TELEFONO1');
                    $crud->display_as('NUMEROACTAMATRICULA','MATRICULA');
                    $crud->display_as('COLEGIOANTERIORINMEDIATO','COLEGIO ANTERIOR');
                    $crud->display_as('SECRETARIA_IDSECRETARIA','SECRETARIA');                

                    $crud->field_type('CVACUNAS','dropdown', array('1' => 'SI', '2' => 'NO'));
                    $crud->field_type('VISOMETRIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                    $crud->field_type('SEROLOGIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                    $crud->field_type('AUDIOMETRIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                    
                    $crud->add_action('Hoja Matricula', 'https://cdn1.iconfinder.com/data/icons/glaze/16x16/mimetypes/source_f.png', 'metodos/ficha','ui-icon-plus');
                    $crud->add_action('Observador', 'https://cdn2.iconfinder.com/data/icons/gnomeicontheme/16x16/stock/object/stock_file-with-objects.png', 'metodos/observador','ui-icon-plus');
                    $crud->add_action('Registro entrevista', 'https://cdn4.iconfinder.com/data/icons/technology-devices-1/500/magnifier-16.png', 'metodos/registro','ui-icon-plus');

                    //if (($this->session->userdata('IDROL') == 3) || ($this->session->userdata('IDROL') == 4) || ($this->session->userdata('IDROL') == 5)) {
                        $crud->unset_add();
                        $crud->unset_edit();
                        $crud->unset_delete();
                    //}

                    $crud->field_type('GRADO','dropdown', array('1' => 'Primero', '2' => 'Segundo', '3' => 'Tercero', '4' => 'Cuarto', '5' => 'Quinto', '6' => 'Sexto', '7' => 'Septimo', '8' => 'Octavo', '9' => 'Noveno', '10' => 'Decimo', '11' => 'Undecimo'));

                    $crud->field_type('RH','dropdown', array('A+' => 'A+', 'B+' => 'B+', 'AB+' => 'AB+', 'O+' => 'O+', 'A-' => 'A-', 'B-' => 'B-', 'AB-' => 'AB-', 'O-' => 'O-'));
                    $crud->field_type('ESTADO','dropdown', array('1' => 'ACTIVO', '2' => 'INACTIVO'));
                    $crud->field_type('ESTADOCIVILMADRE','dropdown', array('1' => 'SOLTERO', '2' => 'CASADO','3' =>'VIUDO','4' =>'UNION LIBRE'));
                    $crud->field_type('ESTADOCIVILPADRE','dropdown', array('1' => 'SOLTERO', '2' => 'CASADO','3' =>'VIUDO','4' =>'UNION LIBRE'));

                    $crud->columns('NUMEROACTAMATRICULA','NOMBRES','APELLIDOS','FECHANACIMIENTO','TARJETAIDENTIDAD','GRADO','TELEFONO1');
                      $crud->set_field_upload('URL_IMG','assets/uploads/files');

                    
                    //$output['mensaje'] = '<div class="alert alert-success"><strong>Matriculas </strong> Activadas.</div>';
                    $output = $crud->render();
                    $this->_example_output($output);

                  }

            }catch(Exception $e){
                show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
      }
        if ($this->session->userdata('IDROL')==5) {
          
              try{
              $this->db->where('GRADO',$grado);
              $this->db->where('ESTADO',$estado = 1);
              $this->db->from('hojamatricula');
              $nc = $this->db->count_all_results();
              //echo ' TOTAL '.$nc.'<br>';

              for ($i=0; $i < 24; $i++) { 
                $i = $i + 1;
                //echo $i.' - ';
                //echo '<button>'.$i.'</button>';
                $i = $i + 4;      
              }

              //echo " <br>";
                 $query = $this->db->query('SELECT * from hojamatricula where GRADO = '.$grado.' and estado ='.$estado.'');
                  
                  $contador = 0;
                  $temp = '';
                  $desde = 0;
                  $hasta = 0;

                  foreach ($query->result() as $row){
                     $contador = $contador +1;                     
                     
                     if ($contador == 1 || $contador == 7 || $contador == 13 || $contador == 19 || $contador == 25 || $contador == 31 || $contador == 37 || $contador == 43 || $contador == 49) {
                       $temp = $row->IDHOJAMATRICULA;
                     }

                     if ($contador == 6 || $contador == 12 || $contador == 18 || $contador == 24 || $contador == 30 || $contador == 36 || $contador == 42 || $contador == 48 || $contador == 54) {
                       $select = 'SELECT * from hojamatricula WHERE IDHOJAMATRICULA BETWEEN '.$temp.' AND '.$row->IDHOJAMATRICULA.' AND GRADO = '.$grado.' and estado = 1'.'';
                       //echo '<a target="_blank" href="'.base_url().'metodos/entrefichas/'.encryptIt($select).'/'.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'" class="btn btn-danger"> <img src="https://cdn1.iconfinder.com/data/icons/glaze/16x16/mimetypes/source_f.png" > '.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'</a>  ';
                       //.$temp.' - '.$row->IDHOJAMATRICULA.
                       $hasta = $temp;
                       $desde = $row->IDHOJAMATRICULA;
                     }

                     if ($contador == $nc) {
                      //echo $hasta.' - '.$desde;
                        if ($hasta != $temp || $desde != $row->IDHOJAMATRICULA) {

                          $select = 'SELECT * from hojamatricula WHERE IDHOJAMATRICULA BETWEEN '.$temp.' AND '.$row->IDHOJAMATRICULA.' AND GRADO = '.$grado.' and estado = 1'.'';
                          //echo '<a target="_blank" href="'.base_url().'metodos/entrefichas/'.encryptIt($select).'/'.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'" class="btn btn-danger"> <img src="https://cdn1.iconfinder.com/data/icons/glaze/16x16/mimetypes/source_f.png" > ' .$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'</a>  ';
                        }
                     }
                  }

                  //echo '<br>';
                  $query = $this->db->query('SELECT * from hojamatricula where GRADO = '.$grado.' and estado = 1');                  
                  $contador = 0;
                  $temp = '';

                  foreach ($query->result() as $row){
                     $contador = $contador +1;                     
                     
                     if ($contador == 1 || $contador == 7 || $contador == 13 || $contador == 19 || $contador == 25 || $contador == 31 || $contador == 37 || $contador == 43 || $contador == 49) {
                       $temp = $row->IDHOJAMATRICULA;
                     }

                     if ($contador == 6 || $contador == 12 || $contador == 18 || $contador == 24 || $contador == 30 || $contador == 36 || $contador == 42 || $contador == 48 || $contador == 54) {
                       $select = 'SELECT * from hojamatricula WHERE IDHOJAMATRICULA BETWEEN '.$temp.' AND '.$row->IDHOJAMATRICULA.' AND GRADO = '.$grado.' and estado = 1'.'';
                       //echo '<a target="_blank" href="'.base_url().'metodos/entreobservador/'.encryptIt($select).'/'.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'" class="btn btn-success"> <img src="https://cdn2.iconfinder.com/data/icons/gnomeicontheme/16x16/stock/object/stock_file-with-objects.png" > '.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'</a>  ';
                     }
                     
                     if ($contador == $nc) {
                      //echo $hasta.' - '.$desde;
                        if ($hasta != $temp || $desde != $row->IDHOJAMATRICULA) {

                          $select = 'SELECT * from hojamatricula WHERE IDHOJAMATRICULA BETWEEN '.$temp.' AND '.$row->IDHOJAMATRICULA.' AND GRADO = '.$grado.' and estado = 1'.'';
                          //echo '<a target="_blank" href="'.base_url().'metodos/entreobservador/'.encryptIt($select).'/'.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'" class="btn btn-success"> <img src="https://cdn2.iconfinder.com/data/icons/gnomeicontheme/16x16/stock/object/stock_file-with-objects.png" > '.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'</a>  ';
                        }
                     }
                  }

                  //echo '<br>';
                  $query = $this->db->query('SELECT * from hojamatricula where GRADO = '.$grado.' and estado = 1');                  
                  $contador = 0;
                  $temp = '';

                  foreach ($query->result() as $row){
                     $contador = $contador +1;                     
                     
                     if ($contador == 1 || $contador == 7 || $contador == 13 || $contador == 19 || $contador == 25 || $contador == 31 || $contador == 37 || $contador == 43 || $contador == 49) {
                       $temp = $row->IDHOJAMATRICULA;
                     }

                     if ($contador == 6 || $contador == 12 || $contador == 18 || $contador == 24 || $contador == 30 || $contador == 36 || $contador == 42 || $contador == 48 || $contador == 54) {
                       $select = 'SELECT * from hojamatricula WHERE IDHOJAMATRICULA BETWEEN '.$temp.' AND '.$row->IDHOJAMATRICULA.' AND GRADO = '.$grado.' and estado = 1'.'';
                       //echo '<a target="_blank" href="'.base_url().'metodos/entreregistro/'.encryptIt($select).'/'.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'" class="btn btn-|"> <img src="https://cdn4.iconfinder.com/data/icons/technology-devices-1/500/magnifier-16.png" > '.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'</a>  ';
                     }

                     if ($contador == $nc) {
                      //echo $hasta.' - '.$desde;
                        if ($hasta != $temp || $desde != $row->IDHOJAMATRICULA) {

                          $select = 'SELECT * from hojamatricula WHERE IDHOJAMATRICULA BETWEEN '.$temp.' AND '.$row->IDHOJAMATRICULA.' AND GRADO = '.$grado.' and estado = 1'.'';
                          //echo '<a target="_blank" href="'.base_url().'metodos/entreregistro/'.encryptIt($select).'/'.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'" class="btn btn-warning"> <img src="https://cdn4.iconfinder.com/data/icons/technology-devices-1/500/magnifier-16.png" > '.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'</a>  ';
                        }
                     }
                  }

                  //echo $this->session->userdata('IDROL');

                  if ($this->session->userdata('IDROL')==5) {

                    if($this->session->userdata('GRADO') == $grado){
                        $crud = new grocery_CRUD(); 
                      $crud->set_theme('flexigrid');
                      $crud->where('GRADO',$grado);
                      $crud->where('ESTADO',$estado = 1);
                      $crud->set_table('hojamatricula');
                      //$crud->columns('ESTADO','NOMBRES','APELLIDOS','TARJETAIDENTIDAD','URL_IMG','GRADO','TELEFONO1');
                      $crud->display_as('NUMEROACTAMATRICULA','MATRICULA');
                      $crud->display_as('COLEGIOANTERIORINMEDIATO','COLEGIO ANTERIOR');
                      $crud->display_as('SECRETARIA_IDSECRETARIA','SECRETARIA');                
                      

                      $crud->field_type('CVACUNAS','dropdown', array('1' => 'SI', '2' => 'NO'));
                      $crud->field_type('VISOMETRIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                      $crud->field_type('SEROLOGIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                      $crud->field_type('AUDIOMETRIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                      
                      $crud->add_action('Hoja Matricula', 'https://cdn1.iconfinder.com/data/icons/glaze/16x16/mimetypes/source_f.png', 'metodos/ficha','ui-icon-plus');
                      $crud->add_action('Observador', 'https://cdn2.iconfinder.com/data/icons/gnomeicontheme/16x16/stock/object/stock_file-with-objects.png', 'metodos/observador','ui-icon-plus');
                      $crud->add_action('Registro entrevista', 'https://cdn4.iconfinder.com/data/icons/technology-devices-1/500/magnifier-16.png', 'metodos/registro','ui-icon-plus');

                      //if (($this->session->userdata('IDROL') == 3) || ($this->session->userdata('IDROL') == 4) || ($this->session->userdata('IDROL') == 5)) {
                          $crud->unset_add();
                          $crud->unset_edit();
                          $crud->unset_delete();
                      //}

                      $crud->field_type('GRADO','dropdown', array('1' => 'Primero', '2' => 'Segundo', '3' => 'Tercero', '4' => 'Cuarto', '5' => 'Quinto', '6' => 'Sexto', '7' => 'Septimo', '8' => 'Octavo', '9' => 'Noveno', '10' => 'Decimo', '11' => 'Undecimo'));

                      $crud->field_type('RH','dropdown', array('A+' => 'A+', 'B+' => 'B+', 'AB+' => 'AB+', 'O+' => 'O+', 'A-' => 'A-', 'B-' => 'B-', 'AB-' => 'AB-', 'O-' => 'O-'));
                      $crud->field_type('ESTADO','dropdown', array('1' => 'ACTIVO', '2' => 'INACTIVO'));
                      $crud->field_type('ESTADOCIVILMADRE','dropdown', array('1' => 'SOLTERO', '2' => 'CASADO','3' =>'VIUDO','4' =>'UNION LIBRE'));
                      $crud->field_type('ESTADOCIVILPADRE','dropdown', array('1' => 'SOLTERO', '2' => 'CASADO','3' =>'VIUDO','4' =>'UNION LIBRE'));

                      $crud->columns('NUMEROACTAMATRICULA','NOMBRES','APELLIDOS','FECHANACIMIENTO','TARJETAIDENTIDAD','GRADO','TELEFONO1');
                      $crud->set_field_upload('URL_IMG','assets/uploads/files');

                      
                      //$output['mensaje'] = '<div class="alert alert-success"><strong>Matriculas </strong> Activadas.</div>';
                      $output = $crud->render();
                      $this->_example_output($output);
                    }else{
                      header ("Location: ".base_url().'metodos/grado/'.$this->session->userdata('GRADO'));
                    }                                     
                  }

                  elseif ($this->session->userdata('IDROL')==1 || $this->session->userdata('IDROL')==2) {

                    $crud = new grocery_CRUD(); 
                    $crud->set_theme('flexigrid');
                    $crud->where('GRADO',$grado);
                    $crud->set_table('hojamatricula');
                    //$crud->columns('ESTADO','NOMBRES','APELLIDOS','TARJETAIDENTIDAD','URL_IMG','GRADO','TELEFONO1');
                    $crud->display_as('NUMEROACTAMATRICULA','MATRICULA');
                    $crud->display_as('COLEGIOANTERIORINMEDIATO','COLEGIO ANTERIOR');
                    $crud->display_as('SECRETARIA_IDSECRETARIA','SECRETARIA');                

                    $crud->field_type('CVACUNAS','dropdown', array('1' => 'SI', '2' => 'NO'));
                    $crud->field_type('VISOMETRIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                    $crud->field_type('SEROLOGIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                    $crud->field_type('AUDIOMETRIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                    
                    $crud->add_action('Hoja Matricula', 'https://cdn1.iconfinder.com/data/icons/glaze/16x16/mimetypes/source_f.png', 'metodos/ficha','ui-icon-plus');
                    $crud->add_action('Observador', 'https://cdn2.iconfinder.com/data/icons/gnomeicontheme/16x16/stock/object/stock_file-with-objects.png', 'metodos/observador','ui-icon-plus');
                    $crud->add_action('Registro entrevista', 'https://cdn4.iconfinder.com/data/icons/technology-devices-1/500/magnifier-16.png', 'metodos/registro','ui-icon-plus');

                    //if (($this->session->userdata('IDROL') == 3) || ($this->session->userdata('IDROL') == 4) || ($this->session->userdata('IDROL') == 5)) {
                        $crud->unset_add();
                        $crud->unset_edit();
                        $crud->unset_delete();
                    //}

                    $crud->field_type('GRADO','dropdown', array('1' => 'Primero', '2' => 'Segundo', '3' => 'Tercero', '4' => 'Cuarto', '5' => 'Quinto', '6' => 'Sexto', '7' => 'Septimo', '8' => 'Octavo', '9' => 'Noveno', '10' => 'Decimo', '11' => 'Undecimo'));

                    $crud->field_type('RH','dropdown', array('A+' => 'A+', 'B+' => 'B+', 'AB+' => 'AB+', 'O+' => 'O+', 'A-' => 'A-', 'B-' => 'B-', 'AB-' => 'AB-', 'O-' => 'O-'));
                    $crud->field_type('ESTADO','dropdown', array('1' => 'ACTIVO', '2' => 'INACTIVO'));
                    $crud->field_type('ESTADOCIVILMADRE','dropdown', array('1' => 'SOLTERO', '2' => 'CASADO','3' =>'VIUDO','4' =>'UNION LIBRE'));
                    $crud->field_type('ESTADOCIVILPADRE','dropdown', array('1' => 'SOLTERO', '2' => 'CASADO','3' =>'VIUDO','4' =>'UNION LIBRE'));

                    $crud->columns('NUMEROACTAMATRICULA','NOMBRES','APELLIDOS','FECHANACIMIENTO','TARJETAIDENTIDAD','GRADO','TELEFONO1');
                       $crud->set_field_upload('URL_IMG','assets/uploads/files');

                    
                    //$output['mensaje'] = '<div class="alert alert-success"><strong>Matriculas </strong> Activadas.</div>';
                    $output = $crud->render();
                    $this->_example_output($output);

                  }

                

            }catch(Exception $e){
                show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
            }

            
    }

     public function gradot($grado){

            //echo $this->load->view('menu');
            $data['contenido'] = '';
            $this->Model_global->comprobar();

            if ($this->session->userdata('IDROL') != 5) {
              try{
              $this->db->where('GRADO',$grado);
              $this->db->from('hojamatricula');
              $nc = $this->db->count_all_results();
              //echo ' TOTAL '.$nc.'<br>';

              for ($i=0; $i < 24; $i++) { 
                $i = $i + 1;
                //echo $i.' - ';
                //echo '<button>'.$i.'</button>';
                $i = $i + 4;      
              }

              $data['contenido'] .= " <br>";
                 $query = $this->db->query('SELECT * from hojamatricula where GRADO = '.$grado);
                  
                  $contador = 0;
                  $temp = '';
                  $desde = 0;
                  $hasta = 0;

                  foreach ($query->result() as $row){
                     $contador = $contador +1;                     
                     
                     if ($contador == 1 || $contador == 7 || $contador == 13 || $contador == 19 || $contador == 25 || $contador == 31 || $contador == 37 || $contador == 43 || $contador == 49) {
                       $temp = $row->IDHOJAMATRICULA;
                     }

                     if ($contador == 6 || $contador == 12 || $contador == 18 || $contador == 24 || $contador == 30 || $contador == 36 || $contador == 42 || $contador == 48 || $contador == 54) {
                       $select = 'SELECT * from hojamatricula WHERE IDHOJAMATRICULA BETWEEN '.$temp.' AND '.$row->IDHOJAMATRICULA.' AND GRADO = '.$grado.' and estado=1'.'';
                       $data['contenido'] .= '<a target="_blank" href="'.base_url().'metodos/entrefichas/'.encryptIt($select).'/'.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'" class="btn btn-danger"> <img src="https://cdn1.iconfinder.com/data/icons/glaze/16x16/mimetypes/source_f.png" > H. Matricula '.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'</a>  ';
                       //.$temp.' - '.$row->IDHOJAMATRICULA.
                       $hasta = $temp;
                       $desde = $row->IDHOJAMATRICULA;
                     }

                     if ($contador == $nc) {
                      //echo $hasta.' - '.$desde;
                        if ($hasta != $temp || $desde != $row->IDHOJAMATRICULA) {

                          $select = 'SELECT * from hojamatricula WHERE IDHOJAMATRICULA BETWEEN '.$temp.' AND '.$row->IDHOJAMATRICULA.' AND GRADO = '.$grado.' and estado=1'.'';
                          $data['contenido'] .= '<a target="_blank" href="'.base_url().'metodos/entrefichas/'.encryptIt($select).'/'.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'" class="btn btn-danger"> <img src="https://cdn1.iconfinder.com/data/icons/glaze/16x16/mimetypes/source_f.png" > H. Matricula ' .$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'</a>  ';
                        }
                     }
                  }

                  $data['contenido'] .= '<br>';
                  $query = $this->db->query('SELECT * from hojamatricula where GRADO = '.$grado);                  
                  $contador = 0;
                  $temp = '';

                  foreach ($query->result() as $row){
                     $contador = $contador +1;                     
                     
                     if ($contador == 1 || $contador == 7 || $contador == 13 || $contador == 19 || $contador == 25 || $contador == 31 || $contador == 37 || $contador == 43 || $contador == 49) {
                       $temp = $row->IDHOJAMATRICULA;
                     }

                     if ($contador == 6 || $contador == 12 || $contador == 18 || $contador == 24 || $contador == 30 || $contador == 36 || $contador == 42 || $contador == 48 || $contador == 54) {
                       $select = 'SELECT * from hojamatricula WHERE IDHOJAMATRICULA BETWEEN '.$temp.' AND '.$row->IDHOJAMATRICULA.' AND GRADO = '.$grado.' and estado=1'.'';
                       $data['contenido'] .= '<a target="_blank" href="'.base_url().'metodos/entreobservador/'.encryptIt($select).'/'.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'" class="btn btn-success"> <img src="https://cdn2.iconfinder.com/data/icons/gnomeicontheme/16x16/stock/object/stock_file-with-objects.png" > Observador '.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'</a>  ';
                     }
                     
                     if ($contador == $nc) {
                      //echo $hasta.' - '.$desde;
                        if ($hasta != $temp || $desde != $row->IDHOJAMATRICULA) {

                          $select = 'SELECT * from hojamatricula WHERE IDHOJAMATRICULA BETWEEN '.$temp.' AND '.$row->IDHOJAMATRICULA.' AND GRADO = '.$grado.' and estado=1'.'';
                          $data['contenido'] .= '<a target="_blank" href="'.base_url().'metodos/entreobservador/'.encryptIt($select).'/'.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'" class="btn btn-success"> <img src="https://cdn2.iconfinder.com/data/icons/gnomeicontheme/16x16/stock/object/stock_file-with-objects.png" > Observador '.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'</a>  ';
                        }
                     }
                  }

                  $data['contenido'] .= '<br>';
                  $query = $this->db->query('SELECT * from hojamatricula where GRADO = '.$grado);                  
                  $contador = 0;
                  $temp = '';

                  foreach ($query->result() as $row){
                     $contador = $contador +1;                     
                     
                     if ($contador == 1 || $contador == 7 || $contador == 13 || $contador == 19 || $contador == 25 || $contador == 31 || $contador == 37 || $contador == 43 || $contador == 49) {
                       $temp = $row->IDHOJAMATRICULA;
                     }

                     if ($contador == 6 || $contador == 12 || $contador == 18 || $contador == 24 || $contador == 30 || $contador == 36 || $contador == 42 || $contador == 48 || $contador == 54) {
                       $select = 'SELECT * from hojamatricula WHERE IDHOJAMATRICULA BETWEEN '.$temp.' AND '.$row->IDHOJAMATRICULA.' AND GRADO = '.$grado.' and estado=1'.'';
                       $data['contenido'] .= '<a target="_blank" href="'.base_url().'metodos/entreregistro/'.encryptIt($select).'/'.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'" class="btn btn-warning"> <img src="https://cdn4.iconfinder.com/data/icons/technology-devices-1/500/magnifier-16.png" > Entrevistas. '.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'</a>  ';
                     }

                     if ($contador == $nc) {
                      //echo $hasta.' - '.$desde;
                        if ($hasta != $temp || $desde != $row->IDHOJAMATRICULA) {

                          $select = 'SELECT * from hojamatricula WHERE IDHOJAMATRICULA BETWEEN '.$temp.' AND '.$row->IDHOJAMATRICULA.' AND GRADO = '.$grado.' and estado=1'.'';
                          $data['contenido'] .= '<a target="_blank" href="'.base_url().'metodos/entreregistro/'.encryptIt($select).'/'.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'" class="btn btn-warning"> <img src="https://cdn4.iconfinder.com/data/icons/technology-devices-1/500/magnifier-16.png" > Entrevistas. '.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'</a>  ';
                        }
                     }
                  }

                  

                  //echo $this->session->userdata('IDROL');
                  

                  if ($this->session->userdata('IDROL') == 5) {

                    if($this->session->userdata('GRADO') == $grado){
                        $data['contenido'] .= "<h2>Grado: ".$grado.'</h2>';
                    }else{
                      header ("Location: ".base_url().'metodos/grado/'.$this->session->userdata('GRADO'));
                    }                                     
                  }

                  elseif ($this->session->userdata('IDROL')==1 || $this->session->userdata('IDROL')==2) {

                    $data['contenido'] .= "<h2>Grado: ".$grado.'</h2>';
                  }

            }catch(Exception $e){
                show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
      }
        if ($this->session->userdata('IDROL')==5) {
          
              try{
              $this->db->where('GRADO',$grado);
              $this->db->from('hojamatricula');
              $nc = $this->db->count_all_results();
              //echo ' TOTAL '.$nc.'<br>';

              for ($i=0; $i < 24; $i++) { 
                $i = $i + 1;
                //echo $i.' - ';
                //echo '<button>'.$i.'</button>';
                $i = $i + 4;      
              }

              //echo " <br>";
                 $query = $this->db->query('SELECT * from hojamatricula where GRADO = '.$grado);
                  
                  $contador = 0;
                  $temp = '';
                  $desde = 0;
                  $hasta = 0;

                  foreach ($query->result() as $row){
                     $contador = $contador +1;                     
                     
                     if ($contador == 1 || $contador == 7 || $contador == 13 || $contador == 19 || $contador == 25 || $contador == 31 || $contador == 37 || $contador == 43 || $contador == 49) {
                       $temp = $row->IDHOJAMATRICULA;
                     }

                     if ($contador == 6 || $contador == 12 || $contador == 18 || $contador == 24 || $contador == 30 || $contador == 36 || $contador == 42 || $contador == 48 || $contador == 54) {
                       $select = 'SELECT * from hojamatricula WHERE IDHOJAMATRICULA BETWEEN '.$temp.' AND '.$row->IDHOJAMATRICULA.' AND GRADO = '.$grado.' and estado = 1'.'';
                       //echo '<a target="_blank" href="'.base_url().'metodos/entrefichas/'.encryptIt($select).'/'.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'" class="btn btn-danger"> <img src="https://cdn1.iconfinder.com/data/icons/glaze/16x16/mimetypes/source_f.png" > '.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'</a>  ';
                       //.$temp.' - '.$row->IDHOJAMATRICULA.
                       $hasta = $temp;
                       $desde = $row->IDHOJAMATRICULA;
                     }

                     if ($contador == $nc) {
                      //echo $hasta.' - '.$desde;
                        if ($hasta != $temp || $desde != $row->IDHOJAMATRICULA) {

                          $select = 'SELECT * from hojamatricula WHERE IDHOJAMATRICULA BETWEEN '.$temp.' AND '.$row->IDHOJAMATRICULA.' AND GRADO = '.$grado.' and estado= 1'.'';
                          //echo '<a target="_blank" href="'.base_url().'metodos/entrefichas/'.encryptIt($select).'/'.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'" class="btn btn-danger"> <img src="https://cdn1.iconfinder.com/data/icons/glaze/16x16/mimetypes/source_f.png" > ' .$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'</a>  ';
                        }
                     }
                  }

                  //echo '<br>';
                  $query = $this->db->query('SELECT * from hojamatricula where GRADO = '.$grado);                  
                  $contador = 0;
                  $temp = '';

                  foreach ($query->result() as $row){
                     $contador = $contador +1;                     
                     
                     if ($contador == 1 || $contador == 7 || $contador == 13 || $contador == 19 || $contador == 25 || $contador == 31 || $contador == 37 || $contador == 43 || $contador == 49) {
                       $temp = $row->IDHOJAMATRICULA;
                     }

                     if ($contador == 6 || $contador == 12 || $contador == 18 || $contador == 24 || $contador == 30 || $contador == 36 || $contador == 42 || $contador == 48 || $contador == 54) {
                       $select = 'SELECT * from hojamatricula WHERE IDHOJAMATRICULA BETWEEN '.$temp.' AND '.$row->IDHOJAMATRICULA.' AND GRADO = '.$grado.' and estado = 1'.'';
                       //echo '<a target="_blank" href="'.base_url().'metodos/entreobservador/'.encryptIt($select).'/'.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'" class="btn btn-success"> <img src="https://cdn2.iconfinder.com/data/icons/gnomeicontheme/16x16/stock/object/stock_file-with-objects.png" > '.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'</a>  ';
                     }
                     
                     if ($contador == $nc) {
                      //echo $hasta.' - '.$desde;
                        if ($hasta != $temp || $desde != $row->IDHOJAMATRICULA) {

                          $select = 'SELECT * from hojamatricula WHERE IDHOJAMATRICULA BETWEEN '.$temp.' AND '.$row->IDHOJAMATRICULA.' AND GRADO = '.$grado.' and estado = 1'.'';
                          //echo '<a target="_blank" href="'.base_url().'metodos/entreobservador/'.encryptIt($select).'/'.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'" class="btn btn-success"> <img src="https://cdn2.iconfinder.com/data/icons/gnomeicontheme/16x16/stock/object/stock_file-with-objects.png" > '.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'</a>  ';
                        }
                     }
                  }

                  //echo '<br>';
                  $query = $this->db->query('SELECT * from hojamatricula where GRADO = '.$grado);                  
                  $contador = 0;
                  $temp = '';

                  foreach ($query->result() as $row){
                     $contador = $contador +1;                     
                     
                     if ($contador == 1 || $contador == 7 || $contador == 13 || $contador == 19 || $contador == 25 || $contador == 31 || $contador == 37 || $contador == 43 || $contador == 49) {
                       $temp = $row->IDHOJAMATRICULA;
                     }

                     if ($contador == 6 || $contador == 12 || $contador == 18 || $contador == 24 || $contador == 30 || $contador == 36 || $contador == 42 || $contador == 48 || $contador == 54) {
                       $select = 'SELECT * from hojamatricula WHERE IDHOJAMATRICULA BETWEEN '.$temp.' AND '.$row->IDHOJAMATRICULA.' AND GRADO = '.$grado.' and estado = 1'.'';
                       //echo '<a target="_blank" href="'.base_url().'metodos/entreregistro/'.encryptIt($select).'/'.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'" class="btn btn-|"> <img src="https://cdn4.iconfinder.com/data/icons/technology-devices-1/500/magnifier-16.png" > '.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'</a>  ';
                     }

                     if ($contador == $nc) {
                      //echo $hasta.' - '.$desde;
                        if ($hasta != $temp || $desde != $row->IDHOJAMATRICULA) {

                          $select = 'SELECT * from hojamatricula WHERE IDHOJAMATRICULA BETWEEN '.$temp.' AND '.$row->IDHOJAMATRICULA.' AND GRADO = '.$grado.' and estado = 1'.'';
                          //echo '<a target="_blank" href="'.base_url().'metodos/entreregistro/'.encryptIt($select).'/'.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'" class="btn btn-warning"> <img src="https://cdn4.iconfinder.com/data/icons/technology-devices-1/500/magnifier-16.png" > '.$temp.' - '.$row->IDHOJAMATRICULA.' - '.$contador.'</a>  ';
                        }
                     }
                  }

                  //echo $this->session->userdata('IDROL');

                  if ($this->session->userdata('IDROL')==5) {

                    if($this->session->userdata('GRADO') == $grado){
                        $crud = new grocery_CRUD(); 
                      $crud->set_theme('flexigrid');
                      $crud->where('GRADO',$grado);
                      $crud->set_table('hojamatricula');
                      //$crud->columns('ESTADO','NOMBRES','APELLIDOS','TARJETAIDENTIDAD','URL_IMG','GRADO','TELEFONO1');
                      $crud->display_as('NUMEROACTAMATRICULA','MATRICULA');
                      $crud->display_as('COLEGIOANTERIORINMEDIATO','COLEGIO ANTERIOR');
                      $crud->display_as('SECRETARIA_IDSECRETARIA','SECRETARIA');                
                      

                      $crud->field_type('CVACUNAS','dropdown', array('1' => 'SI', '2' => 'NO'));
                      $crud->field_type('VISOMETRIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                      $crud->field_type('SEROLOGIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                      $crud->field_type('AUDIOMETRIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                      
                      $crud->add_action('Hoja Matricula', 'https://cdn1.iconfinder.com/data/icons/glaze/16x16/mimetypes/source_f.png', 'metodos/ficha','ui-icon-plus');
                      $crud->add_action('Observador', 'https://cdn2.iconfinder.com/data/icons/gnomeicontheme/16x16/stock/object/stock_file-with-objects.png', 'metodos/observador','ui-icon-plus');
                      $crud->add_action('Registro entrevista', 'https://cdn4.iconfinder.com/data/icons/technology-devices-1/500/magnifier-16.png', 'metodos/registro','ui-icon-plus');

                      //if (($this->session->userdata('IDROL') == 3) || ($this->session->userdata('IDROL') == 4) || ($this->session->userdata('IDROL') == 5)) {
                          $crud->unset_add();
                          $crud->unset_edit();
                          $crud->unset_delete();
                      //}

                      $crud->field_type('GRADO','dropdown', array('1' => 'Primero', '2' => 'Segundo', '3' => 'Tercero', '4' => 'Cuarto', '5' => 'Quinto', '6' => 'Sexto', '7' => 'Septimo', '8' => 'Octavo', '9' => 'Noveno', '10' => 'Decimo', '11' => 'Undecimo'));

                      $crud->field_type('RH','dropdown', array('1' => 'A+', '2' => 'B+', '3' => 'AB+', '4' => 'O+', '5' => 'A-', '6' => 'B-', '7' => 'AB-', '8' => 'O-'));
                      $crud->field_type('ESTADO','dropdown', array('1' => 'ACTIVO', '2' => 'INACTIVO'));
                      $crud->field_type('ESTADOCIVILMADRE','dropdown', array('1' => 'SOLTERO', '2' => 'CASADO','3' =>'VIUDO','4' =>'UNION LIBRE'));
                      $crud->field_type('ESTADOCIVILPADRE','dropdown', array('1' => 'SOLTERO', '2' => 'CASADO','3' =>'VIUDO','4' =>'UNION LIBRE'));

                      $crud->columns('NUMEROACTAMATRICULA','NOMBRES','APELLIDOS','TARJETAIDENTIDAD','GRADO','TELEFONO1');
                      $crud->set_field_upload('URL_IMG','assets/uploads/files');

                      
                      //$output['mensaje'] = '<div class="alert alert-success"><strong>Matriculas </strong> Activadas.</div>';
                      $output = $crud->render();
                      $this->_example_output($output);
                    }else{
                      header ("Location: ".base_url().'metodos/grado/'.$this->session->userdata('GRADO'));
                    }                                     
                  }

                  elseif ($this->session->userdata('IDROL')==1 || $this->session->userdata('IDROL')==2) {

                    $crud = new grocery_CRUD(); 
                    $crud->set_theme('flexigrid');
                    $crud->where('GRADO',$grado);
                    $crud->set_table('hojamatricula');
                    //$crud->columns('ESTADO','NOMBRES','APELLIDOS','TARJETAIDENTIDAD','URL_IMG','GRADO','TELEFONO1');
                    $crud->display_as('NUMEROACTAMATRICULA','MATRICULA');
                    $crud->display_as('COLEGIOANTERIORINMEDIATO','COLEGIO ANTERIOR');
                    $crud->display_as('SECRETARIA_IDSECRETARIA','SECRETARIA');                

                    $crud->field_type('CVACUNAS','dropdown', array('1' => 'SI', '2' => 'NO'));
                    $crud->field_type('VISOMETRIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                    $crud->field_type('SEROLOGIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                    $crud->field_type('AUDIOMETRIA','dropdown', array('1' => 'SI', '2' => 'NO'));
                    
                    $crud->add_action('Hoja Matricula', 'https://cdn1.iconfinder.com/data/icons/glaze/16x16/mimetypes/source_f.png', 'metodos/ficha','ui-icon-plus');
                    $crud->add_action('Observador', 'https://cdn2.iconfinder.com/data/icons/gnomeicontheme/16x16/stock/object/stock_file-with-objects.png', 'metodos/observador','ui-icon-plus');
                    $crud->add_action('Registro entrevista', 'https://cdn4.iconfinder.com/data/icons/technology-devices-1/500/magnifier-16.png', 'metodos/registro','ui-icon-plus');

                    //if (($this->session->userdata('IDROL') == 3) || ($this->session->userdata('IDROL') == 4) || ($this->session->userdata('IDROL') == 5)) {
                        $crud->unset_add();
                        $crud->unset_edit();
                        $crud->unset_delete();
                    //}

                    $crud->field_type('GRADO','dropdown', array('1' => 'Primero', '2' => 'Segundo', '3' => 'Tercero', '4' => 'Cuarto', '5' => 'Quinto', '6' => 'Sexto', '7' => 'Septimo', '8' => 'Octavo', '9' => 'Noveno', '10' => 'Decimo', '11' => 'Undecimo'));

                    $crud->field_type('RH','dropdown', array('1' => 'A+', '2' => 'B+', '3' => 'AB+', '4' => 'O+', '5' => 'A-', '6' => 'B-', '7' => 'AB-', '8' => 'O-'));
                    $crud->field_type('ESTADO','dropdown', array('1' => 'ACTIVO', '2' => 'INACTIVO'));
                    $crud->field_type('ESTADOCIVILMADRE','dropdown', array('1' => 'SOLTERO', '2' => 'CASADO','3' =>'VIUDO','4' =>'UNION LIBRE'));
                    $crud->field_type('ESTADOCIVILPADRE','dropdown', array('1' => 'SOLTERO', '2' => 'CASADO','3' =>'VIUDO','4' =>'UNION LIBRE'));

                    $crud->columns('NUMEROACTAMATRICULA','NOMBRES','APELLIDOS','TARJETAIDENTIDAD','GRADO','TELEFONO1');
                    $crud->set_field_upload('URL_IMG','assets/uploads/files');

                    
                    //$output['mensaje'] = '<div class="alert alert-success"><strong>Matriculas </strong> Activadas.</div>';
                    $output = $crud->render();
                    $this->_example_output($output);

                  }
                  $data['contenido'] = "asdasdasd";
                  $data['contenidosda'] = "asdasdasd";
                  

            }catch(Exception $e){
                show_error($e->getMessage().' --- '.$e->getTraceAsString());
        }
            }

            $this->load->view('menu',$data);
    }
    
    public function directorio($id){
        
        if ($this->session->userdata('IDROL') == 1 || $this->session->userdata('IDROL') == 2 || $this->session->userdata('IDROL') == 3 || $this->session->userdata('IDROL') == 4) {

        //echo $primary_key;
        $this->load->library('Pdf');
        //$custom_layout = array(340,216);
        $custom_layout =array(340,216);
        $pdf = new TCPDF("L", PDF_UNIT, $custom_layout, true, 'UTF-8', false);
        //$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
 
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('cesar Tosse');
        $pdf->SetTitle('Colegio Gimnasio Calibio');
        $pdf->SetSubject('Desarrollo a la medida.');
        $pdf->SetKeywords('Gimnasio Calibio, Cesar Tosse, 3107455501, Desarrollador de software, guia');
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "COLEGIO GIMNASIO CALIBIO" . ' SOCIEDAD PEDAGOGICA DEL CAUCA TLDA  ', " CODIGO: F-AD-07 VERSION: 02 FECHA: ".date('Y-M-d')."", array(0, 64, 255), array(0, 64, 128));
        $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetMargins(PDF_MARGIN_LEFT, 9, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 
//relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
 
 
// ---------------------------------------------------------
// establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);
 
// Establecer el tipo de letra
 
//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
// Helvetica para reducir el tamaño del archivo.
        //$pdf->SetFont('freemono', '', 14, '', true);
 
// Añadir una página
// Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();
 
//fijar efecto de sombra en el texto
        //$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
 
// Establecemos el contenido para imprimir
        $provincia = $id;
        $provincias = $this->pdfs_model->getMatricula($provincia);
        $contenido = "";
        //IDHOJAMATRICULA
        $prov = "";
//        SELECT * FROM `hojamatricula` where grado='3' order by apellidos asc 
//        SELECT * from hojamatricula where GRADO = 4 and estado=1 order by apellidos asc
        $query = $this->db->query('SELECT * from hojamatricula where GRADO = '.$provincia.' and estado=1 order by apellidos asc');
        foreach ($query->result() as $row){
           $contenido .= '<tr>
            <td colspan="2" align="center">'.$row->NUMEROACTAMATRICULA.'</td>
            <td colspan="6" align="center"><p>'.$row->APELLIDOS.'</p></td>
            <td colspan="5" align="center"><p>'.$row->NOMBRES.'</p></td>
            <td colspan="7" align="center"><p>'.$row->NOMBREPADRE.'</p></td>
            <td colspan="5" align="center"><p>'.$row->TELEFONOPADRE.'</p></td>
            <td colspan="7" align="center"><p>'.$row->NOMBREMADRE.'</p></td>
            <td colspan="5" align="center"><p>'.$row->TELEFONOMADRE.'</p></td>
            <td colspan="4" align="center"><p>'.$row->TELEFONO1.'</p></td>
            <td colspan="7" align="center"><p>'.$row->DIRECCIONRECIDENCIA.'</p></td>
          </tr>';
        }
        $imagen = "";
        if ($row->URL_IMG == "") {
          $imagen = "default.jpg";
        }else{
          $imagen = $row->URL_IMG;
        }
 
        //preparamos y maquetamos el contenido a crear
        $html = '';
        //<link rel=stylesheet href="'.base_url().'css/table.css" type="text/css"/>
        $html = '
 
   <head>
      <meta charset="utf-8"/>  
      <meta name="description" content="Resumen del contenido de la página">
 
      <!-- Latest compiled and minified CSS -->
   <style>
 
      table, th, td {
          border: 1px solid grey;
          border-collapse: collapse;
      }
 
      p {
        font-size: 12px;
      }
 
      p.tall {
        line-height  40%;
      }
 
      h2 {
          text-align: center
      }
 
      h4 {
          text-align: center
      }
 
      p.subtitle {
        text-align: center
        margin-top: -20px;
      }
 
      p.normal {
        margin-top: -20px;
      }
 
      blac{
        color: #ffffff;
      }
 
      </style>
   </head>
 
      <header>
      </header>
      <article>
        <br>
        <table class="cabeza">
          <tr >
            <td colspan="48" align="center"><b>DIRECTORIO DATOS BÁSICOS GRADO '.$id.'</b></td>            
          </tr>
          <tr >
            <td colspan="2" align="center">Matr.</td>
            <td colspan="6" align="center">Apellidos</td>
            <td colspan="5" align="center">Nombres</td>
            <td colspan="7" align="center">Nombre Padre</td>
            <td colspan="5" align="center">Célular</td>
            <td colspan="7" align="center">Nombre Madre</td>
            <td colspan="5" align="center">Célular</td>
            <td colspan="4" align="center">Fijo</td>
            <td colspan="7" align="center">Dirección</td>
          </tr>
         
            '.$contenido.'
        </table>
 
      </article>
';
        //provincias es la respuesta de la función getProvinciasSeleccionadas($provincia) del modelo
       
 
// Imprimimos el texto con writeHTMLCell()
       
       
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        //echo $html;
// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("Localidadedeasd.pdf");
        ob_clean();
        $pdf->Output($nombre_archivo, 'I');
        }

        if ($this->session->userdata('IDROL') == 5) {

          if($this->session->userdata('GRADO') == $id){

        //echo $primary_key;
        $this->load->library('Pdf');
        //$custom_layout = array(340,216);
        $custom_layout =array(340,216);
        $pdf = new TCPDF("L", PDF_UNIT, $custom_layout, true, 'UTF-8', false);
        //$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
 
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Cesar Tosse');
        $pdf->SetTitle('Colegio Gimnasio Calibio');
        $pdf->SetSubject('Desarrollo a la medida.');
        $pdf->SetKeywords('Gimnasio Calibio, Cesar Tosse, 3107455501, Desarrollador de software, guia');
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "COLEGIO GIMNASIO CALIBIO" . ' SOCIEDAD PEDAGOGICA DEL CAUCA TLDA  ', " CODIGO: F-AD-07 VERSION: 02 FECHA: ".date('Y-M-d')."", array(0, 64, 255), array(0, 64, 128));
        $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetMargins(PDF_MARGIN_LEFT, 9, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 
//relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
 
 
// ---------------------------------------------------------
// establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);
 
// Establecer el tipo de letra
 
//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
// Helvetica para reducir el tamaño del archivo.
        //$pdf->SetFont('freemono', '', 14, '', true);
 
// Añadir una página
// Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();
 
//fijar efecto de sombra en el texto
        //$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
 
// Establecemos el contenido para imprimir
        $provincia = $id;
        $provincias = $this->pdfs_model->getMatricula($provincia);
        $contenido = "";
        //IDHOJAMATRICULA
        $prov = "";
        $query = $this->db->query('SELECT * from hojamatricula where GRADO = '.$this->session->userdata('GRADO').' and estado=1 order by apellidos asc');
        foreach ($query->result() as $row){
           $contenido .= '<tr>
            <td colspan="2" align="center">'.$row->NUMEROACTAMATRICULA.'</td>
            <td colspan="6" align="center"><p>'.$row->APELLIDOS.'</p></td>
            <td colspan="5" align="center"><p>'.$row->NOMBRES.'</p></td>
            <td colspan="7" align="center"><p>'.$row->NOMBREPADRE.'</p></td>
            <td colspan="5" align="center"><p>'.$row->TELEFONOPADRE.'</p></td>
            <td colspan="7" align="center"><p>'.$row->NOMBREMADRE.'</p></td>
            <td colspan="5" align="center"><p>'.$row->TELEFONOMADRE.'</p></td>
            <td colspan="4" align="center"><p>'.$row->TELEFONO1.'</p></td>
            <td colspan="7" align="center"><p>'.$row->DIRECCIONRECIDENCIA.'</p></td>
          </tr>';
        }
        $imagen = "";
        if ($row->URL_IMG == "") {
          $imagen = "default.jpg";
        }else{
          $imagen = $row->URL_IMG;
        }
 
        //preparamos y maquetamos el contenido a crear
        $html = '';
        //<link rel=stylesheet href="'.base_url().'css/table.css" type="text/css"/>
        $html = '
 
   <head>
      <meta charset="utf-8"/>  
      <meta name="description" content="Resumen del contenido de la página">
 
      <!-- Latest compiled and minified CSS -->
   <style>
 
      table, th, td {
          border: 1px solid grey;
          border-collapse: collapse;
      }
 
      p {
        font-size: 12px;
      }
 
      p.tall {
        line-height  40%;
      }
 
      h2 {
          text-align: center
      }
 
      h4 {
          text-align: center
      }
 
      p.subtitle {
        text-align: center
        margin-top: -20px;
      }
 
      p.normal {
        margin-top: -20px;
      }
 
      blac{
        color: #ffffff;
      }
 
      </style>
   </head>
 
      <header>
      </header>
      <article>
        <br>
        <table class="cabeza">
          <tr >
            <td colspan="48" align="center"><b>DIRECTORIO DATOS BÁSICOS GRADO '.$id.'</b></td>            
          </tr>
          <tr >
            <td colspan="2" align="center">Matr.</td>
            <td colspan="6" align="center">Apellidos</td>
            <td colspan="5" align="center">Nombres</td>
            <td colspan="7" align="center">Nombre Padre</td>
            <td colspan="5" align="center">Célular</td>
            <td colspan="7" align="center">Nombre Madre</td>
            <td colspan="5" align="center">Célular</td>
            <td colspan="4" align="center">Fijo</td>
            <td colspan="7" align="center">Dirección</td>
          </tr>
         
            '.$contenido.'
        </table>
 
      </article>
';
        //provincias es la respuesta de la función getProvinciasSeleccionadas($provincia) del modelo
       
 
// Imprimimos el texto con writeHTMLCell()
       
       
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        //echo $html;
// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("Localidadedeasd.pdf");
        ob_clean();
        $pdf->Output($nombre_archivo, 'I');
          }
          else{
            header ("Location: ".base_url().'metodos/directorio/'.$this->session->userdata('GRADO'));
          }
        }

    }

     public function entrefichas($select,$nombre){
        
        $select = decryptIt($select);

        //echo $primary_key;
        $this->load->library('Pdf');
        $custom_layout = array(215.9,279.4);
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, $custom_layout, true, 'UTF-8', false);
        //$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Cesar Tosse');
        $pdf->SetTitle('Colegio Gimnasio Calibio');
        $pdf->SetSubject('Desarrollo a la medida.');
        $pdf->SetKeywords('Gimnasio Calibio, cesar Tosse, 3107455501, Desarrollador de software, guia');
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "COLEGIO GIMNASIO CALIBIO" . ' SOCIEDAD PEDAGOGICA DEL CAUCA TLDA  ', " CODIGO: F-AD-07 VERSION: 02 FECHA: ".date('Y-M-d')."", array(0, 64, 255), array(0, 64, 128));
        $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetMargins(PDF_MARGIN_LEFT, 9, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 
//relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
 
 
// ---------------------------------------------------------
// establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);
 
// Establecer el tipo de letra
 
//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
// Helvetica para reducir el tamaño del archivo.
        //$pdf->SetFont('freemono', '', 14, '', true);
 
// Añadir una página
// Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();
 
 
//fijar efecto de sombra en el texto
        //$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
 
// Establecemos el contenido para imprimir
        //$provincia = $id;
        //$provincias = $this->pdfs_model->getMatricula($provincia);
        $contenido = "";
        //IDHOJAMATRICULA
        $prov = "";
        $query = $this->db->query($select);
        foreach ($query->result() as $row){

          $imagen = "";
            if ($row->URL_IMG == "") {
              $imagen = "default.jpg";
            }else{
              $imagen = $row->URL_IMG;
            }


           $contenido .= '<article>
        <br>

        <table>
          <tr>
            <td rowspan="3"><p class="center" ><img class="center" height="70" src="'.base_url().'assets/calibio-popayan.jpg"></p></td>
            <td colspan="6" rowspan="2"><p class="title"> <b>COLEGIO GIMNASIO CALIBÍO</b></p><p class="subtitle">SOCIEDAD PEDAGÓGICA DEL CAUCA LTDA.</p></td>            
            <td colspan="2"><p >CODIGO: F-AD-07</p></td>
          </tr>
          <tr>       
            <td colspan="2"><p class="normal">VERSION: 02</p></td>
          </tr>
          <tr>
            <td colspan="6"><p class="center" class="th"><b>HOJA DE MATRICULA.</b></p></td>            
            <td colspan="2"><p>FECHA: 28 JUL 2010</p></td>
          </tr>
        </table>
        
        <br>
        <br>
          <table>
            <tr>
              <td colspan="5"><p class="center2"><center><B><br>DATOS DEL ESTUDIANTE</B></p></center><br></td>              
              <td rowspan="4" align="center"><div></div> <img height="130" src="'.base_url().'assets/uploads/files/'.$imagen.'"></td>
            </tr>
            <tr>
              <td colspan="2"><p class="tall">Fecha ingreso<br> <b>POPAYÁN, '.$row->FECHAINGRESO.'</b></p></td>
              <td  colspan="3"><p class="tall">Acta de Matricula N°: <br><b class="c">'.$row->NUMEROACTAMATRICULA.'</b></p></td>
                    
            </tr>
            <tr>
              <td colspan="3"><p class="tall">Nombres: <br><b>'.$row->NOMBRES.'</b></p></td>
              <td colspan="2"><p class="tall">Apellidos: <br><b>'.$row->APELLIDOS.'</b></p></td>
            </tr>
            <tr>
              <td colspan="3"><p class="tall">Lugar y fecha de nacimiento: <br><b>'.$row->LUGARNACIMIENTO.'.  '.date("d-m-Y",$row->FECHANACIMIENTO).'</b></p></td>
              <td colspan="2"><p class="tall">Registro Cicil N°<br><b>'.$row->NUMEROREGISTROCIVIL.'</b> </p></td>
            </tr>
            <tr>
              <td><p class="tall">RH<br><b>'.$row->RH.'</b></p></td>
              <td colspan="3"><p class="tall">Tarjeta de identidad o NUIP <br><b>'.$row->TARJETAIDENTIDAD.'</b></p></td>              
              <td colspan="2"><p class="tall">Edad:<br> <b>'.$row->EDAD.'</b></p></td>
            </tr>
            <tr>
              <td colspan="3"><p class="tall">Dirección residencial: <br><b>'.$row->DIRECCIONRECIDENCIA.'</b></p></td>
              <td colspan="3"><p class="tall">Telefonos: <br><b>'.$row->TELEFONO1.' - '.$row->TELEFONO2.'</b></p></td>
            </tr>
            <tr>
              <td colspan="2"><p class="tall">E.P.S. <br><b>'.$row->EPS.'</b></p></td>
              <td colspan="2"><p class="tall">Exámenes <br><b>'.$row->CVACUNAS.'</b></p></td>
              <td colspan="2"><p class="tall">Colegio anterior <br><b>'.$row->COLEGIOANTERIORINMEDIATO.'</b></p></td>
            </tr>
          </table >
         <br>
         <table border="1px" width="100%"  class="table table-bordered column-options" >
            
            <tr>
               <th colspan="2"><p class="center2"><center><B><br>DATOS DE LOS PADRES</B></center></p><br></th>
            </tr>
            <tr>
               <td><p class="tall">Nombre del Padre: <br><b>'.$row->NOMBREPADRE.'</b></p></td>
               <td><p class="tall">Nombre de la Madre <br><b>'.$row->NOMBREMADRE.'</b></p></td>
            </tr>
            <tr>
               <td><p class="tall">Cedula de ciudadanía <br><b>'.$row->CEDULAPADRE.'</b></p></td>
               <td><p class="tall">Cedula de ciudadanía <br><b>'.$row->CEDULAMADRE.'</b></p></td> 
            </tr>
            <tr>
               <td><p class="tall">Dirección de residencia u oficina: <br><b>'.$row->DIRECCIONROPADRE.'</b></p></td>
               <td><p class="tall">Dirección de residencia u oficina: <br><b>'.$row->DIRECCIONROMADRE.'</b></p></td>
            </tr>
            <tr>
               <td><p class="tall">Telefono: <br><b>'.$row->TELEFONOPADRE.'</b></p></td>
               <td><p class="tall">Telefono: <br><b>'.$row->TELEFONOMADRE.'</b></p></td>
            </tr>
            <tr>
               <td><p class="tall">Email: <br><b>'.$row->CORREOPADRE.'</b></p></td> 
               <td><p class="tall">Email: <br><b>'.$row->CORREOMADRE.'</b></p></td> 
            </tr>
         </table>
         <br>
        <table class"espacio">
          <tr>
            <td colspan="2"><h5>Año</h5></td>
            <td colspan="2"><h5>Grado</h5></td>
            <td><h5>Edad</h5></td>
            <td colspan="4"><h5>Firma del Estudainte</h5></td>
            <td colspan="4"><h5>Firma del Padre o Acudiente</h5></td>
          </tr>
          <tr>
          <td colspan="2"><p class="numero">2015 - 2016</p></td>
            <td colspan="2"></td>
            <td></td>
            <td colspan="4"></td>
            <td colspan="4"></td>
          </tr>
          <tr>
          <td colspan="2"><p class="numero">2016 - 2017</p></td>
            <td colspan="2"></td>
            <td></td>
            <td colspan="4"></td>
            <td colspan="4"></td>
          </tr>
          <tr>
          <td colspan="2"><p class="numero">2017 - 2018</p></td>
            <td colspan="2"></td>
            <td></td>
            <td colspan="4"></td>
            <td colspan="4"></td>
          </tr>
          <tr>
          <td colspan="2"><p class="numero">2018 - 2019</p></td>
            <td colspan="2"></td>
            <td></td>
            <td colspan="4"></td>
            <td colspan="4"></td>
          </tr>
          <tr>
          <td colspan="2"><p class="numero">2019 - 2020</p></td>
            <td colspan="2"></td>
            <td></td>
            <td colspan="4"></td>
            <td colspan="4"></td>
          </tr>
          <tr>
          <td colspan="2"><p class="numero">2020 - 2021</p></td>
            <td colspan="2"></td>
            <td></td>
            <td colspan="4"></td>
            <td colspan="4"></td>
          </tr>
        </table>
            <br>
            <table border="1px" width="100%"  class="table table-bordered column-options" >
            <tr>
               <td colspan="2"><p class="t"><b>Damos constancia conocer el Manual de Convivencia y con nuestras firmas <br> nos comprometemos a darle estricto cumplimiento.</b></p></td>
            </tr>
            <tr>
               <td>Padre o Acudiente <br><br>. </td>
               <td>Estudiante <br><br>.</td> 
            </tr>
            <tr>
               <td>Rectoria <br><br>.</td>
               <td>Secretaria <br><br>.</td> 
            </tr>
         </table>
         <br>
         <br>
         <center><p class="center3"><b>OBSERVACIONES</b></p></center>
         <p class="espacio">______________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________</p>
         <table border="1px" width="100%"  class="table table-bordered column-options" >
            
            <tr>
               <th colspan="2"><p class="t"><b>DATOS DEL ESTUDIANTE <br> Espacio para cambio de datos del estudiate.</b></p></th>
            </tr>
            <tr>
               <td><p>Apellidos</p>:</td>
               <td><p>Nombres</p>:</td>
            </tr>
            <tr>
               <td><p>Dirección Residencial</p>:</td>
               <td><p>Telefonos</p>:</td> 
            </tr>
            <tr>
               <td>.<br>.</td>
               <td>.<br>.</td>
            </tr>
            <tr>
               <td>.<br>.</td>
               <td>.<br>.</td>
            </tr>
            <tr>
               <td>.<br>.</td>
               <td>.<br>.</td>
            </tr>
            <tr>
               <td>.<br>.</td>
               <td>.<br>.</td>
            </tr>
         </table>

         <table border="1px" width="100%"  class="table table-bordered column-options" >
            
            <tr>
               <th colspan="4"><p class="t"><br><b><center>DATOS OTROS COLEGIOS</center><br></b></p></th>
            </tr>
            <tr>
               <td><p class="t">AÑO</p></td>
               <td><p class="t">GRADO</p></td>
               <td><p class="t">EDAD</p></td>
               <td><p class="t">NOMBRE DEL COLEGIO</p></td>
            </tr>
            <tr>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
            </tr>
            <tr>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
            </tr>
            <tr>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
            </tr>
            <tr>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
            </tr>
            <tr>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
            </tr>
            <tr>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
            </tr>

            
         </table>';
        }
        
        //preparamos y maquetamos el contenido a crear
        //<link rel=stylesheet href="'.base_url().'css/table.css" type="text/css"/>
        $html = '
        <head>
      <meta charset="utf-8"/>   
      <meta name="description" content="Resumen del contenido de la página">

      <!-- Latest compiled and minified CSS -->
   <style>

      table, th, td {
          border: 1px solid black;
          border-collapse: collapse;
      }

      table.espacio{
        border-spacing:  15px;
      }

      p {
        font-size: 12px;
      }

      p.tall {
        line-height  40%;
      }

      img.center {
          position: absolute;
          top: 0; bottom:0; left: 0; right:0;
          margin: auto;
      }
      h1 {
          text-align:center; 
          margin:-10;
          padding:0;
          vertical-align:middle; 
          display:table-cell; 
      }

      p.subtitle {
      font-size: 15px;
        text-align: center;
        margin-top: -30px;
        line-height: -40px;
      }
      
      p.espacio {
        text-align: center;
        line-height: 20px;
      }

      p.center {
        text-align: center;
        line-height: 20px;
      }

      p.center3 {
        text-align: center;
        line-height: 1px;
      }

      p.center2 {
        text-align: center;
        line-height: 10px;
        font-size: 15px;
      }

      p.title {
        margin-bottom: 25px;
        padding:0;
        position: absolute;
        text-align: center;        
        font-size: 25px;
        line-height: 25px;
      }

      p.numero{
        line-height: 26px;
        text-align: center;        
        font-size: 14px;
      }
      
      p.t {
        text-align: center; 
      }
      
      p.th {
        text-align: center;
        line-height: 25px;
        font-size: 15px;
      }
      


      p.normal {
        margin-top: -20px;
        line-height: 40px;
      }

      h5 {
          text-align: center
      }
      
      b.c {
          text-align: center
      }

      </style>
   </head>

      <header>
      </header>
      '.$contenido.'

      </article>
';
        //provincias es la respuesta de la función getProvinciasSeleccionadas($provincia) del modelo
        
 
// Imprimimos el texto con writeHTMLCell()
        
        
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        //echo $html;
// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode($nombre.'.pdf');
        ob_clean();
        $pdf->Output($nombre_archivo, 'I');
    }

     public function entreobservador($select,$nombre){
        
        $select = decryptIt($select);

        //echo $primary_key;
        $this->load->library('Pdf');
        $custom_layout = array(215.9,340);
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, $custom_layout, true, 'UTF-8', false);
        //$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Cesar Tosse');
        $pdf->SetTitle('Colegio Gimnasio Calibio');
        $pdf->SetSubject('Desarrollo a la medida.');
        $pdf->SetKeywords('Gimnasio Calibio, Cesar Tosse, 3107455501, Desarrollador de software, guia');
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "COLEGIO GIMNASIO CALIBIO" . ' SOCIEDAD PEDAGOGICA DEL CAUCA TLDA  ', " CODIGO: F-AD-07 VERSION: 02 FECHA: ".date('Y-M-d')."", array(0, 64, 255), array(0, 64, 128));
        $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetMargins(PDF_MARGIN_LEFT, 9, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 
//relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
 
 
// ---------------------------------------------------------
// establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);
 
// Establecer el tipo de letra
 
//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
// Helvetica para reducir el tamaño del archivo.
        //$pdf->SetFont('freemono', '', 14, '', true);
 
// Añadir una página
// Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();
 
 
//fijar efecto de sombra en el texto
        //$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
 
// Establecemos el contenido para imprimir
        //$provincia = $id;
        //$provincias = $this->pdfs_model->getMatricula($provincia);
        $contenido = "";
        //IDHOJAMATRICULA
        $prov = "";
        $query = $this->db->query($select);
        foreach ($query->result() as $row){

          $imagen = "";
            if ($row->URL_IMG == "") {
              $imagen = "default.jpg";
            }else{
              $imagen = $row->URL_IMG;
            }


           $contenido .= '

      <header>
      </header>
      <article>
        <br>
        <br>

        <table class="cabeza">
          <tr class="cabeza">
            <td class="cabeza" rowspan="3"><p class="center" ><img class="center" height="70" src="'.base_url().'assets/calibio-popayan.jpg"></p></td>
            <td class="cabeza" colspan="6" rowspan="2"><p class="title"><b> COLEGIO GIMNASIO CALIBÍO </b></p><p class="subtitle">SOCIEDAD PEDAGÓGICA DEL CAUCA LTDA.</p></td>            
            <td class="cabeza" colspan="2"><p >CODIGO: F-GA-20</p></td>
          </tr>
          <tr class="cabeza">       
            <td colspan="2"><p class="normal">VERSION: 01</p></td>
          </tr>
          <tr class="cabeza">
         
            <td class="cabeza" colspan="6"><p class="to"  align="center"><b>OBSERVADOR DEL ESTUDIANTE.</b></p></td>            
            <td class="cabeza" colspan="2"><p>FECHA: 20 AGO 2010</p></td>
          </tr>
        </table>

        <br>
        <br>

        <table class="cabeza">
          <tr>
            <td class="cabeza" colspan="8"><h4>DATOS PERSONALES Y FAMILIARES</h4></td>
            <td class="cabeza" colspan="2" rowspan="6" align="center"><p><img height="130" src="'.base_url().'assets/uploads/files/'.$imagen.'"></p></td>
          </tr>
          <tr>
            <td class="" colspan="4"><p class="numero">Nombres: <b>'.$row->NOMBRES.'</b></p></td>
            <td class="" colspan="4"><p class="numero">Apellidos: <b>'.$row->APELLIDOS.'</b></p></td>
          </tr>
          <tr>
            <td class="" colspan="4"><p class="numero">Años cumplidos: <b>'.$row->EDAD.'</b></p></td>
            <td class="" colspan="2"><p class="numero">No. Matricula: <b>'.$row->NUMEROACTAMATRICULA.'</b></p></td>
            <td class="" colspan="2"><p class="numero">Curso: <b>'.$row->GRADO.'</b></p></td>
          </tr>
          <tr>
            <td class="" colspan="4"><p class="numero">No. de hermanos: </p></td>
            <td class="" colspan="2"><p class="numero">Lugar que ocupa: </p></td>
            <td class="" colspan="2"><p class="numero">R.H:  <b>'.$row->RH.'</b></p></td>
          </tr>
          <tr>
            <td class="" colspan="5"><p class="numero">Dirección: <b>'.$row->DIRECCIONRECIDENCIAN.'</b></p></td>
            <td class="" colspan="3"><p class="numero">Teléfonos <b>'.$row->TELEFONO1.' '.$row->TELEFONO2.'</b></p></td>
          </tr>
          <tr>
            <td class="" colspan="8"><p class="numero">Emails: <b>'.$row->CORREOPADRE.' &#09;  '.$row->CORREOMADRE.'</b></p></td>
          </tr>
          <tr>
            <td class="" colspan="10"><p class="numero">Con quien vive: ________________________________________________________________________________</p></td>
          </tr>
          <tr>
            <td class="" colspan="6"><p class="numero">Nombre del Padre: <b>'.$row->NOMBREPADRE.'</b></p></td>
            <td class="" colspan="4"><p class="numero">Ocupación: <b>'.$row->OCUPACIONPADRE.'</b></p></td>
          </tr>
          <tr>
            <td class="" colspan="6"><p class="numero">Empresa donde trabaja: <b>'.$row->DIRECCIONROPADRE.'</b></p></td>
            <td class="" colspan="4"><p class="numero">Teléfono: <b>'.$row->TELEFONOPADRE.'</b></p></td>
          </tr>
          <tr>
            <td class="" colspan="6"><p class="numero">Nombre de la Madre: <b>'.$row->NOMBREMADRE.'</b></p></td>
            <td class="" colspan="4"><p class="numero">Ocupación: <b>'.$row->OCUPACIONMADRE.'</b></p></td>
          </tr>
          <tr>
            <td class="" colspan="6"><p class="numero">Empresa donde trabaja: <b>'.$row->DIRECCIONROMADRE.'</b></p></td>
            <td class="" colspan="4"><p class="numero">Teléfono: <b>'.$row->TELEFONOMADRE.'</b></p></td>
          </tr>
        </table>
        <br>
        <br>

        <table class="cabeza" >
          <tr class="cabeza">
            <td class="cabeza" colspan="5"><h4>DATOS ESCOLARES</h4></td>
          </tr>        
        </table>
        Planteles en que ha estudiado:<br>
        
        <table class="cabeza" >
          <tr class="cabeza">
            <td class="cabeza" colspan="3"><p class="t">COLEGIO</p></td>
            <td class="cabeza" colspan="2"><p class="t">CIUDAD</p></td>
            <td class="cabeza" colspan="2"><p class="t">AÑO</p></td>
            <td class="cabeza" colspan="2"><p class="t">CURSO</p></td>
          </tr> 
          <tr class="cabeza">
            <td class="cabeza" colspan="3"></td>
            <td class="cabeza" colspan="2"></td>
            <td class="cabeza" colspan="2"></td>
            <td class="cabeza" colspan="2"></td>
          </tr> 
          <tr class="cabeza">
            <td class="cabeza" colspan="3"></td>
            <td class="cabeza" colspan="2"></td>
            <td class="cabeza" colspan="2"></td>
            <td class="cabeza" colspan="2"></td>
          </tr> 
          <tr class="cabeza">
            <td class="cabeza" colspan="3"></td>
            <td class="cabeza" colspan="2"></td>
            <td class="cabeza" colspan="2"></td>
            <td class="cabeza" colspan="2"></td>
          </tr> 
          <tr class="cabeza">
            <td class="cabeza" colspan="3"></td>
            <td class="cabeza" colspan="2"></td>
            <td class="cabeza" colspan="2"></td>
            <td class="cabeza" colspan="2"></td>
          </tr> 
          <tr class="cabeza">
            <td class="cabeza" colspan="3"></td>
            <td class="cabeza" colspan="2"></td>
            <td class="cabeza" colspan="2"></td>
            <td class="cabeza" colspan="2"></td>
          </tr>        
        </table>
        <br><br>
         <table class="cabeza2" >
          <tr class="cabeza">
            <td class="cabeza" ><h4>PROCESO CONVIVENCIAL, FORMATIVO Y ACADÉMICO</h4></td>
          </tr>        
        </table>
        <br>
        <table>
          <tr class="cabeza">
          <td class="cabeza" ><h6>FECHA - MOTIVO - FIRMAS: DOCENTE Y ESTUDIANTE</h6></td>
          </tr>

          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
         
        </table>
<br>
        <br><br>
         <table class="cabeza2" >
          <tr class="cabeza">
            <td class="cabeza" ><h4>PROCESO CONVIVENCIONAL, FORMATIVO Y ACADEMICO</h4></td>
          </tr>        
        </table>

        <table>
          <tr class="cabeza">
          <td class="cabeza" ><h6>FECHA - MOTIVO - FIRMAS: DOCENTE Y ESTUDIANTE</h6></td>
          </tr>
        </table>

        <table>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
                    
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
          <tr class="cabeza">            
            <td class="cabeza"></td>
          </tr>
        </table>

      </article>';
        }
        
        //preparamos y maquetamos el contenido a crear
        //<link rel=stylesheet href="'.base_url().'css/table.css" type="text/css"/>
        $html = '
        <head>
      <meta charset="utf-8"/>   
      <meta name="description" content="Resumen del contenido de la página">

      <!-- Latest compiled and minified CSS -->
   <style>    

      table.cabeza, th.cabeza, td.cabeza{
          border: 1px solid black;
          border-collapse: collapse;
      }

      table.cabeza2{
          border: 2px solid black;
          border-collapse: collapse;
      }

      p {
        font-size: 12px;
      }

      p.tall {
        line-height  40%;
      }

      h2 {
          text-align: center
      }

      h6 {
          text-align: center
      }

      h4 {
          text-align: center
      }

      p.subtitle {
        text-align: center
        margin-top: -20px;

      }

      p.normal {
        margin-top: -20px;
      }

      blac{
        color: #ffffff;
      }

      table.test {
        border: red 7px solid;
      }

      +tbody {
        border: blue 7px solid;
      }


      p {
        font-size: 12px;
      }

      p.tall {
        line-height  40%;
      }

      img.center {
          position: absolute;
          top: 0; bottom:0; left: 0; right:0;
          margin: auto;
      }
      h1 {
          text-align:center; 
          margin:-10;
          padding:0;
          vertical-align:middle; 
          display:table-cell; 
      }

     p.subtitle {
        text-align: center;
        margin-top: -30px;
        line-height: -40px;
        font-size: 15px;
      }

      p.center {
        text-align: center;
        line-height: 20px;
      }

      p.title {
        margin-bottom: 25px;
        padding:0;
        position: absolute;
        text-align: center;        
        font-size: 25px;
        line-height: 25px;
      }

      p.numero{
        line-height: 25px;
        font-size: 12px;

      }
      
      p.t {
        text-align: center; 
      }

      p.normal {
        margin-top: -20px;
        line-height: 40px;
      }

      h5 {
          text-align: center
      }
      
      p.to {
        text-align: center;
        line-height: 25px;
         font-size: 15px;
      }

      </style>
   </head>

      <header>
      </header>
      '.$contenido.'

      </article>
';
        //provincias es la respuesta de la función getProvinciasSeleccionadas($provincia) del modelo
        
 
// Imprimimos el texto con writeHTMLCell()
        
        
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        //echo $html;
// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode($nombre.'.pdf');
        ob_clean();
        $pdf->Output($nombre_archivo, 'I');
    }

    public function entreregistro($select,$nombre){
        
        $select = decryptIt($select);

        //echo $primary_key;
        $this->load->library('Pdf');
        $custom_layout = array(215.9,279.4);
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, $custom_layout, true, 'UTF-8', false);
        //$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Cesar Tosse');
        $pdf->SetTitle('Colegio Gimnasio Calibio');
        $pdf->SetSubject('Desarrollo a la medida.');
        $pdf->SetKeywords('Gimnasio Calibio, Cesar Tosse, 3107455501, Desarrollador de software, guia');
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "COLEGIO GIMNASIO CALIBIO" . ' SOCIEDAD PEDAGOGICA DEL CAUCA TLDA  ', " CODIGO: F-AD-07 VERSION: 02 FECHA: ".date('Y-M-d')."", array(0, 64, 255), array(0, 64, 128));
        $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetMargins(PDF_MARGIN_LEFT, 9, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 
//relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
 
 
// ---------------------------------------------------------
// establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);
 
// Establecer el tipo de letra
 
//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
// Helvetica para reducir el tamaño del archivo.
        //$pdf->SetFont('freemono', '', 14, '', true);
 
// Añadir una página
// Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();
 
 
//fijar efecto de sombra en el texto
        //$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
 
// Establecemos el contenido para imprimir
        //$provincia = $id;
        //$provincias = $this->pdfs_model->getMatricula($provincia);
        $contenido = "";
        //IDHOJAMATRICULA
        $prov = "";
        $query = $this->db->query($select);
        foreach ($query->result() as $row){

          $imagen = "";
            if ($row->URL_IMG == "") {
              $imagen = "default.jpg";
            }else{
              $imagen = $row->URL_IMG;
            }


           $contenido .= '

      <header>
      </header>
      <article>
        <br>
        <br>
        
        <table class="cabeza">
          <tr class="cabeza">
            <td class="cabeza" rowspan="3"><p class="center" ><img class="center" height="70" src="'.base_url().'assets/calibio-popayan.jpg"></p></td>
            <td class="cabeza" colspan="6" rowspan="2"><p class="title"><b> COLEGIO GIMNASIO CALIBÍO</b></p><p class="subtitle">SOCIEDAD PEDAGÓGICA DEL CAUCA LTDA.</p></td>            
            <td class="cabeza" colspan="2"><p >CODIGO: F-GA-18</p></td>
          </tr>
          <tr class="cabeza">       
            <td colspan="2"><p class="normal">VERSION: 01</p></td>
          </tr>
          <tr class="cabeza">
            <td class="cabeza" colspan="6"><p class="center"><b>REGISTRO DE ENTREVISTAS.</b></p></td>            
            <td class="cabeza" colspan="2"><p>FECHA: 20 AGO 2010</p></td>
          </tr>
        </table>
        <br>
        <br>

        <table >
          <tr>
            <td colspan="9"><p><B>Nombre del Estudiante: '.$row->NOMBRES.' '.$row->APELLIDOS.'</B></p></td>
            <td colspan="2"><p><B>Curso: '.$row->GRADO.'</B></p></td>
          </tr>
          <tr>
            <td colspan="7"><p><B>Nombre del Padre: '.$row->NOMBREPADRE.'</B></p></td>
            <td colspan="4"><p><B>Ocupación: '.$row->OCUPACIONPADRE.'</B></p></td>
          </tr>
          <tr>
            <td colspan="7"><p><B>Nombre de la Madre: '.$row->NOMBREMADRE.'</B></p></td>
            <td colspan="4"><p><B>Ocupación: '.$row->OCUPACIONMADRE.'</B></p></td>
          </tr>
        </table>

        <br>
        <br>

        <table class="cabeza">
          <tr>
            <td class="cabeza">Fecha</td>
            <td colspan="11" class="cabeza"><P class="center"><b>ASPECTOS A TRATAR</b></p></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          
         
        </table>
        <br>
           <br>
          <br>
          
        <table>
         <tr BGCOLOR="#000000">
              <td><font color="#fff"> Fecha</font></td>
              <td colspan="11"><p color="#fff" class="center">ASPECTOS A TRATAR</p></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td class="cabeza"></td>
              <td class="cabeza" colspan="11"></td>
          </tr>
          <tr>
              <td></td>
              <td colspan="11"></td>
          </tr>
          
          
        </table>

      </article>';
        }
        
        //preparamos y maquetamos el contenido a crear
        //<link rel=stylesheet href="'.base_url().'css/table.css" type="text/css"/>
        $html = '
   <head>
      <meta charset="utf-8"/>   
      <meta name="description" content="Resumen del contenido de la página">

      <!-- Latest compiled and minified CSS -->
   <style>

      table.cabeza, th.cabeza, td.cabeza{
          border: 1px solid black;
          border-collapse: collapse;
      }

      table.cabeza2{
          border: 2px solid black;
          border-collapse: collapse;
      }

      p {
        font-size: 12px;
      }

      p.tall {
        line-height  40%;
      }

      img.center {
          position: absolute;
          top: 0; bottom:0; left: 0; right:0;
          margin: auto;
      }
      h1 {
          text-align:center; 
          margin:-10;
          padding:0;
          vertical-align:middle; 
          display:table-cell; 
      }

      .subtitle {
        text-align: center;
        margin-top: -30px;
        line-height: -40px;      
        font-size: 15px;
      }

     p.center {
        text-align: center;
        line-height: 20px;
        font-size: 15px;
      }
      
  
      p.title {
        margin-bottom: 25px;
        padding:0;
        position: absolute;
        text-align: center;        
        font-size: 25px;
        line-height: 25px;
      }

      p.numero{
        line-height: 26px;
        text-align: center;        
        font-size: 14px;
      }
      
      p.t {
        text-align: center; 
      }

      p.normal {
        margin-top: -20px;
        line-height: 40px;
      }

      h5 {
          text-align: center
      }
      </style>
   </head>

      <header>
      </header>
      '.$contenido.'

      </article>
';
        //provincias es la respuesta de la función getProvinciasSeleccionadas($provincia) del modelo
        
 
// Imprimimos el texto con writeHTMLCell()
        
        
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        //echo $html;
// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode($nombre.'.pdf');
        ob_clean();
        $pdf->Output($nombre_archivo, 'I');
    }
    
    public function nombreusuario($select,$nombre){
        
    }


}
