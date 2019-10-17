<?php

class AW_Documents_Model_Library extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init('documents/library');
    }
}