<?php
 
class IndexController extends  BaseController{
    public function __construct(){
        $db = Cmdb::getInstance();
        
        $sql = "select id,goods_name,goods_num from goods";
        $result = $db->getResult($sql);
        
        echo "<ul>";
        foreach($result as $r){
            echo "<li><a href='/orders.php'>{$r->goods_name}---{$r->goods_num}</a></li>";
        }
        echo "</ul>";
    }
    
    public function actionGetProduct(){
        
    }
}