<!DOCTYPE html>
<html lang="en">
<head>
  <title>Data bank Calibio.</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-default" role="navigation">
  <!-- El logotipo y el icono que despliega el menú se agrupan
       para mostrarlos mejor en los dispositivos móviles -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse"
            data-target=".navbar-ex1-collapse">
      <span class="sr-only">Desplegar navegación</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="<?php echo base_url(); ?>metodos/matricula/#">Inicio</a>
  </div>


 
  <!-- Agrupar los enlaces de navegación, los formularios y cualquier
       otro elemento que se pueda ocultar al minimizar la barra -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav ">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Matrículas <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo base_url(); ?>metodos/matricula">Activas </a></li>
          <li><a href="<?php echo base_url(); ?>metodos/matriculaoff">Inactivas </a></li>
          <li><a href="<?php echo base_url(); ?>metodos/matriculaall">Todas </a></li>
        </ul>
      </li>
    </ul>
      <ul class="nav navbar-nav">
      <li class="active"><a href="<?php echo base_url(); ?>metodos/usuario">Usuarios</a></li>
    </ul>

    <ul class="nav navbar-nav ">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Grado <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo base_url(); ?>metodos/grado/1">Primero </a></li>
          <li><a href="<?php echo base_url(); ?>metodos/grado/2">Segundo </a></li>
          <li><a href="<?php echo base_url(); ?>metodos/grado/3">Tercero </a></li>
          <li><a href="<?php echo base_url(); ?>metodos/grado/4">Cuarto </a></li>
          <li><a href="<?php echo base_url(); ?>metodos/grado/5">Quinto </a></li>
          <li><a href="<?php echo base_url(); ?>metodos/grado/6">Sexto </a></li>
          <li><a href="<?php echo base_url(); ?>metodos/grado/7">Séptimo </a></li>
          <li><a href="<?php echo base_url(); ?>metodos/grado/8">Octavo </a></li>
          <li><a href="<?php echo base_url(); ?>metodos/grado/9">Noveno </a></li>
          <li><a href="<?php echo base_url(); ?>metodos/grado/10">Décimo </a></li>
          <li><a href="<?php echo base_url(); ?>metodos/grado/11">Undécimo </a></li>
        </ul>
      </li>
    </ul>

    <ul class="nav navbar-nav ">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Formatos por Grado <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo base_url(); ?>metodos/gradot/1">Primero </a></li>
          <li><a href="<?php echo base_url(); ?>metodos/gradot/2">Segundo </a></li>
          <li><a href="<?php echo base_url(); ?>metodos/gradot/3">Tercero </a></li>
          <li><a href="<?php echo base_url(); ?>metodos/gradot/4">Cuarto </a></li>
          <li><a href="<?php echo base_url(); ?>metodos/gradot/5">Quinto </a></li>
          <li><a href="<?php echo base_url(); ?>metodos/gradot/6">Sexto </a></li>
          <li><a href="<?php echo base_url(); ?>metodos/gradot/7">Séptimo </a></li>
          <li><a href="<?php echo base_url(); ?>metodos/gradot/8">Octavo </a></li>
          <li><a href="<?php echo base_url(); ?>metodos/gradot/9">Noveno </a></li>
          <li><a href="<?php echo base_url(); ?>metodos/gradot/10">Décimo </a></li>
          <li><a href="<?php echo base_url(); ?>metodos/gradot/11">Undécimo </a></li>
        </ul>
      </li>
    </ul>

    <ul class="nav navbar-nav ">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Directorio <b class="caret"></b>
        </a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo base_url(); ?>metodos/directorio/1">Primero </a></li>
          <li><a href="<?php echo base_url(); ?>metodos/directorio/2">Segundo </a></li>
          <li><a href="<?php echo base_url(); ?>metodos/directorio/3">Tercero </a></li>
          <li><a href="<?php echo base_url(); ?>metodos/directorio/4">Cuarto </a></li>
          <li><a href="<?php echo base_url(); ?>metodos/directorio/5">Quinto </a></li>
          <li><a href="<?php echo base_url(); ?>metodos/directorio/6">Sexto </a></li>
          <li><a href="<?php echo base_url(); ?>metodos/directorio/7">Séptimo </a></li>
          <li><a href="<?php echo base_url(); ?>metodos/directorio/8">Octavo </a></li>
          <li><a href="<?php echo base_url(); ?>metodos/directorio/9">Noveno </a></li>
          <li><a href="<?php echo base_url(); ?>metodos/directorio/10">Décimo </a></li>
          <li><a href="<?php echo base_url(); ?>metodos/directorio/11">Undécimo </a></li>
        </ul>
      </li>
    </ul>
 
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          Opciones <b class="caret"></b>
        </a>
          
          <ul class="dropdown-menu">
          <li><a href="<?php echo base_url(); ?>close">Salir </a></li>          
        </ul>
      </li>
    </ul>
  </div>
</nav>


<body>
    
    

<script type="text/javascript">
  
  $(document).ready(function(){
    $("#save-and-go-back-button" ).click(function() {
      alert("Función Realizada Correctamente." );

      setTimeout(function () { 
                    window.history.back();;
                        }, 2000);
      
    });
  });
</script>

<?php 
  
  if (isset($contenido)) {
    echo $contenido;
  }
?>

</body>


