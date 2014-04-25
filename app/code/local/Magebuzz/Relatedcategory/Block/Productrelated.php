<?php
/*
* @copyright   Copyright ( c ) 2013 www.magebuzz.com
*/
class Magebuzz_Relatedcategory_Block_Productrelated extends Mage_Catalog_Block_Product_Abstract
{          
  protected $_productCollection; 
  protected $_defaultToolbarBlock = 'catalog/product_list_toolbar';   

  public function _getProductCollection(){
    $productId = $this->getRequest()->getParam('pid');     
    $categoryId = $this->getRequest()->getParam('cid');     
    $product = Mage::getModel('catalog/product')->load($productId) ;  
    $productCollection = $product->getRelatedProductCollection();
    $productCollection ->addCategoryFilter(Mage::getModel('catalog/category')->load($categoryId));
    return $productCollection;
  }  

  public function getLoadedProductCollection()
  {
    return $this->_getProductCollection();
  }

  public function getMode()
  {
    return $this->getChild('toolbar')->getCurrentMode();
  }

  protected function _beforeToHtml()
  {
    $toolbar = $this->getToolbarBlock();
    $collection = $this->_getProductCollection();

    if ($orders = $this->getAvailableOrders()) {
      $toolbar->setAvailableOrders($orders);
    }
    if ($sort = $this->getSortBy()) {
      $toolbar->setDefaultOrder($sort);
    }
    if ($dir = $this->getDefaultDirection()) {
      $toolbar->setDefaultDirection($dir);
    }
    if ($modes = $this->getModes()) {
      $toolbar->setModes($modes);
    }

    $toolbar->setCollection($collection);
    $this->setChild('toolbar', $toolbar);
    Mage::dispatchEvent('catalog_block_product_list_collection', array(
    'collection' => $this->_getProductCollection()
    ));
    $this->_getProductCollection()->load();
    return parent::_beforeToHtml();
  }

  public function getToolbarBlock()
  {
    if ($blockName = $this->getToolbarBlockName()) {
      if ($block = $this->getLayout()->getBlock($blockName)) {
        return $block;
      }
    }
    $block = $this->getLayout()->createBlock($this->_defaultToolbarBlock, microtime());
    return $block;
  }

  public function getAdditionalHtml()
  {
    return $this->getChildHtml('additional');
  }

  public function getToolbarHtml()
  {
    return $this->getChildHtml('toolbar');
  }

  public function setCollection($collection)
  {
    $this->_productCollection = $collection;
    return $this;
  }

  public function addAttribute($code)
  {
    $this->_getProductCollection()->addAttributeToSelect($code);
    return $this;
  }

  public function getPriceBlockTemplate()
  {
    return $this->_getData('price_block_template');
  }

  protected function _getConfig()
  {
    return Mage::getSingleton('catalog/config');
  }

  public function prepareSortableFieldsByCategory($category) {
    if (!$this->getAvailableOrders()) {
      $this->setAvailableOrders($category->getAvailableSortByOptions());
    }
    $availableOrders = $this->getAvailableOrders();
    if (!$this->getSortBy()) {
      if ($categorySortBy = $category->getDefaultSortBy()) {
        if (!$availableOrders) {
          $availableOrders = $this->_getConfig()->getAttributeUsedForSortByArray();
        }
        if (isset($availableOrders[$categorySortBy])) {
          $this->setSortBy($categorySortBy);
        }
      }
    }

    return $this;
  }
}
