<?php
namespace Magenest\Movie\Block\Adminhtml\Actor\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    protected function _construct()
    {
        parent::_construct();
        $this->setId('actor_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Actor Information'));
    }
}
