<?php
/*
* @copyright   Copyright ( c ) 2013 www.magebuzz.com
*/
class Magebuzz_Relatedcategory_Block_Catalog_Product_List_Related extends Mage_Catalog_Block_Product_List_Related
{
  protected $_mapRenderer = 'msrp_noform';

  protected $_itemCollection;

  protected function _prepareData()
  {                       
    $productIds = array();
    parent::_prepareData();          
    foreach($this->_itemCollection as $product){
      $productIds[] = $product->getId();
    }                            
    $catalogModel = Mage::getModel('relatedcategory/relatedcategory')->getAllCategoryRelatedByProductId($productIds);
    $categoryModel = Mage::getModel('catalog/category')->getCollection()
    ->addAttributeToSelect('name')
    ->addFieldToFilter('entity_id',array('in'=>$catalogModel));    
    $this->_itemCollection = $categoryModel;    
    return $this;
  }

  protected function _beforeToHtml()
  {
    $this->_prepareData();
    return parent::_beforeToHtml();
  }

  public function getItems()
  {
    return $this->_itemCollection;
  }
}
