<?php

#rules => is_numeric,max_length[5],min_length[3]


require_once 'vendor/autoload.php';

$validation = new LuckyStar\Validation\Validate;


$rules = [
	'username' => 'max_length[5]|min_length[3]',
	'password' => [
		'rules'  => 'max_length[5]|min_length[3]',
		'error_messages' => [
			'max_length' => 'Password is too long',
			'min_length' => 'Password is too short'
		]
	]
];

$_POST = ['username' => '12345', 'password' => '12345'];

echo '<pre>';
echo print_r($validation->validateRule($_POST, $rules));

echo '</pre>';



