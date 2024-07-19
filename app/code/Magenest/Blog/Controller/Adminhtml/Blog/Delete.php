<?php


namespace Magenest\Blog\Controller\Adminhtml\Blog;

//use Magenest\Blog\Model\ResourceModel\Blog\CollectionFactory;

class Delete extends \Magento\Backend\App\Action
{
    protected $_blogFactory;

//    protected $_blogCollectionFactory;
    protected $helperData;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magenest\Blog\Model\BlogFactory  $blogFactory,
        \Magenest\Blog\Helper\Data $helperData,
//        CollectionFactory $blogCollectionFactory,
    )
    {
        parent::__construct($context);
        $this->_blogFactory = $blogFactory;
        $this->helperData = $helperData;
//        $this->_blogCollectionFactory = $blogCollectionFactory;
    }

    public function execute()
    {
        $blog = $this->_blogFactory->create();
        $ids = $this->getRequest()->getParam('selected', []);
        try {
            /**
             * $blog = $this->_blogCollectionFactory->create()
             *          ->addFiledToFilter('id', array('in' => $ids))
             * $blog->walk('delete')
             * $this->messageManager->addSuccess(__('A total of %1 record(s) have been deleted.', count($categoriesIds)));
             */
            foreach ($ids as $id) {
                $data = $blog->load($id);
                $this->helperData->deleteUrlRewrite($data->getData('url_rewrite'));
                if ($data->getId()) {
                    $a = $blog->delete();
                } else {
                    echo 'Invalid';
                    $resultRedirect = $this->resultRedirectFactory->create();
                    return $resultRedirect->setPath('*/*/index', array('_current' => true));
                }
            }
            $this->messageManager->addSuccessMessage(__('You deleted these blog.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Delete error: %1.', $e->getMessage()));
        }
        $resultRedirect = $this->resultRedirectFactory->create();

        return $resultRedirect->setPath('*/*/index', array('_current' => true));
    }

}
