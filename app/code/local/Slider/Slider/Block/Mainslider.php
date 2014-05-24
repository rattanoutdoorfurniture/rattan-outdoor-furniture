<?php
class Slider_Slider_Block_Mainslider extends Mage_Core_Block_Template
{

    public function IsRssCatalogEnable()
    {
        return Mage::getStoreConfig('rss/catalog/category');
    }

    public function IsTopCategory()
    {
        return $this->getCurrentCategory()->getLevel()==2;
    }
	public function getCurrentCategory()
    {	//echo "hihi";
        if (!$this->hasData('current_category')) {
		//echo "huhu";var_dump(Mage::registry('current_category'));die;
            $this->setData('current_category', Mage::registry('current_category'));
        }
        return $this->getData('current_category');
    }
	public function getRssLink()
    {
        return Mage::getUrl('rss/catalog/category',array('cid' => $this->getCurrentCategory()->getId(), 'store_id' => Mage::app()->getStore()->getId()));
    }
	
}