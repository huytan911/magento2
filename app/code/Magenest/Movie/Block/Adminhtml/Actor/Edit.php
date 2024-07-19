<?php
namespace Magenest\Movie\Block\Adminhtml\Actor;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    protected $_coreRegistry;

    public function __construct(
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Backend\Block\Widget\Context $context,
        array $data = []
    )
    {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context, $data);
    }

    protected function _construct()
    {
        $this->_objectId = 'actor_id';
        $this->_blockGroup = 'Magenest_Movie';
        $this->_controller = 'adminhtml_actor';
        parent::_construct();
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            $this->buttonList->add(
                'saveandcontinue',
                [
                    'label' => __('Save and Continue Edit'),
                    'class' => 'save',
                    'data_attribute' => [
                        'mage-init' => [
                            'button' => [
                                'event' => 'saveAndContinueEdit',
                                'target' => '#edit_form'
                            ]
                        ]
                    ]
                ],
                -100
            );
        }
        $this->buttonList->update('save', 'label', __('Save Actor'));
    }

}
