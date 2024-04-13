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


			if (preg_match_all($pattern, $rule)){
				//echo 'eşleşti:'.$pattern.' '.$rule.'<br>';
				$rulePattern = self::$rule_pattern_check[$pattern];
				//echo $rulePattern['pattern']." => ".$rule.'<br>';

				$numerical = 0;
				$checkStatus = true;

				//echo $rulePattern['pattern']." => ".$rule.'<br>';
				//check if the rule is numeric
				if (!preg_match($rulePattern['pattern'], $rule, $matches)){
					//echo "sorun var..".'<br>';
					self::$library_errors[] = $rulePattern['not_numeric_rule'];
					return false;
				}

				if ($rulePattern['parameter']){
					preg_match($rulePattern['pattern_check'] ,$rule, $matches);
					if($rulePattern['parameter_type'] == "numeric"){
						if (!is_numeric($matches[1])){
							self::$library_errors[] = $rulePattern['not_numeric_rule'];
							return false;
						}
					}
					$numerical = $matches[1];
				}


				if($rulePattern['pattern_type'] == "numeric"){
					//numeric check


					if ($rulePattern['name'] == 'max_length'){
						if (strlen($data['value']) > $numerical && $numerical > 0){
							$checkStatus = false;
						}
					}else if ($rulePattern['name'] == 'min_length') {
						if (strlen($data['value']) < $numerical && $numerical > 0) {
							$checkStatus = false;
						}
					}
					else if ($rulePattern['name'] == 'min'){
						if ($data['value'] < $numerical){
							$checkStatus = false;
						}
					}
					else if ($rulePattern['name'] == 'max'){
						if ($data['value'] > $numerical){
							$checkStatus = false;
						}
					}


				}
				else if($rulePattern['pattern_type'] == "string"){
					//string check
					if ($rulePattern['name'] == 'is_numeric'){
						if (!is_numeric($data['value'])){
							$checkStatus = false;
						}
					}
					else if ($rulePattern['name'] == 'required'){
						if (empty($data['value'])){
							$checkStatus = false;
						}
					}
					else if ($rulePattern['name'] == 'valid_email'){
						if (!filter_var($data['value'], FILTER_VALIDATE_EMAIL)){
							$checkStatus = false;
						}
					}
					else if ($rulePattern['name'] == 'valid_url'){
						if (!filter_var($data['value'], FILTER_VALIDATE_URL)){
							$checkStatus = false;
						}
					}
					else if ($rulePattern['name'] == 'valid_ip'){
						if (!filter_var($data['value'], FILTER_VALIDATE_IP)){
							$checkStatus = false;
						}
					}


				}


					if($checkStatus === false){
						//self::$errors['status'] = 0;
						if (isset(self::$errorMessages[$data['name']][$rulePattern['name']])){
							self::$errors[] = self::$errorMessages[$data['name']][$rulePattern['name']];
						}else{

							self::$error_messages[$rulePattern['name'] ] = str_replace(':field', $data['name'], self::$error_messages[$rulePattern['name']]);

							if($rulePattern['pattern_type'] == "numeric"){
								self::$error_messages[$rulePattern['name'] ] = str_replace(':number', $numerical, self::$error_messages[$rulePattern['name']]);
							}



							self::$errors[] = self::$error_messages[$rulePattern['name']];
						}
					}

					break;


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
				$rule = self::checkRules(['name' => $key, 'value' => ($data[$key] ?? null)] , $v);
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


