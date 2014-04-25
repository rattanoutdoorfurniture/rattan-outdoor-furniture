<?php
/*
* @copyright   Copyright ( c ) 2013 www.magebuzz.com
*/
class Magebuzz_Relatedcategory_IndexController extends Mage_Core_Controller_Front_Action
{
  public function getlistproductAction() {
  
        $pid = $this->getRequest()->getParam('pid');
        $product = Mage::getModel('catalog/product')->load($pid);
        Mage::registry('product',$product);
        $layout = $this->getLayout();
        $update = $layout->getUpdate();
        $update->load('relatedcategory_index_getlistproduct');
        $layout->generateXml();
        $layout->generateBlocks();
        $output = $layout->getOutput();        
        die($output);  
    }
}
