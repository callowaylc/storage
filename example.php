<?php
use Storage;
use Adapter;
use Connection;

// create a User class for mongo
$user = new Storage\User(new Adapter\Mongo)

// for sharded mysql 
$user = new Storage\User(new Adapter\ShardedMysql)

// for memcache cluster on ships
$user = new Storage\User(new Adapter\Memcache( new Connection\MemcacheShips ))

// get/set for either instance
$user->set( 'arbitrary-key', 'arbitrary-value' )
$user->get( 'arbitrary->key', function() {
  // perform some arbitrary to complex task and write-through
  // to underlying store
});

// with traditional mysql
$user = new Storage\Mysql( new Adapter\Mysql );

// retrieve record based on primary key
$user->get( 1 );

// retrieve records with #query method provided by Adapter/ShardedMysql#query
$user->query( $sql )


// WHATS MISSING 

// this model needs a convention/convenience oriented factory method
// to cutdown on instantiation of instancnes above; no one wants to 
// do this:

$user = new Storage\User(new Adapter\Memcache( new Connection\MemcacheShips ))

// many ways to solve this ^^^, it just takes a bit of creativity and cribbing
// existing design patterns