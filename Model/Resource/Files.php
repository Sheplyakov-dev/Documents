<?php

class AW_Products_Model_Resource_Files extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('documents/files', 'entity_id');
    }
}