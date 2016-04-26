<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('hola'))
{
    function hola()
    {
        $derechos = "Holalallala";
        return $derechos;
    }   
}


if ( ! function_exists('encryptIt'))
{
    function encryptIt( $q ) {
        $cryptKey  = '@.asdD98b○\54A';
        $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
        return( limpiarUrl($q) );
    }   
}

if ( ! function_exists('strToHex'))
{
    function strToHex($string){
        $hex='';
        for ($i=0; $i < strlen($string); $i++){
            $hex .= dechex(ord($string[$i]));
        }
        return $hex;
    }  
}


if ( ! function_exists('decryptIt'))
{
    function decryptIt( $q ) {
        $cryptKey  = '@.asdD98b○\54A';
        //$q = hexToStr($q);
        $qDecoded  = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
        return( limpiarUrl($q) );
    } 
}

if ( ! function_exists('hexToStr'))
{
    function hexToStr($hex){
        $string='';
        for ($i=0; $i < strlen($hex)-1; $i+=2){
            $string .= chr(hexdec($hex[$i].$hex[$i+1]));
        }
        return $string;
    }
}

if ( ! function_exists('limpiarUrl'))
{
    function limpiarUrl($articulo)
    {
        $articulo = str_replace('%C3%A1','á',$articulo);
        $articulo = str_replace('%C3%A9','é',$articulo);
        $articulo = str_replace('%C3%AD','í',$articulo);
        $articulo = str_replace('%C3%B3','ó',$articulo);
        $articulo = str_replace('%C3%BA','ú',$articulo);

        $articulo = str_replace('%20',' ',$articulo);

        $articulo = str_replace('%C3%81','Á',$articulo);
        $articulo = str_replace('%C3%89','É',$articulo);
        $articulo = str_replace('%C3%8D','Í',$articulo);
        $articulo = str_replace('%C3%93','Ó',$articulo);
        $articulo = str_replace('%C3%9A','Ú',$articulo);
        
        $articulo = str_replace('?','',$articulo);
        return $articulo;
    }   
}

if ( ! function_exists('limpiarHtml'))
{
    function limpiarHtml($contenido)
    {
        $contenido = str_replace('<','&lt;',$contenido);
        $contenido = str_replace('>','&gt;',$contenido);
        $contenido = str_replace('&lt;code&gt;','<code>',$contenido);
        $contenido = str_replace('&lt;/code&gt;','</code>',$contenido);

        return $contenido;
    }   
}



