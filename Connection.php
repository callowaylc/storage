<?php
namespace Connection;

// Connection is concerned with encapsulating conneciton details
// against specific storage backend
interface IConnection { }

abstract class Connection implements IConnection { }

class Mysql extends Connection { }
class Mongo extends Connection { }
class ImageSizeMemcache extends Connection { }