<?php
if ( ! defined('BASEPATH')) exit('No se permite el acceso directo al script');
/*
 * InputHelper
 * 
 * autor; dgalicia;
 * 
 * 
 */

if ( ! function_exists('is_empty')) {
    function is_empty($value){
        return empty($value);
    }   
}

if ( ! function_exists('is_mail')) {
    function is_mail($value){
        $result = false;
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $result = true;
        }
        return $result;
    }   
}

if ( ! function_exists('is_phone')) {
    function is_phone($value){
        $reg = "#^\(?\d{2}\)?[\s\.-]?\d{4}[\s\.-]?\d{4}$#";
        return preg_match($reg, $value);
    }   
}

if ( ! function_exists('is_not_empty')) {
    function is_not_empty($value){
        return !empty($value);
    }   
}