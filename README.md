Laravel 5 IP Blocker
===================

Simple and easy to configure laravel ip blocker

for [Laravel 4](//github.com/cresjie/ip-blocker/tree/master)

----------


Installation via Composer
-------------

Add this to your composer.json file, in the require object:

```javascript
 "cresjie/ip-blocker": "v1.2.0.0"
```
After that, run composer install to install the package.

Add the service provider to app/config/app.php for laravel 4 and config/app.php for laravel 5, within the providers array.
```php
 'providers' => array(
	...
	Cresjie\IpBlocker\IpBlockerServiceProvider::class,
)
```
Configuration
-------------
Publish the default config file to your application so you can make modifications.

```
$ php artisan vendor:publish
```
Add your block IP's to the configuration file:

```
 [L5 root]/config/cresjie/block-ip.php
```

Handling/Custom View
-------------

if the IP was blocked, it would throw Cresjie\IpBlocker\IpBlockerException.
you could create a view by just handling the exception like this:


#laravel 5

```php
// app/Exceptions/Handler.php

public function render($request, Exception $e)
{
	switch($e){
		case ($e instanceof \Cresjie\IpBlocker\IpBlockerException):
			return response()->view('view-path');
			break;
		default:
			return parent::render($request, $e);

	}

    return parent::render($request, $e);
}

```
