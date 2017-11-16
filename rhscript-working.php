<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'dbconnect.php';
//
//execute the SQL query and return records
//$result = mysql_query("SELECT * FROM products");
//joint tables
//$sql = "SELECT `Sheet1`.*,`products`.*,`categories`.* FROM Sheet1 , `products` , `categories` where products.part_number=Sheet1.exppartno";
//$sql2="SELECT `products`.*,`categories`.*,`product_images`.* FROM products , `categories` , `product_images` WHERE products.part_number=product_images.exppartno AND products.category_id=categories.id";
//joined three tables
//$sql3="SELECT `categories`.*,`products`.* ,product_images.* FROM categories , `products`,product_images WHERE products.category_id=categories.id AND product_images.exppartno=products.part_number";
$sql4 = mysql_query("SELECT `categories`.*, `masterappfinaldata3`.* FROM `masterappfinaldata3`,categories WHERE `masterappfinaldata3`.`Category ID`= categories.id");

$attribute='<div class="row">
<div class="col-md-6 col-sm-6 "><button class="btn btn-default pull-right" onclick="location.href=\'\dealers\'" type="button">find one near you</button></div>
<div class="col-md-6 col-sm-6"><button class="btn btn-default" onclick="location.href=\'#\'" type="button">installation guide</button></div>
</div>';

//echo htmlspecialchars($attribute);
$nCounter=0;
//echo $sql4;
while ($row = mysql_fetch_array($sql4)) {
    echo $nCounter;
   // print_r($row);
   // die('got it');
if ($nCounter > 1 )
{
    die('on row addee');
}
$sql5=mysql_query("INSERT INTO `ranchhand-orignal`.`catalog_product_20160922_200847`
(`sku`,
 `store_view_code`,
 `attribute_set_code`,
 `product_type`,
 `categories`, 
 `product_websites`, 
 `name`, 
 `description`,
 `short_description`, 
 `weight`, 
 `product_online`, 
 `tax_class_name`, 
 `visibility`, 
 `price`, 
 `special_price`, 
 `special_price_from_date`,
 `special_price_to_date`, 
 `url_key`, 
 `meta_title`, 
 `meta_keywords`, 
 `meta_description`, 
 `base_image`, 
 `base_image_label`, 
 `small_image`,
 `small_image_label`, 
 `thumbnail_image`, 
 `thumbnail_image_label`, 
 `swatch_image`, 
 `swatch_image_label`, 
 `created_at`, 
 `updated_at`, 
 `new_from_date`, 
 `new_to_date`, 
 `display_product_options_in`, 
 `map_price`,
 `msrp_price`, 
 `map_enabled`, 
 `gift_message_available`, 
 `custom_design`, 
 `custom_design_from`, 
 `custom_design_to`, 
 `custom_layout_update`, 
 `page_layout`, 
 `product_options_container`,
 `msrp_display_actual_price_type`,
 `country_of_manufacture`, 
 `additional_attributes`, 
 `qty`, 
 `out_of_stock_qty`,
 `use_config_min_qty`, 
 `is_qty_decimal`, 
 `allow_backorders`,
 `use_config_backorders`, 
 `min_cart_qty`, 
 `use_config_min_sale_qty`, 
 `max_cart_qty`, 
 `use_config_max_sale_qty`,
 `is_in_stock`,
 `notify_on_stock_below`, 
 `use_config_notify_stock_qty`, 
 `manage_stock`, 
 `use_config_manage_stock`,
 `use_config_qty_increments`, 
 `qty_increments`, 
 `use_config_enable_qty_inc`, 
 `enable_qty_increments`, 
 `is_decimal_divided`, 
 `website_id`, 
 `related_skus`, 
 `related_position`, 
 `crosssell_skus`, 
 `crosssell_position`, 
 `upsell_skus`, 
 `upsell_position`, 
 `additional_images`, 
 `additional_image_labels`, 
 `hide_from_product_page`, 
 `bundle_price_type`, 
 `bundle_sku_type`, 
 `bundle_price_view`, 
 `bundle_weight_type`, 
 `bundle_values`, 
 `bundle_shipment_type`,
 `configurable_variations`,
 `configurable_variation_labels`,
 `associated_skus`
 )
 VALUES ('".$row['Part_Number']
        ."','default',
        'Bumper', 
        'configurable', 
        '".$row['name']
        ."','base', 
   '".$row['Description']
 ."','long description', 
 'short description',
 '".$row['Net_Wt'] 
 ."',1,
 '0',
 'Catalog, Search',
 '".$row['MSRP'] 
  ."',NULL, 
 NULL, 
 NULL, 
 NULL, 
 NULL, 
 NULL, 
 NULL,
 NULL, 
 NULL, 
 NULL, 
 NULL, 
 NULL, 
 NULL, 
 NULL, 
 NULL, 
 NULL, 
 NULL, 
 NULL, 
 NULL, 
 'Block after Info Column',
 NULL,
 NULL,
 'Use config',
 NULL, 
 NULL, 
 NULL, 
 NULL, 
 NULL, 
 NULL, 
 NULL, 
 NULL, 
  NULL, 
 'buttons=here are buttuns, camera_ready=".$row['camera_ready'].",color=".$row['color'].",factory_receiver=".$row['FR'].",fog_lights=".$row['fog_lights'].",gross_wt=".$row['gross_wt'].",height=".$row['Height'].",length=".$row['Length'].",make=".$row['Make'].",model=".$row['Model'].",net_wt=".$row['net_wt'].",part_number=".$row['Part_Number'].",product=".$row['Part_Number'].",sesnser_ready=".$row['sesnser_ready'].",tow_hooks=".$row['TH'].",upc_code=".$row['UPC_Code'].",width=".$row['Width'].",winch_ready=".$row['winch_ready'].",year=".$row['Year'].",Jobber=".$row['Jobber'].",MSRP=".$row['MSRP'].",Online=".$row['Online']."'
 ,1,
 0,
 0,
 0,
 0,
 NULL, 
 100,
 1,
 100,
 1,
 1, 
 1,
 1, 
 1,
 1, 
 1, 
 0, 
 0, 
 0, 
 NULL,
 NULL,
 NULL, 
 NULL, 
 NULL, 
 NULL, 
 NULL, 
 NULL,
 NULL, 
 NULL,
 NULL,
 NULL, 
 NULL, 
 NULL,
 NULL,
 NULL, 
 NULL,
 NULL,
 NULL,
 NULL
 )");

//echo $sql5;
//  echo $query1;
if ($link->query($sql5) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql5 . "<br>" . $link->error;
}
        $nCounter++;
}
mysql_close($link);
