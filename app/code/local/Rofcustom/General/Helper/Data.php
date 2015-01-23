<?php
/**
 * Rattan Outdoor Furniture Custom Helper Class
 */
class Rofcustom_General_Helper_Data extends Mage_Core_Helper_Abstract {
    /**
     * getJSifMin - returns filename with the appended suffix (file extension)
     * dependent on whether the config is set to minify the JS.
     * If so, the function will take the string passed in the $file parameter and concatenate
     * a suffix of ".min.js", otherwise, just ".js" will be appended.
     * If the Second Parameter is passed as TRUE, the function will return the value with
     * the ".min.js" ending regardless of the configuration.
     *
     * @param string $file
     * @param bool $forceMin
     * @return string
     */
    public function getJSifMin($file,$forceMin=false) {
        if($forceMin || Mage::getStoreConfig("dev/js/merge_files")===1) {
            return $file . ".min.js";
        }
        return $file.".js";
    }

    /**
     * @param $name Category Name to return ID of
     * @return int | NULL Category ID for given category Name
     */
    public function getCategoryIdByName($name) {
        $errors = array();
        $catId  = NULL;
        try {
            $categories = Mage::getResourceModel('catalog/category_collection');
            $filtered   = $categories->addFieldToFilter('name', $name);
            $first      = $filtered->getFirstItem();
            $catId      = $first->getId();
        } catch(Exception $e) {
            $errors[] = array(
                "Message"   => $e->getMessage(),
                "Trace"     => $e->getTraceAsString(),
                "File"      => $e->getFile(),
                "Line"      => $e->getLine(),
                "Exception" => $e
            );
        }
        if(count($errors)>0) {
            $catId = NULL;
            MAGE::log(Zend_Debug::dump($errors,"Rofcustom/General/getCategoryIdByName",false));
        }
        return $catId;
    }
}