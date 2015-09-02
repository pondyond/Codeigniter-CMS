<?php defined('BASEPATH') OR exit('No direct script access allowed');

function validate($messages){
	echo
	"
	<div class='alert alert-block alert-danger'>
		<button data-dismiss='alert' class='close' type='button'><i class='icon-remove'></i></button>
		<p><strong><i class='icon-ok'></i>&nbsp; Please correct the errors ...! </strong></p>
		<ul>".$messages['message']."</ul>
	</div>
	";
}

function messages($messages){
	echo
	"
	<div class='alert alert-block alert-".$messages['type']."'>
		<button data-dismiss='alert' class='close' type='button'><i class='icon-remove'></i></button>
		<p><strong><i class='icon-ok'></i>&nbsp;".$messages['title']."</strong>&nbsp; &nbsp; ".$messages['message']."&nbsp; &nbsp;</p>
	</div>
	";
}

function status_button($path,$status,$id,$path_prefix=''){
	if($status == 1){
		echo "<a href='".base_url().$path.$path_prefix."deactivate/".$id."'><button class='btn btn-minier btn-success'>&nbsp;Active&nbsp;&nbsp;</button></a>";
	}
	if($status == 0){
		echo "<a href='".base_url().$path.$path_prefix."activate/".$id."'><button class='btn btn-minier btn-green'>Inactive</button></a>";
	}
}