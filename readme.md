
<h1>Validation library </h1>

<p>This is a lightweight PHP validation library designed to simplify the process of validating input data in web applications. It provides a set of commonly used validation rules such as required fields, maximum and minimum lengths, numeric checks, and more. With easy integration and customizable error messages, it streamlines the validation process, ensuring data integrity and user-friendly error handling.</p>



<h3> Rules List </h3>

<table>

<tr>
    <th>Rule</th>
    <th>Description</th>
    <th>Example </th>
</tr>

<tr>
    <td>required</td>
    <td>This field is required</td>
    <td>required</td>
</tr>

<tr>
    <td>max_length</td>
    <td>This field must be less than {max_length} characters long</td>
    <td>max_length[10]</td>
</tr>

<tr>
    <td>min_length</td>
    <td>This field must be at least {min_length} characters long</td>
    <td>min_length[5]</td>
</tr>

<tr>
    <td>is_numeric</td>
    <td>This field must contain only numbers</td>
    <td>is_numeric</td>
</tr>

<tr>
    <td>valid_email </td>
    <td>This field must contain a valid email address</td>
    <td>valid_email</td>
</tr>

<tr>
    <td>valid_url </td>
    <td>This field must contain a valid URL</td>
    <td>valid_url</td>
</tr>

<tr>
    <td>valid_ip  [coming soon] </td>
    <td>This field must contain a valid IP address</td>
    <td>valid_ip</td>
</tr>

</table>

<h3> Other Parameters </h3>
<table>

<tr>
    <th>Parameter</th>
    <th>Description</th>
    <th>Example </th>
</tr>

<tr>
    <td>error_messages</td>
    <td>Custom error messages</td>
    <td>error_messages => ['required' => 'This field is required']</td>
</tr>
</table>





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

### Step 3: Add Rules and Validate (example)
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