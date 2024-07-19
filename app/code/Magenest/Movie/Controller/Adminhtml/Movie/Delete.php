<?php

namespace Magenest\Movie\Controller\Adminhtml\Movie;

use Magenest\Movie\Model\ResourceModel\Movie\CollectionFactory as MovieCollectionFactory;
use Magento\Backend\App\Action\Context;
use Magento\Backend\App\Action;
class Delete extends Action
{
    protected $_movieCollectionFactory;
    public function __construct(
        Context $context,
        MovieCollectionFactory $movieCollectionFactory,
    )
    {
        parent::__construct($context);
        $this->_movieCollectionFactory = $movieCollectionFactory;
    }

    public function execute()
    {
        $ids = $this->getRequest()->getParam('selected', []);
        try {
            $movieCollection = $this->_movieCollectionFactory->create()
                ->addFieldToFilter('movie_id', array('in' => $ids));
            $movieCollection->walk('delete');

            $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', count($ids)));
        }
        catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Delete error: %1', $e->getMessage()));
        }
        $resultRedirect = $this->resultRedirectFactory->create();

        return $resultRedirect->setPath('*/*/index', array('_current' => true));
    }

}
