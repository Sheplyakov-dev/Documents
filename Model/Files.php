<?php

class AW_Documents_Model_Files extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init('documents/files');
    }
}