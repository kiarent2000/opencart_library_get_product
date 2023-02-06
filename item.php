<?php
$test_item = array(
    'model' => 'model',
    'sku' => 778,
    'upc' => 'upc',
    'ean' => 'ean',
    'jan' => 'jan',
    'location' => 'location',
    'quantity' => 7,
    'stock_status_id' => 6,
    'image' => 'my_image',
    'manufacturer_id' => 1,
    'price' => 500,
    'product_category' => 412,
    
    'product_images' => array('image1', 'image2', 'image3'),
    
    'product_descriptions' => array(
        array(
        'language_id' => 1,
        'name' => 'name_rus',
        'description' => 'description_rus'
        ),
        array(
            'language_id' => 3,
            'name' => 'name_ua',
            'description' => 'description_ua'
        )
    ),
    
    'product_attributes' => array(
        array(
            'attribute_id'=>1,
            'language_id' => 1,
            'name' => 'name_rus',
            'text' => 'description_rus'
        ),
        array(
            'attribute_id'=>1,
            'language_id' => 3,
            'name' => 'name_ua',
            'text' => 'description_ua'
        )
    ),
    
    'product_filters' => array(1, 2),
    
    );

    ?>