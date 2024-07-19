<?php
namespace Magenest\Blog\Controller\Index;

use Magento\Framework\App\Action\Context;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class Test extends \Magento\Framework\App\Action\Action {

    protected $resultPageFactory;
    protected $collectionFactory;
    public function __construct(
        Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        CollectionFactory $collectionFactory,
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $collection = $this->collectionFactory->create();
        $collection->load();
        echo $collection->getSize() . '<br>';

        $collection->setPageSize(2);

        $collection->load();
        $collection->addFieldToFilter('type_id', ['eq' => 'simple']);
        echo $collection->getSize();

        return $this->resultPageFactory->create();
    }
}
