<?php

class AW_Documents_Model_Resource_Collection_Files extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('documents/files');
    }
}