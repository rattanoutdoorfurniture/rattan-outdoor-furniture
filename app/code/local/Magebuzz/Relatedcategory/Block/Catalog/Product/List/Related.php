<?php
/*
* @copyright   Copyright ( c ) 2013 www.magebuzz.com
*/
class Magebuzz_Relatedcategory_Block_Catalog_Product_List_Related extends Mage_Catalog_Block_Product_List_Related
{
  protected $_mapRenderer = 'msrp_noform';

    protected $_itemCollection;

    protected function _prepareData() {
        $productIds = array();
        //parent::_prepareData();
        $product = Mage::registry('product');
        /**
         * @see Mage_Catalog_Model_Resource_Product_Link_Product_Collection
         */
        $collection = $product->getLinkInstance()->useRelatedLinks()->getProductCollection();
        //$collection->setProduct($product);
        $collection->addAttributeToSelect('required_options')->setPositionOrder()->addStoreFilter();
        if(Mage::helper('catalog')->isModuleEnabled('Mage_Checkout')) {
            Mage::getResourceSingleton('checkout/cart')->addExcludeProductFilter(
                $collection,
                Mage::getSingleton('checkout/session')->getQuoteId()
            );
            $this->_addProductAttributesAndPrices($collection);
        }
        Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);

        //$prods = array();
        //$cnt=1;
        //foreach($collection as $prod) {
        //    array_push($prods,is_null($prod)?'fail':"Product ".$prod->getId());
        //    $cnt+=1;
        //}
        //die(dumper::auto($prods));

        $this->_itemCollection = $collection;

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
