<?php
/*
* @copyright   Copyright ( c ) 2013 www.magebuzz.com
*/
class Magebuzz_Relatedcategory_Model_Relatedcategory extends Mage_Core_Model_Abstract
{
  public function getAllCategoryRelatedByProductId($productIds){        
    $productList = implode(',',$productIds)  ;
    $categoryIds = array();
    $connection = Mage::getSingleton('core/resource')
    ->getConnection('core_read');
    $tableName = $connection->getTableName('catalog_category_product'); 
    $select = $connection->select()
    ->from($tableName, array('*')) 
    ->where('product_id in('.$productList.')')
    ->group('category_id');
    $categorySelect = $connection->fetchAll($select); 
    foreach($categorySelect as $category){
      $categoryIds[] = $category['category_id'];
    }
    return $categoryIds;  
  }
}