<?php

#rules => is_numeric,max_length[5],min_length[3]


require_once 'vendor/autoload.php';

$validation = new LuckyStar\Validation\Validate;


$rules = [
	'username' => [
		'rules' => 'max_length[10]|min_length[5]'
	],
	'password' => [
		'rules'  => 'max_length[10]|min_length[5]',
		'error_messages' => [
			'max_length' => 'Password is too long',
			'min_length' => 'Password is too short'
		]
	]
];

$_POST = ['username' => '12345', 'password' => '12345'];



$checker = $validation->validateRule($_POST, $rules);


if ($checker){
	//no errors
	echo "No errors";
}else{
	print_r($validation->getErrors());
}





