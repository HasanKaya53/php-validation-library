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
		 '/valid_ip/',
		 '/min/',
		 '/max/',
	];


	protected static $rule_pattern_check = [
		'/max_length/' => [
			'parameter' => true,
			"parameter_type" => "numeric", //string or numeric
			'name' => 'max_length',
			'pattern' => '/max_length\[\d+\]/',
			'pattern_check' => '/max_length\[(\d+)\]/',
			'pattern_type' => 'numeric',
			'not_numeric_rule' => 'max_length can only be controlled numerically.example:max_length[5]'
		],
		'/min_length/' => [
			'parameter' => true,
			"parameter_type" => "numeric", //string or numeric
			'name' => 'min_length',
			'pattern' => '/min_length\[\d+\]/',
			'pattern_check' => '/min_length\[(\d+)\]/',
			'pattern_type' => 'numeric',
			'not_numeric_rule' => 'min_length can only be controlled numerically. example:min_length[1]'
		],
		'/is_numeric/' => [
			'parameter' => false,
			"parameter_type" => "string", //string or numeric
			'name' => 'is_numeric',
			'pattern' => '/is_numeric/',
			'pattern_check' => '/is_numeric/',
			'pattern_type' => 'string',
			'not_numeric_rule' => 'is_numeric is a string rule'
		],
		'/required/' => [
			'parameter' => false,
			"parameter_type" => "string", //string or numeric
			'name' => 'required',
			'pattern' => '/required/',
			'pattern_check' => '/required/',
			'pattern_type' => 'string',
			'not_numeric_rule' => 'required is a string rule'
		],
		'/valid_email/' => [
			'parameter' => false,
			"parameter_type" => "string", //string or numeric
			'name' => 'valid_email',
			'pattern' => '/valid_email/',
			'pattern_check' => '/valid_email/',
			'pattern_type' => 'string',
			'not_numeric_rule' => 'valid_email is a string rule'
		],
		'/valid_url/' => [
			'parameter' => false,
			"parameter_type" => "string", //string or numeric
			'name' => 'valid_url',
			'pattern' => '/valid_url/',
			'pattern_check' => '/valid_url/',
			'pattern_type' => 'string',
			'not_numeric_rule' => 'valid_url is a string rule'
		],
		'/valid_ip/' => [
			'parameter' => false,
			"parameter_type" => "string", //string or numeric
			'name' => 'valid_ip',
			'pattern' => '/valid_ip/',
			'pattern_check' => '/valid_ip/',
			'pattern_type' => 'string',
			'not_numeric_rule' => 'valid_ip is a string rule'
		],
		'/min/' => [
			'parameter' => true,
			"parameter_type" => "numeric", //string or numeric
			'name' => 'min',
			'pattern' => '/min\[\d+\]/',
			'pattern_check' => '/min\[(\d+)\]/',
			'pattern_type' => 'numeric',
			'not_numeric_rule' => 'min can only be controlled numerically. example:min[1]'
		],
		'/max/' => [
			'parameter' => true,
			"parameter_type" => "numeric", //string or numeric
			'name' => 'max',
			'pattern' => '/max\[\d+\]/',
			'pattern_check' => '/max\[(\d+)\]/',
			'pattern_type' => 'numeric',
			'not_numeric_rule' => 'max can only be controlled numerically. example:max[5]'
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
		'valid_ip' => 'The :field must be a valid ip address',
		'min' => 'The :field must be greater than :number',
		'max' => 'The :field must be less than :number',

	];



}
