# Salutation
Salutation generator

## Features
* Locale aware formatting
* Title based formatting
* Nameless greeting

## Installation
```bash
composer require smhg\salutation
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
```
Result:
```bash
Beste Jan, Dr. Peters,
```