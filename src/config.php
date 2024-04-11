<?php

namespace LuckyStar\Validation;


class Config
{



	protected static $rule_pattern = [
		 '/max_length/',
		 '/min_length/',
		 '/is_numeric/',
		 '/required/',
		 '/valid_email/',
		 '/valid_url/',
	];


	protected static $rule_pattern_check = [
		'/max_length/' => [
			'parameter' => true,
			'name' => 'max_length',
			'pattern' => '/max_length\[\d+\]/',
			'pattern_check' => '/max_length\[(\d+)\]/',
			'pattern_type' => 'numeric',
			'not_numeric_rule' => 'max_length can only be controlled numerically.example:max_length[5]'
		],
		'/min_length/' => [
			'parameter' => true,
			'name' => 'min_length',
			'pattern' => '/min_length\[\d+\]/',
			'pattern_check' => '/min_length\[(\d+)\]/',
			'pattern_type' => 'numeric',
			'not_numeric_rule' => 'min_length can only be controlled numerically. example:min_length[1]'
		],

	];



	protected static $error_messages = [
		'max_length' => 'The :field is too long',
		'min_length' => 'The :field is too short',
		'is_numeric' => 'The :field must be a number',
		'required' => 'The :field is required',
		'valid_email' => 'The :field must be a valid email',
		'valid_url' => 'The :field must be a valid url',
		'numeric' => 'The :field must be a number',
	];



}
