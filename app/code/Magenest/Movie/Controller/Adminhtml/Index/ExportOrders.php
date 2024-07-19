<?php

namespace Magenest\Movie\Controller\Adminhtml\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Response\Http\FileFactory;
use Magento\Framework\Exception\FileSystemException;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;

class ExportOrders extends Action
{
    protected $fileFactory;
    protected $orderRepository;
    protected $searchCriteriaBuilder;
    protected $_filesystem;
    protected $product;
    protected $_categoryCollection;

    public function __construct(
        Context                       $context,
        FileFactory                   $fileFactory,
        OrderRepositoryInterface      $orderRepository,
        SearchCriteriaBuilder         $searchCriteriaBuilder,
        \Magento\Framework\Filesystem $filesystem,
        Product $product,
        CollectionFactory $categoryCollection
    )
    {
        $this->fileFactory = $fileFactory;
        $this->orderRepository = $orderRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->_filesystem = $filesystem;
        $this->product = $product;
        $this->_categoryCollection = $categoryCollection;
        parent::__construct($context);
    }

    /**
     * @throws FileSystemException
     * @throws \Exception
     */
    public function execute()
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $orders = $this->orderRepository->getList($searchCriteria)->getItems();
        $csvData = [];
        $csvData[] = ['ID Order', 'Purchase Point', 'Purchase Date', 'Brands','Customer Email', 'Product Name', 'Quantity', 'Product SKU', 'Order Total'];
        foreach ($orders as $order) {
            foreach ($order->getItems() as $item) {
                if($item->getProductType() != 'configurable') {
                    $csvData[] = [
                        $order->getIncrementId(),
                        $order->getStoreName(),
                        $order->getCreatedAt(),
                        $this->getCategoriesName($item->getProductId()),
                        $order->getCustomerEmail(),
                        $item->getName(),
                        $item->getQtyOrdered(),
                        $item->getSku(),
                        $order->getGrandTotal().' '.$order->getOrderCurrencyCode(),
                    ];
                }
            }
        }
        $fileName = 'orders.csv';
        $filePath = 'export/' . $fileName;
        $directory = $this->_filesystem->getDirectoryWrite(DirectoryList::VAR_DIR);
        $stream = $directory->openFile($filePath, 'w+');

        foreach ($csvData as $rowData) {
            $stream->writeCsv($rowData);
        }
        $stream->close();
        $content = [
            'type' => 'filename',
            'value' => $filePath,
            'rm' => true
        ];
        return $this->fileFactory->create($fileName, $content, DirectoryList::VAR_DIR);
    }

    public function getCategoriesName($productId)
    {
        $product = $this->product->load($productId);
        $categoryIds = $product->getCategoryIds();
        $categories = $this->_categoryCollection->create()->addAttributeToSelect('*')->addAttributeToFilter('entity_id', $categoryIds);
        $categoryNames = [];
        foreach ($categories as $category) {
            $categoryNames[] = $category->getName();
        }
        $categoryName = implode(',', $categoryNames);
        return $categoryName;
    }
}
