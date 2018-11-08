<?php
// get mysql connect
function connect(){
 // return pdo
 $dsn = 'mysql:dbname=my_test;host=172.17.0.3';
 $user = 'root';
 $password = 'root123'; 
 try {
    $dbh = new PDO($dsn, $user, $password);
    return $dbh;
 } catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
 } 
}


