<?php
if ( ! defined('BASEPATH')) exit('No se permite el acceso directo al script');
/*
 * ExpectHelper
 * 
 * autor; dgalicia;
 * 
 * 
 */


if ( ! function_exists('is_null')) {
    function is_null($actual){
        return $actual === null;
    }   
}

if ( ! function_exists('is_not_null')) {
    function is_not_null($actual){
        return $actual !== null;
    }   
}

if ( ! function_exists('is_equal')) {
    function is_equal($actual, $expected){
        return $actual == $expected;
    }   
}

if ( ! function_exists('is_not_equal')) {
    function is_not_equal($actual, $expected){
        return $actual !== $expected;
    }   
}

if ( ! function_exists('strictEqual')) {
    function strictEqual($actual, $expected){
        return $actual === $expected;
    }   
}

if ( ! function_exists('is_true')) {
    function is_true($actual){
        return $actual === true;
    }   
}

if ( ! function_exists('is_false')) {
    function is_false($actual){
        return $actual === false;
    }   
}

if ( ! function_exists('is_not_true')) {
    function is_not_true($actual){
        return $actual !== true;
    }   
}

if ( ! function_exists('is_not_false')) {
    function is_not_false($actual){
        return $actual !== false;
    }   
}

if ( ! function_exists('greater_than')) {
    function greater_than($actual, $expected){
        return $actual > $expected;
    }   
}

if ( ! function_exists('less_than')) {
    function less_than($actual, $expected){
        return $actual < $expected;
    }   
}

if ( ! function_exists('less_than_or_equal')) {
    function less_than_or_equal($actual, $expected){
        return ($actual == $expected || $actual < $expected) ? true : false;
    }   
}

if ( ! function_exists('in_range')) {
    function in_range($value, $min, $max){
        return ($value >=$min && $value <= $max) ? true : false;
    }   
}
