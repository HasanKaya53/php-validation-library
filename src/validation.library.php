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


	private static function checkRules($data,$rule) : bool{
		//string match.. max_length match max_length[5]
		foreach (self::$rule_pattern as $pattern){
			if (preg_match($pattern, $rule)){

				$rulePattern = self::$rule_pattern_check[$pattern];



				if (!preg_match($rulePattern['pattern'], $rule, $matches)){
					self::$library_errors[] = $rulePattern['not_numeric_rule'];
					return false;
				}

				if ($rulePattern['parameter']){

					preg_match($rulePattern['pattern_check'] ,$rule, $matches);

					if (!is_numeric($matches[1])){
						self::$library_errors[] = $rulePattern['not_numeric_rule'];
						return false;
					}



					if($rulePattern['pattern_type'] == "numeric"){
						//numeric check
						$numerical = $matches[1];

						$checkStatus = true;



						if ($rulePattern['name'] == 'max_length'){
							if (strlen($data['value']) > $numerical){
								$checkStatus = false;
							}
						}if ($rulePattern['name'] == 'min_length') {
							if (strlen($data['value']) < $numerical) {
								$checkStatus = false;
							}
						}



						if($checkStatus === false){
							self::$errors['status'] = 0;
							if (isset(self::$errorMessages[$data['name']]['min_length'])){
								self::$errors[] = self::$errorMessages[$data['name']]['min_length'];
							}else{
								self::$errors[] = str_replace(':field', $data['name'], self::$error_messages[$rulePattern['name']]);
							}
						}
					}
				}
			}
		}


		return true;
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
				$rule = self::checkRules(['name' => $key, 'value' => $data[$key]], $v);
				if (!$rule){
					return self::$library_errors;
				}
			}
		}



		return self::$errors;

	}



	public function getErrors(){
		return self::$errors;
	}


}


