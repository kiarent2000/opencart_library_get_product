<?php 
class AddProduct
{
    public function __construct($dbh)
    {
      $this->dbh=$dbh; 
    }    
    
    public function add(Item $item)
    {
        $errors=array();
        
        $product_id = $this->addProduct($item);

        if($product_id)
        {
            $descriptions = $this->addDescription($item, $product_id);
            if(!$descriptions){$errors[]=101;} // Ошибка добавления описания
            
            $category = $this->addCategory($item, $product_id);
            if(!$category){$errors[]=102;} // Ошибка добавления категории
            
            $store = $this->addProductToStore($product_id);
            if(!$store){$errors[]=103;} // Ошибка добавления магазина
            
            $layout = $this->addProductToLayout($product_id);
            if(!$layout){$errors[]=104;} // Ошибка добавления дизайна
            
            if($item->product_images)
            {
                $images = $this->addProductImages($item, $product_id);
                if(!$images){$errors[]=105;} // Ошибка добавления изображений
            }

            if($item->product_filters)
            {
                $filters = $this->addProductFilters($item, $product_id);
                if(!$filters){$errors[]=106;} // Ошибка добавления фильтров
            }

            if($item->product_attributes)
            {
                $attributes = $this->addProductAttributes($item, $product_id);
                if(!$attributes){$errors[]=107;} // Ошибка добавления атрибутов
            }
                        
            if(!$errors){return 200;}else{return $errors;}
           
        } else {
            $errors[]=100; //Ошибка добавления товара в таблицу oc_product
            return $errors;
        }
    }

    private function addProduct(Item $item) : int
    {
        $sql = 'INSERT INTO `'. DB_PREFIX.'_product` SET `model` = :model, `sku` = :sku, `upc` = :upc, `ean` = :ean, `jan` = :jan, `location` = :location, `quantity`='.$item->quantity.', `stock_status_id`='.$item->stock_status_id.', `image` = :image, `manufacturer_id`='.$item->manufacturer_id.', `price`='.$item->price.', `status`=1, `date_added`=NOW(), `date_modified`=NOW()';
        
        $sth = $this->dbh->prepare($sql);
        $sth->bindValue(':model', $item->model, PDO::PARAM_STR);
		$sth->bindValue(':sku', $item->sku, PDO::PARAM_STR);
        $sth->bindValue(':upc', $item->upc, PDO::PARAM_STR);
        $sth->bindValue(':ean', $item->ean, PDO::PARAM_STR);
        $sth->bindValue(':jan', $item->jan, PDO::PARAM_STR);
        $sth->bindValue(':location', $item->location, PDO::PARAM_STR);
        $sth->bindValue(':image', $item->image, PDO::PARAM_STR);
        $sth->execute();
		if($sth->errorInfo()[2]){ 
            return false;
        } else {
            return $this->dbh->lastInsertId();     
        }
    }

    private function addDescription(Item $item, int $product_id) : bool
    {
        $errors = false;

        foreach($item->product_descriptions as $product_description)
        {
            $sql = 'INSERT INTO `'. DB_PREFIX.'_product_description` SET `product_id` = '.$product_id.', `language_id` = '.$product_description['language_id'].', `name` = :name, `description` = :description'; 
        
            $sth = $this->dbh->prepare($sql);
            $sth->bindValue(':name', $product_description['name'], PDO::PARAM_STR);
            $sth->bindValue(':description', $product_description['description'], PDO::PARAM_STR);
            $sth->execute();
		    if($sth->errorInfo()[2]){$errors = true;}            
        }
        
        if($errors){return false;}else{return true;}        
    }

    private function addCategory(Item $item, int $product_id) : bool
    {
        $errors = false;
        $sql = 'INSERT INTO `'. DB_PREFIX.'_product_to_category` SET `product_id` = '.$product_id.', `category_id` = '.$item->product_category; 
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
		if($sth->errorInfo()[2]){return false;}else{return true;}   
    }

    private function addProductToStore(int $product_id) : bool
    {
        $errors = false;
        $sql = 'INSERT INTO `'. DB_PREFIX.'_product_to_store` SET `product_id` = '.$product_id.', `store_id` = '.STORE_ID; 
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
		if($sth->errorInfo()[2]){return false;}else{return true;}
    }

    private function addProductToLayout(int $product_id) : bool
    {
        $errors = false;
        $sql = 'INSERT INTO `'. DB_PREFIX.'_product_to_layout` SET `product_id` = '.$product_id.', `store_id` = '.STORE_ID.', `layout_id`='.LAYOUT_ID; 
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
		if($sth->errorInfo()[2]){return false;}else{return true;}
    }

    private function addProductImages(Item $item, int $product_id) : bool
    {
        $errors = false;

        foreach($item->product_images as $key=>$image)
        {
            $sql = 'INSERT INTO `'. DB_PREFIX.'_product_image` SET `sort_order` = '.$key.', `product_id` = '.$product_id.', `image` = :image';         
            $sth = $this->dbh->prepare($sql);
            $sth->bindValue(':image', $image, PDO::PARAM_STR);
            $sth->execute();
		    if($sth->errorInfo()[2]){$errors = true;}            
        }        
        if($errors){return false;}else{return true;} 
    }

    private function addProductFilters(Item $item, int $product_id) : bool
    {
        $errors = false;

        foreach($item->product_filters as $filter)
        {
            $sql = 'INSERT INTO `'. DB_PREFIX.'_product_filter` SET `filter_id` = '.$filter.', `product_id` = '.$product_id;         
            $sth = $this->dbh->prepare($sql);
            $sth->execute();
		    if($sth->errorInfo()[2]){$errors = true;}            
        }        
        if($errors){return false;}else{return true;} 
    }

    private function addProductAttributes(Item $item, int $product_id) : bool
    {
        $errors = false;

        foreach($item->product_attributes as $product_attribute)
        {
            $sql = 'INSERT INTO `'. DB_PREFIX.'_product_attribute` SET `product_id` = '.$product_id.', `attribute_id` = '.$product_attribute['attribute_id'].', `language_id` = '.$product_attribute['language_id'].', `text` = :text'; 
        
            $sth = $this->dbh->prepare($sql);
            $sth->bindValue(':text', $product_attribute['text'], PDO::PARAM_STR);
            $sth->execute();
		    if($sth->errorInfo()[2]){$errors = true;}            
        }
        
        if($errors){return false;}else{return true;}
    }
}