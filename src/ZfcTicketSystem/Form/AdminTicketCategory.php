<?php


namespace ZfcTicketSystem\Form;

use Zend\Form\Element;
use ZfcBase\Form\ProvidesEventsForm;

class AdminTicketCategory extends ProvidesEventsForm
{

    public function __construct()
    {
        parent::__construct();
        $this->add([
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'dfhs5ghrth3e4zn43ezj'
        ]);

        $this->add([
            'name' => 'subject',
            'options' => [
                'label' => 'Subject',
            ],
            'attributes' => [
                'placeholder' => 'Subject',
                'class' => 'form-control',
            ],
        ]);

        $this->add([
            'name' => 'sort_key',
            'options' => [
                'label' => 'Sortkey',
            ],
            'attributes' => [
                'placeholder' => 'Sortkey',
                'class' => 'form-control',
            ],
        ]);

        $this->add([
            'name' => 'active',
            'type' => 'Zend\Form\Element\Select',
            'options' => [
                'label' => 'Active',
                'value_options' => [
                    0 => 'deactive',
                    1 => 'active',
                ],
            ],
            'attributes' => [
                'placeholder' => 'Active',
                'class' => 'form-control',
            ],
        ]);

        $submitElement = new Element\Button('submit');
        $submitElement
            ->setLabel('Submit')
            ->setAttributes([
                'class' => 'btn btn-default',
                'type' => 'submit',
            ]);

        $this->add($submitElement, [
            'priority' => -100,
        ]);
    }
}