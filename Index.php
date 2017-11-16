<?php

namespace Espresso\Searchfilter\Controller\Index;


use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;

class Index extends Action
{
    protected $resultPageFactory;
    public function __construct(Context $context, PageFactory $pageFactory)
    {
        $this->resultPageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        //get request data
        //if(isset())
         $postData= $this->getRequest()->getPost() ;
         if(isset($postData['submit'])){
             die('i am submitted');
         }else{
             die("I ma not submited");
         }
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getLayout()->initMessages();
        //$postData='';
       
         print_r($postData);
         die("test");
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $storeManager = $objectManager->get('\Magento\Store\Model\StoreManagerInterface');
        $baseUrl= $storeManager->getStore()->getBaseUrl();
//     print_r($postData);
//     die('tet');
//        $catId  = $postData['catId'];
//        $model   = $postData['model'];
//        $year   = $postData['year'];
       $catId  = $this->getRequest()->getParam('catId');
        $model   = $this->getRequest()->getParam('model');
        $year   = $this->getRequest()->getParam('year');
        
          if(empty($catId) || !is_numeric($catId) && empty($model)  || !is_numeric($model) && empty($year) || !is_numeric($year) ){
             echo "Direct access not allowd you will be redicted to home page";
              header('Location: '.$baseUrl);           
             exit();
             // die('please go back');
           
            }else{
        $categoryFactory = $objectManager->create('Magento\Catalog\Model\ResourceModel\Category\CollectionFactory');
        $productCollection = $objectManager->create('Magento\Catalog\Model\ResourceModel\Product\CollectionFactory');
        $categories = $categoryFactory->create()                             
                            ->addAttributeToSelect('*')
                            ->addFieldToFilter("parent_id", $catId)
                            ->addFieldToFilter("is_active", 1);
        
        
$resultPage->getLayout()->getBlock('form.product.filter')->setCatid($catId);
$catTitleName=$objectManager->create('Magento\Catalog\Model\Category')->load($catId);
$resultPage->getLayout()->getBlock('product.cattitle.custom')->setName($catTitleName->getName());
$arrSelection=array('catId'=>$catId,'model'=>$model,'year'=>$year);
$resultPage->getLayout()->getBlock('form.product.filter')->setSelection($arrSelection);
$subCatmenu=array();
$catProduct=$objectManager->create('Magento\Catalog\Model\Category')->load($catId); 
$catName=$catProduct['name'];
$catLevel=$catProduct['level'];
 if ( $catLevel == 2 ){
     
                  foreach($categories as $cat){
                                                         // echo $cat->getName()."<br>";
                      if(strtolower($cat->getName())=='product type'){
                          $modelCatId=$cat->getId();
                            $subcategories = $categoryFactory->create()                             
                            ->addAttributeToSelect('*')
                            ->addFieldToFilter("parent_id", $modelCatId)
                            ->addFieldToFilter("is_active", 1);
                          // print_r($subcategories->getData());
                           foreach($subcategories as $catmenu){
                               //echo $subcat->getName()."---";
                               $subCatmenu[]=array('catname'=>$catmenu->getName(),'caturl'=>$catmenu->getUrl(),'catId'=>$catmenu->getId());
                           }
                          
                  }
                  
                           }
                          // print_r($subCat);
        $htmlPage =   '';
             $subCat=$catProduct->getChildrenCategories($catId);
             // print_r($subCat->getData());
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
                          $category=$objectManager->create('Magento\Catalog\Model\Category')->load($idOfCat);
                         // echo $data->getName();
                          // $subCat[]=array('catname'=>$data->getName(),'caturl'=>$data->getUrl(),'catId'=>$data->getId());
                          $nameOfCat= $data->getName();
                         //get products by category id
                               $collection = $productCollection->create();
                                             $collection->addAttributeToSelect('*');                                          
                                            // $collection->addCategoryFilter($category);
                                              $collection->addCategoriesFilter(['eq' => $idOfCat]);
                                               $collection->addCategoriesFilter(['eq' => $model]);
                                                $collection->addCategoriesFilter(['eq' => $year]);
                                             $collection->load();
                                            // print_r($collection->getData());
//                                             if(!empty($collection)){
//                                                 echo "i am having some data";
//                                             }
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
                                                                  
                                                                 
                                                 }
                                                  $htmlPage .= '</div>';
                                                  $htmlPage .='</div>';  
                                               
                                                 
                                             }
                                             
                                          
                         
                      }
                      
                      
                     
                    
                }
              
             }
            // print_r($subCat->getData());
              //    $result = array('collection' => $htmlPage);
              // echo json_encode($result);   
                 $result=$htmlPage;
                 $resultPage->getLayout()->getBlock('form.product.filter')->setName($result);
                 $resultPage->getLayout()->getBlock('product.cattitle.custom')->setSubcat($subCatmenu);
                  $resultPage->getLayout()->getBlock('product.cattitle.custom')->setCatid($catId);
                                                         
        return $resultPage;
             
 }

 if(empty($categories->getData())){
                                             $catProduct=$objectManager->create('Magento\Catalog\Model\Category')->load($catId); 
                                             $collection = $productCollection->create();
                                             $collection->addAttributeToSelect('*');
                                            //$collection->addAttributeToFilter('model', array('eq' => "$model")) ;
                                         
                                             $collection->addCategoryFilter($catProduct);
                                                     if(trim($model)!= 'Model'){
                                                       $collection->addAttributeToFilter('model', array('eq' => "$model")) ;
                                                     }
                                                     if(trim($year)!= 'Year'){
                                                       $collection->addAttributeToFilter('year', array('eq' => "$year")) ;
                                                     }
                                                     //$collection->addAttributeToFilter('year', array('like' => "%$year%")) ;                                                    
                                                     $collection->load();
                                                         if(empty($collection->getData())){
                                                                $htmlPage =   '<div class="productsearchmsg">No product found please select another</div>';
                                                         }
                                                         
                                                         if(!empty($collection->getData())){
                                                              $htmlPage =   '';
                                                              $htmlPage .=   '<div class="row category-page2">';
                                                             //$htmlPage .=   '<div>'.$collection->getSelect().'</div>';
                                                              $htmlPage .=  '<div class="col-sm-12 sub-cat-tile">';
                                                              $htmlPage .=  '<div class="image-section"></div>';
                                                              $htmlPage .=  '<div class="buttonsection">';
                                                              $htmlPage .= '<div class="lefttextarea col-sm-6 col-md-6 col-lg-6 col-xs-12">'. $catProduct->getName().'</div>';
                                                              $htmlPage .='</div>';

                                                              foreach ($collection as $product){
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
                                                                  $htmlPage .='<div class="shortDes">';
                                                                  $htmlPage .='<p>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</p>';
                                                                  //$htmlPage += $this->escapeHtml($product->getShortDescription());
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

                                                    // $result = array('collection' => $htmlPage);
                                                     //echo json_encode($result);     
                                                           $result=$htmlPage;
                                                      $resultPage->getLayout()->getBlock('form.product.filter')->setName($result);
                                              }else{
                                                 // echo "i am here";

                                                                         //  echo "all category product display here";
                                                      $htmlPage =   '';
                                                      $flgEmpty=0;
                                                      $htmlPage .=   '<div class="row category-page2">';
//                                                    echo "<pre>";
//                                                      print_r($categories->getData());   
//                                                       echo "</pre>";
                                                      foreach($categories as $cat){
                                                         // echo $cat->getName()."<br>";
                      if(strtolower($cat->getName())=='product type'){
                          $modelCatId=$cat->getId();
                            $subcategories = $categoryFactory->create()                             
                            ->addAttributeToSelect('*')
                            ->addFieldToFilter("parent_id", $modelCatId)
                            ->addFieldToFilter("is_active", 1);
                          // print_r($subcategories->getData());
                           foreach($subcategories as $catmenu){
                               //echo $subcat->getName()."---";
                               $subCat[]=array('catname'=>$catmenu->getName(),'caturl'=>$catmenu->getUrl(),'catId'=>$catmenu->getId());
                           }
                          
                      }                                       


                                                             $catProducts=$objectManager->create('Magento\Catalog\Model\Category')->load($cat->getId()); 
                                                                 $collection = $productCollection->create();
                                                                 $collection->addAttributeToSelect('*');
                                                                 $collection->addCategoryFilter($catProducts);
                                                                    if(trim($model) != 'Model'){
                                                                        $collection->addAttributeToFilter('model', array('eq' => "$model")) ;
                                                                        }
                                                                    if(trim($year) != 'Year'){
                                                                        $collection->addAttributeToFilter('year', array('eq' => "$year")) ;
                                                                        }
                                                                  //$collection->addAttributeToFilter('year', array('like' => "%$year%"));
                                                                  //$collection->addAttributeToFilter('model', array('like' => "%$model%"));
                                                                  $collection->load();
                                                                 if(empty($collection->getData())){
                                                                     //echo "dont show cat";
                                                                     $flgEmpty=1;
                                                                 }
                                                                 if(!empty($collection->getData())){
                                                                     $flgEmpty=0;
                                                                     //echo "show cat";
                                                                           $htmlPage .=  '<div class="col-sm-12 sub-cat-tile">';
                                     $htmlPage .=  '<div class="image-section"></div>';
                                     $htmlPage .=  '<div class="buttonsection">';
                                     $htmlPage .= '<div class="lefttextarea col-sm-6 col-md-6 col-lg-6 col-xs-12">'. $cat->getName().'</div>';
                                     $htmlPage .='</div>';
                                     //                               echo "<br>-------";
                                     //                              echo 'cat id-'.$cat->getId().'-name-'.$cat->getName();

                                                                   //print_r($collection);
                                                                   //print_r($collection->getData());
                                                                  foreach ($collection as $product){
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
                                     $htmlPage .='<div class="shortDes">';
                                     $htmlPage .='<p>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</p>';
                                     //$htmlPage += $this->escapeHtml($product->getShortDescription());
                                     $htmlPage .='</div>';
                                     $htmlPage .='<div class="relatedViewButton">';
                                     $htmlPage .= '<a class="btn btn-default" href="'.$product->getProductUrl().'">view</a>';             
                                     $htmlPage .='</div>';
                                     $htmlPage .='</div>';
                                     $htmlPage .='</div>';             
                                     // echo 'Name  =  '.$product->getName().'<br>';
                                     } 
                                                                   // echo "<br>-------";
                                                          $htmlPage .= '</div>';  
                                                                 }

                                                         }
                                                         if($flgEmpty==1){
                                                             $htmlPage =   '<div class="productsearchmsg">No product found please select another</div>';
                                                         }
                                                        // $result = array('collection' => $htmlPage);
                                                         //echo json_encode($result); 
                                                         $result=$htmlPage;
                                                      $resultPage->getLayout()->getBlock('form.product.filter')->setName($result);
                                                         }
        $resultPage->getLayout()->getBlock('product.cattitle.custom')->setSubcat($subCat);
         $resultPage->getLayout()->getBlock('product.cattitle.custom')->setCatid($catId);
                                                         
        return $resultPage;
        
    }       
             }
       

  
}