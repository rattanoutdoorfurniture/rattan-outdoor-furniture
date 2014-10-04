<?php
class Rofcustom_Addandcheckout_Model_Addandcheckout_Observer {
    public function addToCartAndCheckout(Varien_Event_Observer $observer) {
        $response = $observer->getResponse();
        //$request = $observer->getRequest();
        $response->setRedirect(Mage::getUrl("checkout/onepage"));
        Mage::getSingleton('checkout/session')->setNoCartRedirect(true);
    }
}