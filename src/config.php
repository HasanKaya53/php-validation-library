<?php

namespace LuckyStar\Validation;


class Config
{



	private $rule_pattern = [
		 '/max_length/',
		 '/min_length/',
		 '/is_numeric/',
		 '/required/',
		 '/valid_email/',
		 '/valid_url/',
	];


	private $error_messages = [
		'max_length' => 'The :field is too long',
		'min_length' => 'The :field is too short',
		'is_numeric' => 'The :field must be a number',
		'required' => 'The :field is required',
		'valid_email' => 'The :field must be a valid email',
		'valid_url' => 'The :field must be a valid url',
	];



}
