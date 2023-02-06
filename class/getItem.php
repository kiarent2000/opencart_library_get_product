<?php
class getItem
{
    public function __construct($productid)
    {
        $this->product_id=$product_id;
    }

    public function get($dbh)
    {
        $sql = 'SELECT a.model, a.sku FROM `'. DB_PREFIX.'_product` WHERE `sku` = '.$this->productid;
        $sth = $dbh->query($sql);
        $result = $sth->fetch();
       
    }
}