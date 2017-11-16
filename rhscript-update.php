<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'dbconnect.php';
$selected = mysql_select_db("updateproducts",$link)
  or die("Could not select examples");
//
//execute the SQL query and return records
//$result = mysql_query("SELECT * FROM products");
//joint tables
//$sql = "SELECT `Sheet1`.*,`products`.*,`categories`.* FROM Sheet1 , `products` , `categories` where products.part_number=Sheet1.exppartno";
//$sql2="SELECT `products`.*,`categories`.*,`product_images`.* FROM products , `categories` , `product_images` WHERE products.part_number=product_images.exppartno AND products.category_id=categories.id";
//joined three tables
//$sql3="SELECT `categories`.*,`products`.* ,product_images.* FROM categories , `products`,product_images WHERE products.category_id=categories.id AND product_images.exppartno=products.part_number";
//$sql4 = mysql_query("SELECT `categories`.*, `masterappfinaldata3`.* FROM `masterappfinaldata3`,categories WHERE `masterappfinaldata3`.`Category ID`= categories.id");
 $sql5=mysql_query("SELECT * FROM `final-databrandan`");
//print_r($sql5);
//die('tst');
 $attribute='<div class="row">
<div class="col-md-6 col-sm-6 "><button class="btn btn-default pull-right" onclick="location.href=\'\dealers\'" type="button">find one near you</button></div>
<div class="col-md-6 col-sm-6"><button class="btn btn-default" onclick="location.href=\'#\'" type="button">installation guide</button></div>
</div>';
//echo htmlspecialchars($attribute);
$nCounter = 0;
//echo $sql4;
while ($row = mysql_fetch_array($sql5)) {
//    echo $nCounter;
//    print_r($row);
    
    $noOfProducts=1;

                                                                                            $noOfProducts = 2;
if ($nCounter >= $noOfProducts )
{
  //  die(" $noOfProducts products has been added in databse");
}
$query="UPDATE `catalog_product_20161007_165351` SET `additional_attributes`=";
$query .= "'buttons=here are buttuns,camera_ready=".$row['Camera_ready'].",factory_receiver=".$row['FR'].",fog_lights=".$row['fog_lights'].",gross_wt=".$row['Gross_Wt'].",height=".$row['Height'].",length=".$row['Length'].",make=".$row['Make'].",model=".$row['Model'].",net_wt=".$row['Net_Wt'].",part_number=".$row['Part_Number'].",product=".$row['Part_Number'].",sesnser_ready=".$row['sesnser_ready'].",tow_hooks=".$row['TH'].",upc_code=".$row['UPC_Code'].",width=".$row['Width'].",winch_ready=".$row['Winch_ready'].",year=".$row['Year'].",Jobber=".$row['Jobber'].",MSRP=".$row['MSRP'].",Online=".$row['Online']."'";
$query .=" , `special_price`=''";
$query .=" , `custom_design`=''";
$query .=" , `special_price_to_date`=''";
$query .=" , `special_price_from_date`=''";
$query .=" ,  `page_layout`=''";
$query .=" ,  `msrp_display_actual_price_type`=''";
$query .=" ,  `store_view_code`='default'";
$query .=" ,  `msrp_price`=''";
$query .=" ,  `new_from_date`=''";
$query .=" ,  `new_to_date`=''";
$query .=" ,  `custom_design_from`=''";
$query .=" ,  `custom_design_to`=''";

$query .= " WHERE `catalog_product_20161007_165351`.`sku` = ";
$query .= "'".$row['Part_Number']."'";
mysql_query($query);
//echo $query;
//die();
////mysql_query('UPDATE catalog_product_20161007_165351 set additional_attributes=');
//// die('got it');
////genrate  url key from product name
// $productName=$row['Description'];
//$productUrl = str_replace(' ', '-', $productName);
////products are with same name so we need to differenate
//$productUrl=$productUrl."-".$row['Part_Number'];
////explode($attribute, $string)
////"Default Category/Chevrolet,Default Category/Ram'
////if there are more than one make
//$multiMake=explode('/',$row['Make']);
////echo "<pre>";
////print_r($multiMake);
////echo "</pre>";
//$make='';
//if(isset($multiMake[1])){
//    //echo $multiMake[1];
//    $make="Default Category/".trim($multiMake[1])."/".$row['Sub_category'].",";
//}else{
//    //echo "not multi make";
//    //$make
//}
//$make.= "Default Category/".trim($multiMake[0])."/".$row['Sub_category'];
////echo $make;
//mysql_query("INSERT INTO `ranchhand-orignal`.`catalog_product_20160922_200847`
//(`sku`,
// `store_view_code`,
// `attribute_set_code`,
// `product_type`,
// `categories`, 
// `product_websites`, 
// `name`, 
// `description`,
// `short_description`, 
// `weight`, 
// `product_online`, 
// `tax_class_name`, 
// `visibility`, 
// `price`, 
// `special_price`, 
// `special_price_from_date`,
// `special_price_to_date`, 
// `url_key`, 
// `meta_title`, 
// `meta_keywords`, 
// `meta_description`, 
// `base_image`, 
// `base_image_label`, 
// `small_image`,
// `small_image_label`, 
// `thumbnail_image`, 
// `thumbnail_image_label`, 
// `swatch_image`, 
// `swatch_image_label`, 
// `created_at`, 
// `updated_at`, 
// `new_from_date`, 
// `new_to_date`, 
// `display_product_options_in`, 
// `map_price`,
// `msrp_price`, 
// `map_enabled`, 
// `gift_message_available`, 
// `custom_design`, 
// `custom_design_from`, 
// `custom_design_to`, 
// `custom_layout_update`, 
// `page_layout`, 
// `product_options_container`,
// `msrp_display_actual_price_type`,
// `country_of_manufacture`, 
// `additional_attributes`, 
// `qty`, 
// `out_of_stock_qty`,
// `use_config_min_qty`, 
// `is_qty_decimal`, 
// `allow_backorders`,
// `use_config_backorders`, 
// `min_cart_qty`, 
// `use_config_min_sale_qty`, 
// `max_cart_qty`, 
// `use_config_max_sale_qty`,
// `is_in_stock`,
// `notify_on_stock_below`, 
// `use_config_notify_stock_qty`, 
// `manage_stock`, 
// `use_config_manage_stock`,
// `use_config_qty_increments`, 
// `qty_increments`, 
// `use_config_enable_qty_inc`, 
// `enable_qty_increments`, 
// `is_decimal_divided`, 
// `website_id`, 
// `related_skus`, 
// `related_position`, 
// `crosssell_skus`, 
// `crosssell_position`, 
// `upsell_skus`, 
// `upsell_position`, 
// `additional_images`, 
// `additional_image_labels`, 
// `hide_from_product_page`, 
// `bundle_price_type`, 
// `bundle_sku_type`, 
// `bundle_price_view`, 
// `bundle_weight_type`, 
// `bundle_values`, 
// `bundle_shipment_type`,
// `configurable_variations`,
// `configurable_variation_labels`,
// `associated_skus`
// )
// VALUES (
// '".$row['Part_Number']."-".$nCounter
// ."','default',
// 'Bumper', 
// 'configurable', 
// '".$make
// ."','base', 
// '".$row['Description']
//."','long description', 
//'short description',
//'".$row['Net_Wt'] 
//."',1,
//'0',
//'Catalog, Search',
//'".$row['MSRP'] 
// ."','','','',
// '".$productUrl."','', 
//'', 
//'',
//'', 
//'', 
//'', 
// NULL, 
// NULL, 
// NULL, 
// NULL, 
// NULL, 
// NULL, 
// NULL,
//'','', 
//'Block after Info Column',
//'','',
//'Use config','','','','', 
// NULL,
//'', 
// NULL,
//'',
//'', 
// 'buttons=here are buttuns, camera_ready=".$row['camera_ready'].",color=".$row['color'].",factory_receiver=".$row['FR'].",fog_lights=".$row['FL'].",gross_wt=".$row['Gross_Wt'].",height=".$row['Height'].",length=".$row['Length'].",make=".$row['Make'].",model=".$row['Model'].",net_wt=".$row['Net_Wt'].",part_number=".$row['Part_Number'].",product=".$row['Part_Number'].",sesnser_ready=".$row['sesnser_ready'].",tow_hooks=".$row['TH'].",upc_code=".$row['UPC_Code'].",width=".$row['Width'].",winch_ready=".$row['winch_ready'].",year=".$row['Year'].",Jobber=".$row['Jobber'].",MSRP=".$row['MSRP'].",Online=".$row['Online']."'
//,1,
// 0,
// 0,
// 0,
// 0,
// NULL, 
// 100,
// 1,
// 100,
// 1,
// 1, 
// 1,
// 1, 
// 1,
// 1, 
// 1, 
// 0, 
// 0, 
// 0, 
// NULL,
// NULL,
// NULL, 
// NULL, 
// NULL, 
// NULL, 
// NULL, 
// NULL,
// NULL, 
// NULL,
// NULL,
// NULL, 
// NULL, 
// NULL,
// NULL,
// NULL, 
// NULL,
// NULL,
// NULL,
// NULL
// )");
//echo "INSERT INTO `ranchhand-orignal`.`catalog_product_20160922_200847`
//(`sku`,
// `store_view_code`,
// `attribute_set_code`,
// `product_type`,
// `categories`, 
// `product_websites`, 
// `name`, 
// `description`,
// `short_description`, 
// `weight`, 
// `product_online`, 
// `tax_class_name`, 
// `visibility`, 
// `price`, 
// `special_price`, 
// `special_price_from_date`,
// `special_price_to_date`, 
// `url_key`, 
// `meta_title`, 
// `meta_keywords`, 
// `meta_description`, 
// `base_image`, 
// `base_image_label`, 
// `small_image`,
// `small_image_label`, 
// `thumbnail_image`, 
// `thumbnail_image_label`, 
// `swatch_image`, 
// `swatch_image_label`, 
// `created_at`, 
// `updated_at`, 
// `new_from_date`, 
// `new_to_date`, 
// `display_product_options_in`, 
// `map_price`,
// `msrp_price`, 
// `map_enabled`, 
// `gift_message_available`, 
// `custom_design`, 
// `custom_design_from`, 
// `custom_design_to`, 
// `custom_layout_update`, 
// `page_layout`, 
// `product_options_container`,
// `msrp_display_actual_price_type`,
// `country_of_manufacture`, 
// `additional_attributes`, 
// `qty`, 
// `out_of_stock_qty`,
// `use_config_min_qty`, 
// `is_qty_decimal`, 
// `allow_backorders`,
// `use_config_backorders`, 
// `min_cart_qty`, 
// `use_config_min_sale_qty`, 
// `max_cart_qty`, 
// `use_config_max_sale_qty`,
// `is_in_stock`,
// `notify_on_stock_below`, 
// `use_config_notify_stock_qty`, 
// `manage_stock`, 
// `use_config_manage_stock`,
// `use_config_qty_increments`, 
// `qty_increments`, 
// `use_config_enable_qty_inc`, 
// `enable_qty_increments`, 
// `is_decimal_divided`, 
// `website_id`, 
// `related_skus`, 
// `related_position`, 
// `crosssell_skus`, 
// `crosssell_position`, 
// `upsell_skus`, 
// `upsell_position`, 
// `additional_images`, 
// `additional_image_labels`, 
// `hide_from_product_page`, 
// `bundle_price_type`, 
// `bundle_sku_type`, 
// `bundle_price_view`, 
// `bundle_weight_type`, 
// `bundle_values`, 
// `bundle_shipment_type`,
// `configurable_variations`,
// `configurable_variation_labels`,
// `associated_skus`
// )
// VALUES (
// '".$row['Part_Number']."-".$nCounter
// ."','default',
// 'Bumper', 
// 'configurable', 
// '".$make
// ."','base', 
// '".$row['Description']
//."','long description', 
//'short description',
//'".$row['Net_Wt'] 
//."',1,
//'0',
//'Catalog, Search',
//'".$row['MSRP'] 
// ."','','','',
// '".$productUrl."','', 
//'', 
//'',
//'', 
//'', 
//'', 
// NULL, 
// NULL, 
// NULL, 
// NULL, 
// NULL, 
// NULL, 
// NULL,
//'','', 
//'Block after Info Column',
//'','',
//'Use config','','','','', 
// NULL,
//'', 
// NULL,
//'',
//'', 
// 'buttons=here are buttuns, camera_ready=".$row['camera_ready'].",color=".$row['color'].",factory_receiver=".$row['FR'].",fog_lights=".$row['FL'].",gross_wt=".$row['Gross_Wt'].",height=".$row['Height'].",length=".$row['Length'].",make=".$row['Make'].",model=".$row['Model'].",net_wt=".$row['Net_Wt'].",part_number=".$row['Part_Number'].",product=".$row['Part_Number'].",sesnser_ready=".$row['sesnser_ready'].",tow_hooks=".$row['TH'].",upc_code=".$row['UPC_Code'].",width=".$row['Width'].",winch_ready=".$row['winch_ready'].",year=".$row['Year'].",Jobber=".$row['Jobber'].",MSRP=".$row['MSRP'].",Online=".$row['Online']."'
//,1.0000,
// 0,
// 0,
// 0,
// 0,
// NULL, 
// 100,
// 1,
// 100,
// 1,
// 1, 
// 1,
// 1, 
// 1,
// 1, 
// 1, 
// 0, 
// 0, 
// 0, 
// NULL,
// NULL,
// NULL, 
// NULL, 
// NULL, 
// NULL, 
// NULL, 
// NULL,
// NULL, 
// NULL,
// NULL,
// NULL, 
// NULL, 
// NULL,
// NULL,
// NULL, 
// NULL,
// NULL,
// NULL,
// NULL
// )";
//echo $sql5;
//  echo $query1;
//if ($link->query($sql5) === TRUE) {
//    echo "New record created successfully";
//} else {
//    echo "Error: " . $sql5 . "<br>" . $link->error;
//}
   echo     $nCounter++;
}
mysql_close($link);
//query for add quantity equal=1
//UPDATE `cataloginventory_stock_item` SET `qty` = 1, `is_in_stock` = 1