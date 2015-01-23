<?php
/**
 *
 */

/**
 * Class Rofcustom_General_Model_Observer
 */
class Rofcustom_General_Model_Observer {

    /**
     * @param $observer
     */
    public function cmsLocations($observer) {
        $reqStr = Mage::app()->getRequest()->getRequestString();
        $matches = array();
        preg_match('/\/(locations)\/([^\/]*)?\/?([^\/]*)?\/?/',$reqStr,$matches);
        if(count($matches)<4) return;
        if($matches[0]!==$reqStr) return;
        if(strlen($matches[1]) > 0) {
            $observer->getEvent()->getLayout()->getUpdate()->addHandle('cms_page_locations');
        }
        if(strlen($matches[1]) > 0 && strlen($matches[2]) == 0 && strlen($matches[3]) == 0) {
            $observer->getEvent()->getLayout()->getUpdate()->addHandle('cms_page_locations_index');
        }
        if(strlen($matches[2]) > 0 && strlen($matches[3]) == 0) {
            $observer->getEvent()->getLayout()->getUpdate()->addHandle('cms_page_locations_state');
        }
        if(strlen($matches[3]) > 0) {
            $observer->getEvent()->getLayout()->getUpdate()->addHandle('cms_page_locations_city');
        }
    }
}