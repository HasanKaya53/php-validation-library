<?php

namespace LuckyStar\Validation;


use LuckyStar\Validation\Config;

class Validate extends Config
{

	private static $errors = []; //for returning errors


	private static $rules = [];
	private static $fields = [];
	private static $errorMessages = [];

	private static $library_errors = [];


	private static function checkRules($data,$rule){
		//string match.. max_length match max_length[5]
		if(preg_match('/max_length/', $rule)){
			echo "var";

		}


		return $rule." <br>";
	}

	private static function getRules($rules) : array {

		foreach ($rules as $v => $r){
			if (is_array($r)){
				//post name => rules

				if(!isset($r['rules'])){
					self::$library_errors[] = $v.' Rules key is missing';
					return [];
				}


				self::$rules[$v] = explode('|', $r['rules']);

				if (isset($r['error_messages'])){
					self::$errorMessages[$v] = $r['error_messages'];
				}


			}else{
				self::$rules[$v] = explode('|', $r);


				if(sizeof(self::$rules[$v]) <= 1 && empty(self::$rules[$v][0])){
					self::$library_errors[] = $v.' Rules key is missing';
					return [];
				}
			}
		}

		return self::$rules;


	}

	public static function validateRule($data, $rules) : array {

		$errors = [];
		$rulesArray = self::getRules($rules);


		//check if rules array is empty
		if (empty($rulesArray)){
			return self::$library_errors;
		}





		//check rules..

		foreach(self::$rules as $key => $value){
			foreach($value as $k => $v) {
				//check if the rule has a parameter
				$rule = self::checkRules($data, $v);

				echo $rule;

			}

		}


		return [ self::$rules ,self::$errorMessages];
	}


}


