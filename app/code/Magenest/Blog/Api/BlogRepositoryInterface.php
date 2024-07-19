<?php
namespace Magenest\Blog\Api;

use Exception;
use Magenest\Blog\Api\Data\BlogInterface;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\NoSuchEntityException;

interface BlogRepositoryInterface
{
    /**
     * @return BlogInterface[]
     */
    public function getAllBlog();

    /**
     * @param integer $id
     * @return BlogInterface
     */
    public function getBlogById($id);

    /**
     * @param integer $id
     * @return boolean
     */
    public function deleteBlog($id);

    /**
     * @param BlogInterface $blog
     * @return BlogInterface|null
     * @throw Exception
     */
    public function createBlog($blog);

    /**
     * @param BlogInterface $blog
     * @param string $id
     * @return BlogInterface
     * @throws InputException
     * @throws NoSuchEntityException
     * @throws Exception
     */
    public function updateBlog($id, $blog);
}
