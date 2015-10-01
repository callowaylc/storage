<?php
namespace Storage;
use Adapter\IAdapter;

// Basic bridge pattern between Storage interface and Adapter interface

// Storage is only concerned with get/set values on arbitrary store
interface IStorage {  
  public function get( $key, callable $write_through = null );
  
  // value can be "scalar" or callable
  public function set( $key, $value );
}

abstract class Storage implements IStorage {
  function __construct( IAdapter $adapter ) {
    $this->adapter = $adapter
    $this->adapter->set_type( $this );
  }

  public function __call( $name, array $arguments ) {
    // pass undefined methods on underlying domain  
    // specific functionality
    call_user_func_array( $this->adapter, $arguments );
  }

  public function get( $key, callable $write_through = null ) {
    $returns = null;

    // callable provides a write-through to underlying storage
    if (is_null($returns = $this->adapter->get( $key )) && 
        is_callable($write_through)) {
      $this->set( $key, $returns = $write_through() );

    }

    return $returns;
  }
}

// Concerned with user data against any arbitrary adapter; 
// using a by convention model will map to 'user' against
// backend stores
class User extends Storage { }
