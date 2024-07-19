<?php

namespace Magenest\Movie\Block\Adminhtml\Movie;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    protected $_coreRegistry;

    public function __construct(
        \Magento\Framework\Registry           $coreRegistry,
        \Magento\Backend\Block\Widget\Context $context,
        array                                 $data = []
    )
    {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context, $data);
    }

    protected function _construct()
    {
        $this->_objectId = 'movie_id';
        $this->_blockGroup = 'Magenest_Movie';
        $this->_controller = 'adminhtml_movie';
        parent::_construct();
        $id = $this->getRequest()->getParam('id');
        $this->buttonList->update('save', 'label', __('Save Movie'));
    }

}
