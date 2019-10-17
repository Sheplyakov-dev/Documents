<?php

class AW_Documents_Adminhtml_DocumentsController extends Mage_Adminhtml_Controller_action
{
    protected function _initAction()
    {
        $this->loadLayout()->_setActiveMenu('aw_documents');
        return $this;
    }

    public function indexAction()
    {
        $this->_title($this->__('Quotes'));

        $this->_initAction();
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_title($this->__('Add new quote'));

        $this->_initAction();
        $this->renderLayout();
    }

    public function editAction()
    {
        $this->_title($this->__('Edit quote'));

        $this->_initAction();
        $this->renderLayout();
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getParam('id', false);

        try {
            Mage::getModel('documents/library')->setId($id)->delete();
            $files = Mage::getModel('documents/files')
                ->getCollection()
                ->addFieldToFilter('document_id', $id);
            foreach ($files as $file){
                $file->delete();
            }
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('freaks_quotes')->__('Quote successfully deleted'));

            return $this->_redirect('*/*/');
        } catch (Mage_Core_Exception $e){
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        } catch (Exception $e) {
            Mage::logException($e);
            Mage::getSingleton('adminhtml/session')->addError($this->__('Somethings went wrong'));
        }

        $this->_redirectReferer();
    }

    public function saveAction()
    {
        $data = $this->getRequest()->getPost();
        if (!empty($data)) {
            try {
                if(isset($_FILES['filename']['name']) && $_FILES['filename']['name'] != ''){
                    $model = Mage::getModel('documents/files');
                    $uploader = new Varien_File_Uploader('filename');
                    foreach ($_FILES as $file){
                        if (pathinfo($file, PATHINFO_EXTENSION) == 'pdf' || pathinfo($file, PATHINFO_EXTENSION) == 'xls' || pathinfo($file, PATHINFO_EXTENSION) == 'xlsx'){
                            $uploader->setAllowedExtensions(['pdf','xls','xlsx']);
                            $type = 'document';
                        }
                        else{
                            $uploader->setAllowedExtensions(['jpg','jpeg','gif','png']);
                            $type = 'document';
                        }
                        $uploader->setAllowRenameFiles(true);
                        $uploader->setAllowCreateFolders(true);
                        $uploader->setFilesDispersion(false);
                        $path = Mage::getBaseDir('media') . DS . 'document';
                        $uploader->save($path, $_FILES['filename']['name']);
                        $model->setData(['document_id' => $data['entity_id'], 'file' => $_FILES['filename']['name'], 'type' => $type]);
                        $model->save();
                    }
                }
                Mage::getModel('documents/library')->setData($data)->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('documents')->__('Document successfully saved'));
            } catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            } catch (Exception $e) {
                Mage::logException($e);
                Mage::getSingleton('adminhtml/session')->addError($this->__('Somethings went wrong'));
            }
        }
        return $this->_redirect('*/*/');
    }

    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('documents/adminhtml_documents_grid')->toHtml()
        );
    }

}