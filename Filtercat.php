<?php

namespace Espresso\Rcategory\Controller\Category;

//use Ranchhand\Dealers\Model\DealerFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Filtercat extends Action
{
 
     protected $resultPageFactory;
	public function __construct(
		Context $context, PageFactory $pageFactory)
	{
		    $this->resultPageFactory = $pageFactory;
		return parent::__construct($context);
	}
    public function execute()
    {        
        $postData= $this->getRequest()->getPost() ;
        $catId  = htmlspecialchars(stripslashes(trim($postData['catId'])));
        $model   = htmlspecialchars(stripslashes(trim($postData['model'])));
        $year   = htmlspecialchars(stripslashes(trim($postData['year'])));
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $storeManager = $objectManager->get('\Magento\Store\Model\StoreManagerInterface');
        $baseUrl= $storeManager->getStore()->getBaseUrl();
//input data validation
        if(is_numeric($catId) && is_numeric($model) && is_numeric($year) ){
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $categoryFactory = $objectManager->create('Magento\Catalog\Model\ResourceModel\Category\CollectionFactory');
        $productCollection = $objectManager->create('Magento\Catalog\Model\ResourceModel\Product\CollectionFactory');
        $categories = $categoryFactory->create()                             
                            ->addAttributeToSelect('*')
                            ->addFieldToFilter("parent_id", $catId)
                            ->addFieldToFilter("is_active", 1);
        //get category details
        $catProduct=$objectManager->create('Magento\Catalog\Model\Category')->load($catId); 
       // print_r($catProduct->getData());
         $catName=$catProduct['name'];
          $catLevel=$catProduct['level'];
         //display all results
         if ( $catLevel == 2 ){
             //get subcategories
              $htmlPage =   '';
             $subCat=$catProduct->getChildrenCategories($catId);
           // print_r($subCat);
//             if(empty($subCat)){
//                 echo "nothing to display";
//             }
             foreach($subCat as $cat){
               // echo $cat->getName()."<br>";
                //display only from product type category
                if(strtolower($cat->getName())=="product type"){
                   // echo $cat->getId()."=this is id of cat";
                    //get sub categories product type category (grill guards,front ,back bumpers etc to display)
                     $catDetails=$objectManager->create('Magento\Catalog\Model\Category')->load($cat->getId());
                      $subCatofAll=$catDetails->getChildrenCategories($cat->getId());
                      //print_r($subCatofAll->getData());
                      //display all products of each category
                      foreach ($subCatofAll as $data){
                           $idOfCat= $data->getId();
                           //echo $idOfCat;
                          $category=$objectManager->create('Magento\Catalog\Model\Category')->load($idOfCat);
                        
                          $nameOfCat= $data->getName();
                         //get products by category id
                               $collection = $productCollection->create();
                                             $collection->addAttributeToSelect('*');  
                                             if($year == 'year' && $model == 'model'){
                                             $collection->addCategoryFilter($category);
                                             }
                                              //  $collection->addCategoryFilter($category);
                                                $collection->addCategoriesFilter(['eq' => $idOfCat]);
                                             if($year != 'year'){
                                                    $collection->addCategoriesFilter(['eq' => $year]);
                                                    }
                                                      if($model != 'model'){
                                                    $collection->addCategoriesFilter(['eq' => $model]);
                                                    }
                                                 
                                             $collection->load();
                                            // print_r($collection->getData());
//                                             if(!empty($collection)){
//                                                 echo "i am having some data";
//                                             }
//                                             if(empty($collection->getData())){
//                                                 echo "great";
//                                             }
//                                             print_r($collection->getData());
                                             if(!empty($collection->getData())){
                                                 
                                                              $htmlPage .=   '<div class="row category-page2">';
                                                             //$htmlPage .=   '<div>'.$collection->getSelect().'</div>';
                                                              $htmlPage .=  '<div class="col-sm-12 sub-cat-tile">';
                                                              $htmlPage .=  '<div class="image-section"></div>';
                                                              $htmlPage .=  '<div class="buttonsection">';
                                                              $htmlPage .= '<div class="lefttextarea col-sm-6 col-md-6 col-lg-6 col-xs-12">'. $nameOfCat.'</div>';
                                                              $htmlPage .='</div>';
                                                 foreach($collection as $product){
                                                       //$product->getName();
                                                                  $htmlPage .= '<div class="col-sm-4 col-md-4 col-lg-4">';
                                                                  $htmlPage .= '<div class="wrapper-section-product">';
                                                                  $htmlPage .= '<div class="productimg">';

                                                                  $producImageUrl = $product->getUrl('pub/media/catalog').'product'.$product->getImage();
                                                                  $image = 'related_products_list';
                                                                  $_imagehelper = $objectManager->create('Magento\Catalog\Helper\Image');
                                                                 // $_imagehelper = $product->helper('Magento\Catalog\Helper\Image');
                                                                  $productImage = $_imagehelper->init($product, $image)->getUrl();

                                                                  $htmlPage .= '<img  class="img-responsive" src="'.$productImage.'" />';
                                                                  $htmlPage .= '</div>';
                                                                  $htmlPage .= '<div class="productname">';
                                                                  $htmlPage .= '<a href="'.$product->getProductUrl().'">';
                                                                  $htmlPage .=  $product->getName();
                                                                  $htmlPage .='</a>';
                                                                  $htmlPage .='</div>';
                                                                  $htmlPage .= '<div class="productmodel">'.$product->getModel().'</div>';                                                                  
                                                                  $htmlPage .='<div class="shortDes">';
                                                                  //$htmlPage .='<p>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</p>';
                                                                 //if charactors more than 200
                                                                  $nofChar=strlen(strip_tags($product->getShortDescription()));
                                                                  $dash='';
                                                                  if($nofChar > 200){
                                                                  $dash=" ...";    
                                                                  }
                                                                  $htmlPage .= substr(strip_tags($product->getShortDescription()),0,200).$dash;
                                                                  $htmlPage .='</div>';
                                                                  $htmlPage .='<div class="relatedViewButton">';
                                                                  $htmlPage .= '<a class="btn btn-default" href="'.$product->getProductUrl().'">view '.$_SESSION['year'].'</a>';             
                                                                  $htmlPage .='</div>';
                                                                  $htmlPage .='</div>';
                                                                  $htmlPage .='</div>';    
                                                                  
                                                                 
                                                 }
                                                  $htmlPage .= '</div>';
                                                  $htmlPage .='</div>';  
                                               
                                                 
                                             }
                                             
                                          
                         
                      }
                      
                      
                     
                    
                }
              
             }
            // print_r($subCat->getData());
                  $result = array('collection' => $htmlPage);
               echo json_encode($result);    
         }
         if($catLevel !=2 ){
        // echo $catLevel;
      //if model is not selected
//      if($model == 'model'){
//          echo "model is not selected";
//      }
//         //if year is not selected
//            if($year == 'year'){
//           echo "year is not selected";
//      }
         //if all selected
       
//         $categoryId = 'yourcategoryid';
//    $category = $categoryFactory->create()->load($model);
            $catalog_ids =[$model,$year,$catId];
//        $values = [$model, $year];
//        $conditionType = "in";
                $proddata = $productCollection->create()  ;
                $proddata->addAttributeToSelect('*');
                //$categoriesdata->addFieldToFilter("parent_id", $catId);
               // $proddata->addCategoriesFilter(array('in' => $catalog_ids));
                //$proddata->addCategoriesFilter(['eq' => $catalog_ids]);
                if($year != 'year'){
                $proddata->addCategoriesFilter(['eq' => $year]);
                }
                if($model != 'model'){
                $proddata->addCategoriesFilter(['eq' => $model]);
                }
                if($catLevel > 2){
                $proddata->addCategoriesFilter(['eq' => $catId]);
                }
//                if($catLevel == 2){
//                //$proddata->addCategoriesFilter(['in' => $catId]);
//                }
                
                //->addCategoriesFilter(['eq' => 2]);
               // echo $productCollection->getSelect();
                           
                           // ->addFieldToFilter("is_active", 1);
        //        echo $proddata->getSelect()->__toString();
//            
  // print_r($proddata->getData());
              // die('test');
          if(empty($proddata->getData())){
               $htmlPage =   '<div class="productsearchmsg">No product found please select another</div>';
           $result = array('collection' => $htmlPage);
           echo json_encode($result);
               
          }else{
              
                 if(!empty($proddata->getData())){
                                                              $htmlPage =   '';
                                                              $htmlPage .=   '<div class="row category-page2">';
                                                             //$htmlPage .=   '<div>'.$collection->getSelect().'</div>';
                                                              $htmlPage .=  '<div class="col-sm-12 sub-cat-tile">';
                                                              $htmlPage .=  '<div class="image-section"></div>';
                                                              $htmlPage .=  '<div class="buttonsection">';
                                                              $htmlPage .= '<div class="lefttextarea col-sm-6 col-md-6 col-lg-6 col-xs-12">'. $catName.'</div>';
                                                              $htmlPage .='</div>';

                                                              foreach ($proddata as $product){
                                                                   //$product->getName();
                                                                  $htmlPage .= '<div class="col-sm-4 col-md-4 col-lg-4">';
                                                                  $htmlPage .= '<div class="wrapper-section-product">';
                                                                  $htmlPage .= '<div class="productimg">';

                                                                  $producImageUrl = $product->getUrl('pub/media/catalog').'product'.$product->getImage();
                                                                  $image = 'related_products_list';
                                                                  $_imagehelper = $objectManager->create('Magento\Catalog\Helper\Image');
                                                                 // $_imagehelper = $product->helper('Magento\Catalog\Helper\Image');
                                                                  $productImage = $_imagehelper->init($product, $image)->getUrl();

                                                                  $htmlPage .= '<img  class="img-responsive" src="'.$productImage.'" />';
                                                                  $htmlPage .= '</div>';
                                                                  $htmlPage .= '<div class="productname">';
                                                                  $htmlPage .= '<a href="'.$product->getProductUrl().'">';
                                                                  $htmlPage .=  $product->getName();
                                                                  $htmlPage .='</a>';
                                                                  $htmlPage .='</div>';
                                                                   $htmlPage .= '<div class="productmodel">'.$product->getModel().'</div>';                                                                  
                                                                  $htmlPage .='<div class="shortDes">';
                                                                 // $htmlPage .='<p>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</p>';
                                                                  //$htmlPage += $this->escapeHtml($product->getShortDescription());
                                                                    $nofChar=strlen(strip_tags($product->getShortDescription()));
                                                                  $dash='';
                                                                  if($nofChar > 200){
                                                                  $dash=" ...";    
                                                                  }
                                                                  $htmlPage .= substr(strip_tags($product->getShortDescription()),0,200).$dash;
                                                                  $htmlPage .='</div>';
                                                                  $htmlPage .='<div class="relatedViewButton">';
                                                                  $htmlPage .= '<a class="btn btn-default" href="'.$product->getProductUrl().'">view</a>';             
                                                                  $htmlPage .='</div>';
                                                                  $htmlPage .='</div>';
                                                                  $htmlPage .='</div>';              
                                                                 // echo 'Name  =  '.$product->getName().'<br>';
                                                              }  
                                                              $htmlPage .= '</div>';
                                                          }

                                                     $result = array('collection' => $htmlPage);
                                                     echo json_encode($result);   
          }   
          
         }
                                                    }else{
                                                        if(empty($catId) && empty($model) && empty($year) ){
                                                           //die('we not allow direct access'); 
                                                            echo "Direct access not allowd you will be redicted to home page";
                                                            header('Location: '.$baseUrl); 
                                                            exit();
                                                        }else{
                                                                $htmlPage =   '<div class="productsearchmsg">Value you entered for search are not valid please try again</div>';
                                                                $result = array('collection' => $htmlPage);
                                                                 echo json_encode($result);
                                                        }
        }
                      
    }

}