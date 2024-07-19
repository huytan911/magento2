<?php

namespace Magenest\Blog\Controller\Index;

class Example extends \Magento\Framework\App\Action\Action
{

    protected $title;

    public function execute()
    {
        echo $this->setTitle('Welcome');
    //    echo $this->getTitle();
    }

    public function setTitle($title)
    {
        echo 'Proceed <br>';
        return $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }


}
