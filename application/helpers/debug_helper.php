<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Dump helper. Functions to dump variables to the screen, in a nicley formatted manner.
 * @author Joost van Veen
 * @version 1.0
 */

function dump ($var, $label = 'Dump', $echo = TRUE){
    // Store dump in variable
    ob_start();
    var_dump($var);
    $output = ob_get_clean();

    // Add formatting
    $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
    $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';

    // Output
    if ($echo == TRUE) {
        echo $output;
    }
    else {
        return $output;
    }
}

function dump_exit($var, $label = 'Dump', $echo = TRUE) {
    dump ($var, $label, $echo);
    exit;
}

function dump_r ($var, $label = 'Dump', $echo = TRUE){
    // Store dump in variable
    ob_start();
    print_r($var);
    $output = ob_get_clean();

    // Add formatting
    $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
    $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';

    // Output
    if ($echo == TRUE) {
        echo $output;
    }
    else {
        return $output;
    }
}

function dump_r_exit($var, $label = 'Dump', $echo = TRUE) {
    dump_r ($var, $label, $echo);
    exit;
}