<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</head>

<body background="assets/img/fondo.jpg">
			    <div class="container">
			        <div class="row">
			            <br>
			            <br>
			            <div class="col-md-4 col-md-offset-4">
			                <div class="login-panel panel panel-default">
			                    <div class="panel-heading">
			                        <h3 class="panel-title">Por favor Iniciar Sesión</h3>
			                    </div>
			                    <div class="panel-body">

			            <form action="<?php echo base_url(); ?>login/entrar" method="post">
			                <input class="form-control" type="text" name="email" placeholder="Correo Electronico"/><br />
			                <input class="form-control" type="password" name="password"  placeholder="Contraseña"/><br />
			                  <div class="checkbox">
			                                    <label>
			                                        <input name="remember" type="checkbox" value="Recordar usuario">Recordar usuario
			                                    </label>			                                    
			                   </div>
			                <input class="btn btn-lg btn-success btn-block" type="submit" name="login" value="Ingresar" />
			                
			            </form>  
			             </div>
			                </div>
			            </div>
			        </div>
			    </div>
</body>
</html>