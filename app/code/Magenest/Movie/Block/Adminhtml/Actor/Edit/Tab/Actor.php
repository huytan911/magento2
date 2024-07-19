<?php

namespace Magenest\Movie\Block\Adminhtml\Actor\Edit\Tab;

class Actor extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    protected $_coreRegistry;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry             $registry,
        \Magento\Framework\Data\FormFactory     $formFactory,
        array                                   $data = []
    )
    {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    protected function _prepareForm()
    {
        $form = $this->_formFactory->create();
        $fieldset = $form->addFieldset('base_fieldset',
            ['legend' => __('Actor Information')]
        );

        $fieldset->addField('actor_id', 'hidden',
            [
                'name' => 'actor_id',
                'value' => '',
            ]);
        $fieldset->addField('name', 'text',
            [
                'name' => 'name',
                'label' => __('Actor Name'),
                'title' => __('Actor Name'),
                'value' => '',
                'required' => true,
                'readonly' => false
            ]);
        $this->setForm($form);
        return parent::_prepareForm();
    }


    public function getTabLabel()
    {
        return __('Actor information');
    }

    public function getTabTitle()
    {
        return $this->getTabLabel();
    }

    public function canShowTab()
    {
        return true;
    }

    public function isHidden()
    {
        return false;
    }
}
