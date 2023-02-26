<?php
class DB{
  public function connect() {
    $pdo = new PDO("mysql:dbname=lesson1; host=localhost;","root","");
    return $pdo;
  }
}