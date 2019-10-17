<?php
class AW_Documents_Block_Adminhtml_Adminimage_Image extends Varien_Data_Form_Element_Image
{
    protected function _getUrl(){
        $url = false;
        if ($this->getValue()) {
            $url = Mage::getBaseUrl('media').'document/'.$this->getValue();
        }
        return $url;
    }
}