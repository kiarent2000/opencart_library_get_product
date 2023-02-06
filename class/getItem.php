<?php
class getItem
{
    public function __construct($product_id)
    {
        $this->product_id=$product_id;
    }

    public function get($dbh)
    {
        $sql = 'SELECT a.model, a.sku, a.jan, a.quantity, a.stock_status_id, a.image, a.manufacturer_id, a.price, a.date_modified FROM '. DB_PREFIX.'_product a WHERE `product_id` = '.$this->product_id;
        $sth = $dbh->query($sql);
        $result = $sth->fetch();
       
        return $result;
    }
}