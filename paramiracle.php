<?php
/*
Plugin Name: Paramiracle
Version: 0.0.1
Description: Paramiracle provides a simple and safe API to set querystring params and read them out if set
Author: Sebastiaan de Geus
Author URI: https://github.com/sebastiaandegeus
Plugin URI: https://github.com/sebastiaandegeus/paramiracle
Text Domain: paramiracle
Domain Path: /languages
*/

class Paramiracle {
  private static $instance;

  public static $registered_params = array();

  private function __construct() {
    Paramiracle::filters();
    Paramiracle::actions();
  }

  public static function get() {
    if ( is_null( self::$instance ) )
      self::$instance = new self();

    return self::$instance;
  }

  public static function filters() {
    add_filter( 'query_vars', array( 'Paramiracle', 'query_vars' ) );
  }

  public static function actions() {
  }

  public static function get_param( $param ) {
    $var = get_query_var( $param );

    if ( empty( $var ) )
      return false;

    $vars   = explode( '/', $var );
    $values = array();

    foreach ( $vars as $key => $value ) {
      // XSS prevention, turned ON by default to keep you safe
      $value = stripslashes_deep( $value );
      $value = esc_html( $value );

      $values[] = $value;
    }

    if ( count( $values ) === 1 ) {
      return array_shift( $values );
    }

    return $values;
  }

  public static function query_vars( $vars ) {
    $vars = array_merge( $vars, Paramiracle::$registered_params );

    return $vars;
  }

  public static function register_param( $param ) {
    Paramiracle::$registered_params[] = $param;
  }
}

function the_param( $param ) {
  print Paramiracle::get_param( $param );
}

function param( $param ) {
  return Paramiracle::get_param( $param );
}

function register_param( $param ) {
  Paramiracle::register_param( $param );
}

Paramiracle::get();
