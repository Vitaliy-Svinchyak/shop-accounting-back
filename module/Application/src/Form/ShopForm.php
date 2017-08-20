<?php

namespace Application\Form;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Validator\StringLength;

class ShopForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('shop');

        $this->add(array(
            'name' => 'name',
            'type' => 'text',
        ));

        $this->addInputFilter();
    }

    public function addInputFilter()
    {
        $inputFilter = new InputFilter();
        $this->setInputFilter($inputFilter);

        $inputFilter->add([
                'name' => 'name',
                'required' => true,
                'filters' => [
                    ['name' => StringTrim::class],
                    ['name' => StripTags::class],
                ],
                'validators' => [
                    [
                        'name' => StringLength::class,
                        'options' => [
                            'min' => 3,
                            'max' => 50
                        ]
                    ],
                ],
            ]
        );
    }
}