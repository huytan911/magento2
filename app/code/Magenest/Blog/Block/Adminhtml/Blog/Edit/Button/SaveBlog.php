<?php


namespace Magenest\Blog\Block\Adminhtml\Blog\Edit\Button;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveBlog implements ButtonProviderInterface
{
    public function getButtonData()
    {
        return [
            'label' => __('Save Blog'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 90
        ];
    }
}
