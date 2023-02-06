<?php 
declare(strict_types=1);

spl_autoload_register(function ($class) {
    include __DIR__ . '/class/'.$class.'.php';
});

$it=new getItem();

include(__DIR__.'/config.php');
$con = (new DB())->connect();


$items = $it->getAll($con);

foreach($items as $item)
{
    $product = $it->get($con, $item['product_id']);
    echo $item['product_id'];
    print_r($product);
}

?>