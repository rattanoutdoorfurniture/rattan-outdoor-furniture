<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Page
 * @copyright   Copyright (c) 2013 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Top menu block
 *
 * @category    Mage
 * @package     Mage_Page
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Mage_Page_Block_Html_Topmenu extends Mage_Core_Block_Template
{
    /**
     * Top menu data tree
     *
     * @var Varien_Data_Tree_Node
     */
    protected $_menu;

    /**
     * Current entity key
     *
     * @var string|int
     */
    protected $_currentEntityKey;

    /**
     * Init top menu tree structure
     */
    public function _construct()
    {
        $this->_menu = new Varien_Data_Tree_Node(array(), 'root', new Varien_Data_Tree());

        $this->addData(array(
            'cache_lifetime' => false,
        ));
    }

    /**
     * Get top menu html
     *
     * @param string $outermostClass
     * @param string $childrenWrapClass
     * @return string
     */
    public function getHtml($outermostClass = '', $childrenWrapClass = '')
    {
        Mage::dispatchEvent('page_block_html_topmenu_gethtml_before', array(
            'menu' => $this->_menu,
            'block' => $this
        ));

        //$this->_menu = current($this->_menu->getChildren());

        $this->_menu->setOutermostClass($outermostClass);
        $this->_menu->setChildrenWrapClass('');//$childrenWrapClass);

        $html = $this->_getHtml($this->_menu, $childrenWrapClass);

        Mage::dispatchEvent('page_block_html_topmenu_gethtml_after', array(
            'menu' => $this->_menu,
            'html' => $html
        ));

        return $html;
    }

    /**
     * Recursively generates top menu html from data that is specified in $menuTree
     *
     * @param Varien_Data_Tree_Node $menuTree
     * @param string $childrenWrapClass
     * @see Varien_Data_Tree_Node
     * @return string
     */
    protected function _getHtml(Varien_Data_Tree_Node $menuTree, $childrenWrapClass)
    {
        $_html = array();
        $html = '';
        $children = $menuTree->getChildren();
//        die('<div id="dumper_dump">'.dumper::dump($menuTree).'\n\n\n'.dumper::dump($children->getNodes()).'</div>');
//        if($children->count()==1) {
//            $nodes = $children->getNodes();
//            $newTree = current($nodes);
//            return $this->_getHtml($newTree, $childrenWrapClass);
//        }
        $parentLevel = $menuTree->getLevel();
        $childLevel = is_null($parentLevel) ? 0 : $parentLevel + 1;

        $counter = 1;
        $childrenCount = $children->count();

        $parentPositionClass = $menuTree->getPositionClass();
        $itemPositionClassPrefix = $parentPositionClass ? $parentPositionClass . '-' : 'nav-';

        foreach ($children as $child) {

            $outermostClassCode = '';
            $outermostClass = $menuTree->getOutermostClass();
            $targetUrl = $child->getUrl();
            $targetArr = explode("/",$targetUrl);
            $targetPage = array_pop($targetArr);

            if ($childLevel == 0 && $outermostClass) {
                if(Mage::app()->getRequest()->getRequestString() == "/".$targetPage){
                    $outermostClass .= ' selected';
                }
                $outermostClassCode = ' class="' . $outermostClass . '" ';
                $child->setClass($outermostClass);
            }

            $child->setLevel($childLevel);
            $child->setIsFirst($outermostClass!=='nav-main-item'?$counter==1:false);
            $child->setIsLast($outermostClass!=='nav-main-item'?$counter == $childrenCount:false);
            //$child->setPositionClass($itemPositionClassPrefix . $counter);

            $html .= '<li' . ($liInternals = $this->_getRenderedMenuItemAttributes($child)) . '>';
            $html .= '<a href="' . $child->getUrl() . '" ' . !$outermostClassCode . '><span>'
                . $this->escapeHtml($child->getName()) . '</span></a>';

            if ($child->hasChildren()) {
                if (!empty($childrenWrapClass)) {
                    $html .= '<div class="' . $childrenWrapClass . '">';
                }
                $html .= '<ul class="level' . $childLevel . '">';
                $html .= $this->_getHtml($child, $childrenWrapClass);
                $html .= '</ul>';

                if (!empty($childrenWrapClass)) {
                    $html .= '</div>';
                }
            }
            $html .= '</li>';

            $_html[] = $html;
            $html    = '';

            $counter++;
        }

        if(false&&Mage::app()->getRequest()->getRequestString() !== "/") {
            $selected = false;
            foreach($_html as $liInternalCount=>$liHtml) {
                $liInternal = substr($liInternalCount,0,1);
                if(strpos($liInternal,"selected")!==false) {
                    $selected = $liInternal;
                    break;
                }
            }

            if($selected===false) {
                reset($_html);
                $flipped  = array_flip($_html);
                $flippedk = array_keys($flipped);
                $orgFirst = substr($flippedk[0],0,-1);
                $firstKey = array_shift($flipped);
                $newKey   = substr($firstKey,0,-1) . " selected\"";
                $newFirst = str_replace($firstKey,$newKey,$orgFirst);
                $_html[$firstKey] = $newFirst;

            }
        }

        return implode("\n",$_html);
    }

    /**
     * Generates string with all attributes that should be present in menu item element
     *
     * @param Varien_Data_Tree_Node $item
     * @return string
     */
    protected function _getRenderedMenuItemAttributes(Varien_Data_Tree_Node $item)
    {
        $html = '';
        $attributes = $this->_getMenuItemAttributes($item);

        foreach ($attributes as $attributeName => $attributeValue) {
            $html .= ' ' . $attributeName . '="' . str_replace('"', '\"', $attributeValue) . '"';
        }

        return $html;
    }

    /**
     * Returns array of menu item's attributes
     *
     * @param Varien_Data_Tree_Node $item
     * @return array
     */
    protected function _getMenuItemAttributes(Varien_Data_Tree_Node $item)
    {
        $menuItemClasses = $this->_getMenuItemClasses($item);
        $attributes = array(
            'class' => implode(' ', $menuItemClasses)
        );

        return $attributes;
    }

    /**
     * Returns array of menu item's classes
     *
     * @param Varien_Data_Tree_Node $item
     * @return array
     */
    protected function _getMenuItemClasses(Varien_Data_Tree_Node $item)
    {
        $classes = array();

        $classes[] = 'level' . $item->getLevel();
        $classes[] = $item->getPositionClass();

        if ($item->getIsFirst()) {
            $classes[] = 'first';
        }

        if ($item->getIsActive()) {
            $classes[] = 'active';
        }

        if ($item->getIsLast()) {
            $classes[] = 'last';
        }

        if ($item->getClass()) {
            $classes[] = $item->getClass();
        }

        if ($item->hasChildren()) {
            $classes[] = 'parent';
        }

        return $classes;
    }

    /**
     * Retrieve cache key data
     *
     * @return array
     */
    public function getCacheKeyInfo()
    {
        $shortCacheId = array(
            'TOPMENU',
            Mage::app()->getStore()->getId(),
            Mage::getDesign()->getPackageName(),
            Mage::getDesign()->getTheme('template'),
            Mage::getSingleton('customer/session')->getCustomerGroupId(),
            'template' => $this->getTemplate(),
            'name' => $this->getNameInLayout(),
            $this->getCurrentEntityKey()
        );
        $cacheId = $shortCacheId;

        $shortCacheId = array_values($shortCacheId);
        $shortCacheId = implode('|', $shortCacheId);
        $shortCacheId = md5($shortCacheId);

        $cacheId['entity_key'] = $this->getCurrentEntityKey();
        $cacheId['short_cache_id'] = $shortCacheId;

        return $cacheId;
    }

    /**
     * Retrieve current entity key
     *
     * @return int|string
     */
    public function getCurrentEntityKey()
    {
        if (null === $this->_currentEntityKey) {
            $this->_currentEntityKey = Mage::registry('current_entity_key')
                ? Mage::registry('current_entity_key') : Mage::app()->getStore()->getRootCategoryId();
        }
        return $this->_currentEntityKey;
    }
}
