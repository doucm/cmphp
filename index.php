<!DOCTYPE HTML>
<html lang="zh-cmn-Hans"> 
<head>
<title>秒杀产品</title>
</head>
<body>
秒杀产品
<?php 
define('BASE_DIR', dirname(__FILE__));
define('DEBUG', true);
// echo "<pre>";
// print_r($_SERVER);
// print_r(pathinfo($_SERVER['REQUEST_URI']));
// echo "</pre>";

$info = pathinfo($_SERVER['REQUEST_URI']);
$controller = substr($info['dirname'], strrpos($info['dirname'], "/")+1);
$model = substr($info['basename'], 0,strpos($info['basename'], "?")); 
$params = $_SERVER['QUERY_STRING'];
spl_autoload_register(function ($controller) {
    include BASE_DIR.'/core/controller.php';
    include BASE_DIR.'/controller/'.$controller.'.php';
});


// $url = BASE_DIR.'/controller/'.$controller.'Controller.php';
// require($url);
new OrderController();
?>
</body>
</html>
