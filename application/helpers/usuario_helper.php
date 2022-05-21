<?php
if ( ! defined('BASEPATH')) exit('No se permite el acceso directo al script');
/*
 * InputHelper
 * 
 * autor; dgalicia;
 * 
 * 
 */

if ( ! function_exists('es_activo')) {
    function es_activo($usuario){
        return ($usuario->estatus === Estatus::ACTIVO) ? true : false;
    }   
}

if ( ! function_exists('es_inactivo')) {
    function es_inactivo($usuario){
        return ($usuario->estatus === Estatus::INACTIVO) ? true : false;
    }   
}
