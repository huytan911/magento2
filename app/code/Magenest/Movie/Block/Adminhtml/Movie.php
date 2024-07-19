<?php
namespace Magenest\Movie\Block\Adminhtml;

class Movie extends \Magento\Backend\Block\Widget\Grid\Container {

    protected function _construct() {
        $this->_controller = 'adminhtml_movie';
        $this->_blockGroup = 'Magenest_Movie';
        $this->_headerText = __('Movies');
        $this->_addButtonLabel = __('Create New Movie');
        parent::_construct();
    }
}
