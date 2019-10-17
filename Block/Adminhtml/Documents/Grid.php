<?php
class AW_Documents_Block_Adminhtml_Documents_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('documentsGrid');
        $this->setDefaultSort('std_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('documents/library');
        $select = $collection->getSelect();
        $resource = Mage::getSingleton('core/resource');
            $select->join(
                ['files' => $resource->getTableName('documents_files')],
                'main_table.entity_id = files.document_id',
                ['documents']
            );
        $this->setCollection($select);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('entity_id', [
            'header'    => Mage::helper('documents')->__('ID'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'entity_id',
        ]);

        $this->addColumn('title', [
            'header'    => Mage::helper('documents')->__('Title'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'title',
        ]);

        $this->addColumn('file', [
            'header'    => Mage::helper('documents')->__('image'),
            'width'     => '97',
            'align'     =>'left',
            'index'     => 'filename',
            'renderer' => 'AW_Documents_Block_Adminhtml_Renderer_Image'

        ]);

        $this->addColumn('status', [
            'header'    => Mage::helper('documents')->__('status'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'status',
            'type'      => 'options',
            'options'    => array(
                0 => 'enable',
                1 => 'disable'
            ),
        ]);
        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}
