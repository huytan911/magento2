<?php
namespace Magenest\Blog\Api\Data;

interface BlogInterface
{
    const ID = 'id';
    const AUTHOR_ID = 'author_id';

    const TITLE = 'title';
    const DESCRIPTION = 'description';
    const CONTENT = 'content';
    const URL_REWRITE = 'url_rewrite';
    const STATUS = 'status';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const ATTRIBUTES = [
        self::ID,
        self::AUTHOR_ID,
        self::TITLE,
        self::DESCRIPTION,
        self::CONTENT,
        self::URL_REWRITE,
        self::STATUS,
        self::CREATED_AT,
        self::UPDATED_AT
    ];


    /**
     * Get Blog ID
     *
     * @return int|null
     */
    public function getId();
    /**
     * Get Author ID
     *
     * @return int|null
     */
    public function getAuthorId();

    /**
     * Get Title
     *
     * @return string|null
     */
    public function getTitle();

    /**
     * Get Description
     *
     * @return string|null
     */
    public function getDescription();

    /**
     * Get Content
     *
     * @return string|null
     */
    public function getContent();

    /**
     * Get Url Rewrite
     *
     * @return string|null
     */
    public function getUrlRewrite();

    /**
     * Get Status
     *
     * @return int|null
     */
    public function getStatus();

    /**
     * Get Created At
     *
     * @return string|null
     */
    public function getCreatedAt();


    /**
     * Get Updated At
     *
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set ID
     *
     * @param string $id
     *
     * @return $this
     */
    public function setId($id);

    /**
     * Set Author ID
     *
     * @param string $author_id
     *
     * @return $this
     */
    public function setAuthorId($author_id);

    /**
     * Set Title
     *
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title);

    /**
     * Set Content
     *
     * @param string $content
     *
     * @return $this
     */
    public function setContent($content);

    /**
     * Set Description
     *
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description);

    /**
     * Set Url Rewrite
     *
     * @param string $url_rewrite
     *
     * @return $this
     */
    public function setUrlRewrite($url_rewrite);

    /**
     * Set Status
     *
     * @param int $status
     *
     * @return $this
     */
    public function setStatus($status);

    /**
     * Set Created At
     *
     * @param string $created_at
     *
     * @return $this
     */
    public function setCreateAt($created_at);

    /**
     * Set Updated At
     *
     * @param string $updated_at
     *
     * @return $this
     */
    public function setUpdatedAt($updated_at);

}

