<?php
class AW_Documents_Block_Adminhtml_Document extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_documents';
        $this->_blockGroup = 'documents';
        $this->_headerText = Mage::helper('documents')->__('Manager');
        $this->_addButtonLabel = Mage::helper('documents')->__('Add Document');
        parent::__construct();

    }
}