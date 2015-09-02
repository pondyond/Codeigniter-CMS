<?php defined('BASEPATH') OR exit('No direct script access allowed');

function logdb($rid){	
	global $CI;
	$uid = 1; //$CI->session->userdata('uid');
	return 1; //$CI->general_model->logdb_save($rid,$uid);
}