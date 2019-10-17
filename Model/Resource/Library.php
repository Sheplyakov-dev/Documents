<?php

class AW_Products_Model_Resource_Library extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('documents/library', 'entity_id');
    }
}