<?php
namespace Magenest\Blog\Model\ResourceModel\Blog;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'magenest_blog_collection';
    protected $_eventObject = 'blog_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Magenest\Blog\Model\Blog', 'Magenest\Blog\Model\ResourceModel\Blog');
    }

    public function getAuthorBlog() {
        $this
            ->addFieldToSelect('*')
            ->join(
                ['au' => $this->getTable('admin_user')],
                'main_table.author_id = au.user_id',
                ['author_name' => 'concat(firstname, " ", lastname)']
            )
            ->getSelect();
        return $this;
    }
}

