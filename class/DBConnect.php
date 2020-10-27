<?php
namespace App;
/**
 *
 */
class DBConnect
{
  private $pdo = new PDO('mysql:host=localhost;dbname=sowilo-db;charset=utf8', 'root', '', [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC ]);
  private $table;

  function __construct(string $table)
  {
    $this->table = $table
  }
}
