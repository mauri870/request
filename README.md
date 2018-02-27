# Laravel 5 Extended Requests

Package that exteds the Laravel 5 FormRequest class to easily create custom validation rules.


## Quick start

### Required setup

In the `require` key of `composer.json` file add the following

```
"mauri870/request": "dev-master"
```

Run the Composer update comand

    $ composer update

## How to use

Make your request extends the ```Mauri870\Request\Request``` class.

```php
use Mauri870\Request\Request;

class MyRequest extends Request {
```

Create your rules function with your custom rule:

```php
public function rules()
{
  	return [
       	'my-rule' => 'custom'
    ];
}
```

Create a function with the format ```validate<your_custom_rule>```, like this:

```php
public function validateCustom($attribute, $value, $params)
{
    return $value == 'custom';
}
```

Do not forget to put a message for this new rule. It can be in the ```messages``` function of the request or in the ```validation``` of the lang files.


```php
public fucnction messages()
{
	return [
    	'custom' => 'My custom message'
	];
}
```

And that is it HAHA! :)
Please enjoy!