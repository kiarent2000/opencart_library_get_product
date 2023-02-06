<?php
class Item
{
    public function __construct(array $item)
    {
        $this->model = $item['model'];
        $this->sku = $item['sku'];
        $this->upc = $item['upc'];
        $this->ean = $item['ean'];
        $this->jan = $item['jan'];
        $this->location = $item['location'];
        $this->quantity = $item['quantity'];
        $this->stock_status_id = $item['stock_status_id'];
        $this->image = $item['image'];
        $this->manufacturer_id = $item['manufacturer_id'];
        $this->price = $item['price'];
        $this->product_category = $item['product_category'];
        $this->product_images = $item['product_images'];
        $this->product_descriptions = $item['product_descriptions'];
        $this->product_attributes = $item['product_attributes'];
        $this->product_filters = $item['product_filters'];
    }
}

?>