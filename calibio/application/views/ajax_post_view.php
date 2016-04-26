<html>
    <head>		
    <meta charset="UTF-8">
        <title>CodeIgniter ajax post</title>
       
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function(){
                $("#name").keyup(function(){
                    //alert($(this).val());
                    var user_name = $("input#name").val();
                    jQuery.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>" + "index.php/ajax_post_controller/esta",
                        dataType: 'json',
                        data: {name: user_name},
                        success: function(res) {
                            if (res)
                            {
                                // Show Entered Value
                                jQuery("div#estado").html(res.confimar);
                            }
                        }
                    });
                });
            })
        </script>

        <script type="text/javascript">
            // Ajax post
            $(document).ready(function() {
                // Este es para los .submit de un css $(".submit").click(function(event) {
                $("#submit").click(function (event) {
                    event.preventDefault();
                    var user_name = $("input#name").val();
                    var password = $("input#pwd").val();
                    jQuery.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>" + "index.php/ajax_post_controller/submit",
                        dataType: 'json',
                        data: {name: user_name, pwd: password},
                        success: function(res) {
                            if (res)
                            {
                                // Show Entered Value
                                jQuery("div#nombre").html(res.username);
                                jQuery("div#password").html(res.pwd);
                            }
                        }
                    });
                });
            });
        </script>  
    </head>
    <body> 

        <form action="hola.php" method="POST">
            <div class="panel panel-default">
              <div class="panel-body">
                <label>Nombre</label>
                <input class="form-control" type="text" id="name" name="name" autocomplete="off" required >
                <div id='estado'></div>
                <label>Password</label>
                <input class="form-control" type="text" id="pwd" name="pwd"  required >
                <br>
                <input type="submit" id="submit" name="submit" class="btn btn-success" >
              </div>
            </div>
        </form>

        <br>
        <br>
        <table class="table">
                <th>Nombre: </th>
                <th>Contraseña: </th>

                <tr>
                    <td><div id='nombre'></div></td>
                    <td><div id='password'> </div></td>
                </tr>
        </table>

    </body>
</html>

