<?php

namespace Magenest\Movie\Controller\Adminhtml\Movie;

class Save extends \Magento\Backend\App\Action
{
    protected $_movieFactory;
    protected $resultPageFactory;
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magenest\Movie\Model\MovieFactory $movieFactory,
    )
    {
        parent::__construct($context);
        $this->_movieFactory = $movieFactory;
        $this->resultPageFactory = $resultPageFactory;
    }
    public function getMovieId() {
        return $this->getRequest()->getParam('id');
    }
    public function modifyMovieData() {
        $dataRequest = $this->getRequest()->getPostValue();
        $dataObject = (object)$dataRequest;
        $this->_eventManager->dispatch('save_movie', ['movie_abcdefgh' => $dataObject]);
        return (array)$dataObject;
    }
    public function execute()
    {
        $data = $this->modifyMovieData();
        $id = $this->getMovieId();
        $back = $this->getRequest()->getParam('back');
        $movie = $this->_movieFactory->create()->load($id);
        if ($movie->getId()) {
            $movie->addData($data);
            try {
                $movie->save();
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__("Save Error"));
                return $this->_redirect('*/*/edit', ['id' => $movie->getId(), '_current' => true]);
            }
            $this->messageManager->addSuccessMessage(__("Update Success"));

            if ($back) {
                return $this->_redirect('*/*/edit', ['id' => $movie->getId(), '_current' => true]);
            }
        }
        else
        {
            $movie->addData($data);
            try {
                $movie->save();
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__("Save Error"));
            }
            $this->messageManager->addSuccessMessage(__("Save Success"));
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/index', array('_current' => true));
    }
}
