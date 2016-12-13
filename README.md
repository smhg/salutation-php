salutation [![Build status](https://api.travis-ci.org/smhg/salutation-php.png)](https://travis-ci.org/smhg/salutation-php)
=============
Generates a salutation based on predefined formats.

## Use case
In e-mails, dashboards and others, you often want to start with a personalised greeting. This might be to multiple people, of which you might have complete, partial or no names available. Some might have titles which are to be used when adressing them. And things might differ across locales.

As an example, you might need to greet a list of 3 users: one is a regular person (Joe Bloggs), one is a company without a contact's name (ACME) and one a physician/doctor (Jane Smith).
First name concatenation would lead to:
```
Dear Joe, , Jane,
```
While what you want is:
```
Dear Joe, Dr. Smith,
```

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

## Features
* Locale aware formatting
* Title based formatting
* Nameless greeting
