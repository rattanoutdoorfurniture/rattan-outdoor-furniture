<?php
class Rofcustom_Checkout_Model_Onepage extends Mage_Checkout_Model_Type_Onepage
{

    public function saveShippingMethod($shippingMethod)
    {


        if (empty($shippingMethod)) {
            //$shippingMethod = 'freeshipping_freeshipping';
            $shippingMethod = 'flatrate_flatrate';
        }
        $rate = $this->getQuote()->getShippingAddress()->getShippingRateByCode($shippingMethod);
        if (!$rate) {
            return array('error' => -1, 'message' => Mage::helper('checkout')->__('Invalid shipping method.'));
        }
        $this->getQuote()->getShippingAddress()
            ->setShippingMethod($shippingMethod);

        $this->getCheckout()
            ->setStepData('shipping_method', 'complete', true)
            ->setStepData('payment', 'allow', true);

        return array();
    }
}