salutation [![Build status](https://api.travis-ci.org/smhg/salutation-php.png)](https://travis-ci.org/smhg/salutation-php)
=============
Generates a salutation based on predefined formats.

## Features
* Locale aware formatting
* Title based formatting
* Nameless greeting

## Installation
```bash
composer require smhg/salutation
```

## Usage
```php
use Salutation;

$salutation = new Salutation('nl_BE', array(
	array(
		'first' => 'Jan',
		'last' => 'Jansens'
	),
	array(
		'title' => 'Dr.',
		'first' => 'Peter',
		'last' => 'Peters'
	)
));

echo $salutation;
// Beste Jan, Dr. Peters,
```
