<?php
namespace Magenest\Blog\Ui\DataProvier\Blog;

use Magenest\Blog\Model\ResourceModel\Blog\CollectionFactory;

class BlogDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
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
}
