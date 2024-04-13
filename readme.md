
<h3> Rules List </h3>

- required
- max_length
- min_length
- is_numeric
- is_email [coming soon]
- is_url [coming soon]
- is_ip [coming soon]


### set rules...

```php
$rules = [
    'username' => 'rules'...
];

//or ..

$rules = [
    'username' => [
        'rules' => 'required|max_length[10]|min_length[5]',
        'error_messages' => [
            'required' => 'This field is required',
            'max_length' => 'Username is too long',
            'min_length' => 'Username is too short'
        ]
    ]
];


$checker = $validation->validateRule($_POST, $rules);
```





<h3> How to install and run the project </h3>

### Step 1: Install Composer
```bash
composer require luckystar/validation
```

### Step 2: First, require the composer autoloader in your script
```php
<?php
require_once 'vendor/autoload.php';

$validation = new LuckyStar\Validation\Validate;

// Add Rules
```

### Step 3: Add Rules
```php
$rules = [
	'username' => [
		'rules' => 'max_length[3]|min_length[1]'
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
	]
];

$_POST = ['username' => '12345', 'password' => '12345', 'number' => '123sa45'];



$checker = $validation->validateRule($_POST, $rules);

if ($checker){
	//no errors
	foreach ($validation->getErrors() as $error){
		echo $error . "<br>";
	}
}else{
	echo "No errors";
}


```