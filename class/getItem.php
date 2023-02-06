<?php
class getItem
{
    public function get($db, $product_id)
    {
        $sql = 'SELECT model, a.sku, a.jan, a.quantity, a.stock_status_id, a.image, a.manufacturer_id, a.price, a.date_modified, b.name, b.description, (SELECT d.category_id FROM '. DB_PREFIX.'_product_to_category d WHERE  a.product_id=d.product_id) as category,
        (SELECT f.name  FROM '. DB_PREFIX.'_category_description f WHERE f.category_id=category AND f.language_id=3) as category_name,
        (SELECT e.name  FROM '. DB_PREFIX.'_manufacturer e WHERE e.manufacturer_id=a.manufacturer_id) as manufacturer
        FROM '. DB_PREFIX.'_product a LEFT JOIN '. DB_PREFIX.'_product_description b ON b.product_id=a.product_id AND b.language_id=3
        WHERE a.product_id = '.$product_id;
       
		$result = mysqli_query($db, $sql);
		$row = mysqli_fetch_assoc($result);
		return $row;
    }

    public function getAll($db)
    {
        $sql = 'SELECT  `product_id`    
        FROM '. DB_PREFIX.'_product ORDER BY `product_id` DESC LIMIT 10';
		$result = mysqli_query($db, $sql);
		while( $row = mysqli_fetch_assoc($result)){$arr[] = $row;}
		return $arr;
    }
}