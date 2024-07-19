<?php
namespace Magenest\Blog\Model;

use Magenest\Blog\Model\ResourceModel\Blog\CollectionFactory;

class DataProviderListing extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $_loadedData;
    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $blogFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $blogFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $blogFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $blog) {
            $this->_loadedData[$blog->getId()] = $blog->getData();
        }
        return $this->_loadedData;
    }
}
