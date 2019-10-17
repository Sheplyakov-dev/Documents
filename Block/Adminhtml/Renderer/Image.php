<?php
class AW_Documents_Block_Adminhtml_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $value = $row->getData($this->getColumn()->getIndex());
        if($value == "")
        {
            echo "Please Select image";
            return;
        }
        return '<img src='.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).'document/'.$value.' width="50px" height"50px"/>';
    }
}