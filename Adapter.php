<?php
namespace Adapter;
use Connection\IConnection;

// Basic bridge pattern Adapter and Connection interfaces

// Adapter is concernered with get/set operations against an
// explicit storage engine
interface Adapter {  
  public function get( $key );
  public function set( $key, $value );
  public function set_type( $type )
}

abstract class Adapter implements IAdapter {
  protected $type = null;

  function __construct(  IConnection $connection ) {
    $this->connection = $adapter
  }
}


class ShardedMysql extends Adapter { 
  function __construct( IConnection $connection ) {
    parent::__construct( $connection );
    $this->client = new MysqlClient(
      $conneciton->host(),
      $connection->port
    );
  }
  public function get( $key ) {
    $this->client->query( 
      "select * from $this->type where id = $key "
    );
  }

  public function query( $sql ) { .. }
}

class Memcache extends Adapter { 
  protected $client = null;

  function __construct( IConnection $connection ) {
    $client = new Memcache(
      $connection->host(), 
      $connection->port()
    );
  }

  public function get( $key ) {
    return $this->client->get( $key );
  }
}
