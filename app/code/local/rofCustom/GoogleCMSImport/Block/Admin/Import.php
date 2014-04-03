<?php
class Rofcustom_Googlecmsimport_Block_Admin_Import extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_controller = 'admin_import';
        $this->_blockGroup = 'googlecmsimport';
        $this->_headerText = Mage::helper('googlecmsimport')->__('Google CMS Import');
        $this->_addButtonLabel = Mage::helper('googlecmsimport')->__('Import from Google Drive');
        parent::__construct();
    }
}