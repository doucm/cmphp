<?php
$dsn = "mysql:dbname=demo;host=127.0.0.1";
$username = "root";
$password = "123456";

try{
    $dbh = new PDO($dsn,$username,$password);
    $dbh->beginTransaction();
    $sql = "select * from test where id > ?";
    $sth = $dbh->prepare($sql);
    $sth->execute(array(1));
    while($row = $sth->fetch(PDO::FETCH_OBJ)){
        print_r($row);
    }
    $dbh->commit();
}catch (PDOException $e){
    print_r($e);
}