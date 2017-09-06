<?php

class Cmdb {
    private   $dsn;
    private   $username;
    private   $password;
    private   $dbh;
    private   static $instance;
    
    private function __construct($config){
        $this->dsn = $config['dsn'];
        $this->username =  $config['username'];
        $this->password =  $config['password'];
        try{
            $this->dbh = new PDO($this->dsn,$this->username,$this->password);
            
        }catch(PDOException $e){
            if (DEBUG ){
                print_r($e->getMessage());
            }
            
        }
    }
    
    public static  function getInstance($config=null){
        if ( self::$instance == null ){
            if ($config == null ){
                $config = parse_ini_file(BASE_DIR."/config/database.php");
            }
            self::$instance = new Cmdb($config);
        } 
        
        return self::$instance;
    }
    
    public function getResult($sql,$params = null,$trans=false){
        $trans ? $this->dbh->beginTransaction() : "";
        
        $result = [];
        try{
            $sth = $this->dbh->prepare($sql);
            $sth->execute($params);
            while($row = $sth->fetch(PDO::FETCH_OBJ)){
                $result[] = $row;
            }
        }catch(PDOException $e){
            $trans ? $this->dbh->rollBack():"";
        }
        $trans ? $this->dbh->commit() : "";
        
        return $result;
            
    }
    
    public function getOne($sql,$params = null,$trans=false){
        $trans ? $this->dbh->beginTransaction() : "";
        try{
            $sth = $this->dbh->prepare($sql);
            $sth->execute($params);
            $row = $sth->fetch(PDO::FETCH_OBJ);
        }catch(PDOException $e){
            $trans ? $this->dbh->rollBack():"";
        }
       
        $trans ? $this->dbh->commit() : "";
        
        return $row;
    }
    
    public function beginTransaction(){
        $this->dbh->beginTransaction();
    }
    
    public function rollBack(){
        $this->dbh->rollBack();
    }
    
    public function commit(){
        $this->dbh->commit();
    }
}
 
