/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function(){
   
 $('NOMBRE').blur(function(){
             
    var name = $(this).val();           
   
      if(name==''){
         
        $('NOMBRE').addClass('error_jquery'); 
          $('#msg_name').html('El campo Nombre es requerido'); 
      }else{
         
          $('#NOMBRE').removeClass('error_jquery');
          $('#msg_name').html('');
      }
         
  });
  
   $('APELLIDO').blur(function(){
             
    var ape = $(this).val();           
   
      if(ape==''){
         
        $('APELLIDO').addClass('error_jquery'); 
          $('#msg_name').html('El campo Apellido es requerido'); 
      }else{
         
          $('#APELLIDO').removeClass('error_jquery');
          $('#msg_name').html('');
      }
         
  });
           
 $('#phone').blur(function(){
             
    var phone = $(this).val();    // colocamos el contenido del (div phone) en la variable phone       

    if(phone==''){
          $('#phone').addClass('error_jquery'); // añadimos una clase al div phone
          $('#msg_phone').html('El campo Teléfono es requerido'); // añadimos el mensaje
     }else if(isNaN(phone)){ // evalua si es númerico
                 
          $('#msg_phone').html(''); // dejamos en blanco el div para colocar el otro mensaje
          $('#msg_phone').html('El Teléfono debe ser númerico');        
         
      }else{
              // si no hay errores removemos la clase error_jquery y dejamos el div vacio
          $('#phone').removeClass('error_jquery');
          $('#msg_phone').html('');
         
      }
  });   

 $('#address').blur(function(){
             
    var address = $(this).val();           
   
      if(address==''){
         
        $('#address').addClass('error_jquery'); 
          $('#msg_address').html('El campo Ciudad y dirección es requerido'); 
      }else{
         
          $('#address').removeClass('error_jquery');
          $('#msg_address').html('');
      }
         
 });
     
// Método que verifica si el email es válido     
function ValidEmail(email) {
         var verify = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
         return verify.test(email);
    }     

         
 $('#email').blur(function(){
       
    var email = $(this).val();   
   
 if(email==''){
       
        $('#email').addClass('error_jquery'); 
          $('#msg_email').html('El campo Email es requerido'); 
       
     }else{
       
        if(ValidEmail(email)){
        
         $('#email').removeClass('error_jquery');
          $('#msg_email').html('');
        
     }else{
        
        $('#email').addClass('error_jquery'); 
          $('#msg_email').html('El Email no es válido');
     } 
       
    }
     
 });   
              
});