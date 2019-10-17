<?php
class AW_Documents_Block_Adminhtml_Documents_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'documents';
        $this->_controller = 'adminhtml_documents';

        $this->_updateButton('save', 'label', Mage::helper('documents')->__('Save Document'));
        $this->_updateButton('delete', 'label', Mage::helper('documents')->__('Delete'));
    }
    public function getHeaderText()
    {
        if( Mage::registry('documents_data') && Mage::registry('documents_data')->getId() ) {
            return Mage::helper('documents')->__("Edit Document '%s'", $this->htmlEscape(Mage::registry('documents_data')->getGroup_name()));
        } else {
            return Mage::helper('documents')->__('Add Document');
        }
    }
}