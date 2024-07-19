<?php
namespace Magenest\HelloWorld\Model;
class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'magenest_helloworld_post';

    protected $_cacheTag = 'magenest_helloworld_post';

    protected $_eventPrefix = 'magenest_helloworld_post';

    protected function _construct()
    {
        $this->_init('Magenest\HelloWorld\Model\ResourceModel\Post');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}
