<?php
namespace Magenest\Movie\Block;
class Display extends \Magento\Framework\View\Element\Template
{
    protected $_hello;
    protected $_movieFactory;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magenest\Movie\Model\MovieFactory $movieFactory,
        $hello = '123456789',
    )
    {
        $this->_movieFactory = $movieFactory;
        $this->_hello = $hello;
        parent::__construct($context);
    }


    public function getMovieCollection(){
        $movie = $this->_movieFactory->create();
        $a = $movie->getCollection()->getMovieData();
        return $a;
    }
    public function getTest() {
        return $this->_hello;
    }
}
