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

//print_r($items);


//$item = (new getItem())->get($con, 122778);

//print_r($item);


/*
##########################################################################
include('item.php');  // загружаем тестовый продукт


$product_id=(new CheckProduct(778))->check($dbh); //проверяем наличие продукта по полю 'sku'

if(!$product_id) // добавляем новый продук
{
    $item = new Item($test_item); // получаем экземляр класса единицы продукта
    $result =  (new AddProduct($dbh))->add($item);
    if($result===200){echo "Продукт успешно добавлен!";}else{print_r($result);}

} else {    // обновляем существующий продукт
    echo "Обновляем продукт";
}
*/







?>