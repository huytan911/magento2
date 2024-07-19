<?php
namespace Magenest\Movie\Block\Adminhtml\Form\Field;

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;

class Ranges extends AbstractFieldArray
{

    private $colorPicker;


    protected function _prepareToRender()
    {
        $this->addColumn('color', ['label' => __('Color'), 'class' => 'required-entry']);
        $this->addColumn('color_code', [
            'label' => __('Color Code'),
            'renderer' => $this->getColorPicker()
        ]);
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add Record');
    }


    private function getColorPicker()
    {
        if (!$this->colorPicker) {
            $this->colorPicker = $this->getLayout()->createBlock(
                ColorPicker::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]
            );
        }
        return $this->colorPicker;
    }
}
