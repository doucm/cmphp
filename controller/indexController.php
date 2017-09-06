<?php
 
class IndexController extends  BaseController{
    public function __construct(){
        
    }
    
    public function actionIndex(){
        $db = Cmdb::getInstance();
        
        $sql = "select id,goods_name,goods_num from goods where goods_num > 0";
        $result = $db->getResult($sql);
        
        echo "<ul>";
        foreach($result as $r){
            echo "<li><a href='/orders.php'>{$r->goods_name}---{$r->goods_num}</a></li>";
        }
        echo "</ul>";
    }
}