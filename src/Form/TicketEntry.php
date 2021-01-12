<?php

namespace ZfcTicketSystem\Form;

use Laminas\Form;

class TicketEntry extends Form\Form
{
    public function init(): void
    {
        $this->add([
            'type' => Form\Element\Csrf::class,
            'name' => 'fdh456eh56ujzum45zkuik45zhrh',
        ]);

        $this->add([
            'name' => 'memo',
            'type' => Form\Element\Textarea::class,
            'options' => [
                'label' => 'Text:',
            ],
            'attributes' => [
                'placeholder' => 'hier schreiben...',
                'class' => 'form-control',
            ],
        ]);

        $submitElement = new Form\Element\Button('submit');
        $submitElement
            ->setLabel('Absenden')
            ->setAttributes([
                'class' => 'btn btn-primary',
                'type' => 'submit',
            ]);

        $this->add($submitElement, [
            'priority' => -100,
        ]);
    }
} 