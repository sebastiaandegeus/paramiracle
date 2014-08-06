Paramiracle
============

This WordPress plugin provides an API to set querystring params and load them easily.

## Travis CI

[![Build Status](https://travis-ci.org/sebastiaandegeus/paramiracle.svg?branch=master)](https://travis-ci.org/sebastiaandegeus/paramiracle)

[https://travis-ci.org/sebastiaandegeus/paramiracle](https://travis-ci.org/sebastiaandegeus/paramiracle)

## How it works

The API consists of a couple functions that can be called from your plugin or theme to set querystring params and load them with easy to use functions.


## API functions

This function registeres a querystring param that can be listened to later on:
```
register_param('my_lovely_param');
```

This function can be used to load a querystring param
```
param('my_lovely_param');
```

This function can be used to load a querystring param and print it right away
```
the_param('my_lovely_param');
```


## Fatal Error when plugin not activated

If any of the functions get called when the Paramiracle plugin is not activated it may cause a fatal error. There are a couple ways to prevent this.

* Put Paramiracle in mu-plugins to always have it activated and loaded.
* Wrap the `register_param()`, `param()` & `the_param()` calls inside `function_exists()` like so:

```
if ( function_exists( 'register_param' ) ) {
  register_param('my_lovely_param');
}
```


### Multiple values example

When building filters it can happen that you want a url like this:

`/?writer=shakespeare/dickens&theme=&beowulf/greek+mythology&year=1602`

Register the params:

```
  register_param('writer');
  register_param('theme');
  register_param('year');
```

Load the values when the above URL gets requested:

`param('writer')` will return an array with the values `shakespeare` & `dickens`

`param('theme')` will return an array with the values `beowulf` & `greek mythology`

`param('year')` will return a string with the value `1602`


