<?php

#rules => is_numeric,max_length[5],min_length[3]


require_once 'vendor/autoload.php';

$validation = new LuckyStar\Validation\Validate;


$rules = [
	'username' => [
		'rules' => 'max_length[100]|min_length[1]'
	],
	'password' => [
		'rules'  => 'max_length[10]|min_length[5]',
		'error_messages' => [
			'max_length' => 'Password is too long',
			'min_length' => 'Password is too short'
		]
	],
	'number' => [
		'rules' => 'is_numeric|max_length[8]|min_length[3]',
		'error_messages' => [
			'is_numeric' => ' Sayısal olmalı ...',
			'max_length' => 'Number is too long',
			'min_length' => 'Number is too short'
		]
	],
	'req' => [
		'rules' => 'required',
		'error_messages' => [
			'required' => 'This field is required'

		]
	],
	'email' => [
		'rules' => 'required|valid_email',
		'error_messages' => [
			'valid_email' => 'Email is not valid 1'
		]
	],
	'url' => [
		'rules' => 'required|valid_url',
		'error_messages' => [
			'valid_url' => 'URL is not valid'
		]
	],
	'ip' => [
		'rules' => 'required|valid_ip',
		'error_messages' => [
			'valid_ip' => 'IP is not valid'
		]
	],

	'number1' => [
		'rules' => 'min[5]|max[10]',
		'error_messages' => [
			'min' => 'Number is too small :number',
		]
	]
];


$_POST = ['username' => '12345', 'password' => '12345', 'number' => '12345', 'req' => 'req', 'email' => 'test@gmail.com', 'url' => 'https://www.google.com', 'ip' => '192.168.50.1', 'number1' => 4];



$checker = $validation->validateRule($_POST, $rules);




if ($checker){
	//no errors
	foreach ($validation->getErrors() as $error){
		echo $error . "<br>";
	}
}else{
	echo "No errors";
}





