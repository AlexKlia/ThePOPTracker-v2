<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('cssUrl'))
{
    function cssUrl($name)
    {
        return base_url() . 'assets/css/' . $name . '.css';
    }
}

if ( ! function_exists('jsUrl'))
{
    function jsUrl($name)
    {
        return base_url() . 'assets/js/' . $name . '.js';
    }
}

if ( ! function_exists('imgUrl'))
{
    function imgUrl($name)
    {
        return base_url() . 'assets/imgs/' . $name;
    }
}

if ( ! function_exists('img'))
{
    function img($name, $alt = '', $class='')
    {
        $img = '<img src="' . imgUrl($name) . '" alt="' . $alt . '"';
        $img .= (!empty($class)) ? ' class="'.$class.'" />' : ' />';

        return $img;
    }
}