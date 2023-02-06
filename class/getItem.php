<?php
class getItem
{
    public $product_id;
    
    public function __construct($product_id)
    {
        $this->product_id=$product_id;
    }

    public function get($db)
    {
        $sql = 'SELECT model, a.sku, a.jan, a.quantity, a.stock_status_id, a.image, a.manufacturer_id, a.price, a.date_modified, b.name, b.description FROM '. DB_PREFIX.'_product a LEFT JOIN '. DB_PREFIX.'_product_description b ON b.product_id=a.product_id AND b.language_id=3
         WHERE a.product_id = '.$this->product_id;
        
        echo $sql;

		$result = mysqli_query($db, $sql);
		$row = mysqli_fetch_assoc($result);
		return $row;
    }
}