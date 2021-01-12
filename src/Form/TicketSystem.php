<?php

namespace ZfcTicketSystem\Form;

use Doctrine\ORM\EntityManagerInterface;
use DoctrineModule\Form\Element\ObjectSelect;
use Laminas\Form;
use ZfcTicketSystem\Options\EntityOptions;

class TicketSystem extends Form\Form
{
    /** @var EntityManagerInterface */
    protected $entityManager;

    /** @var EntityOptions */
    protected $entityOptions;

    /**
     * TicketSystem constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param EntityOptions          $entityOptions
     */
    public function __construct(EntityManagerInterface $entityManager, EntityOptions $entityOptions)
    {
        $this->entityManager = $entityManager;
        $this->entityOptions = $entityOptions;

        parent::__construct();
    }

    public function init(): void
    {
        $this->add([
            'type' => Form\Element\Csrf::class,
            'name' => 'fdh456eh56ujzum45zkuik45zhrh',
            'options' => [
                'csrf_options' => [
                    'timeout' => 600,
                ],
            ],
        ]);

        $this->add([
            'name' => 'subject',
            'options' => [
                'label' => 'Betreff:',
            ],
            'attributes' => [
                'placeholder' => 'Betreff',
                'class' => 'form-control',
                'type' => 'text'
            ],
        ]);
        $this->add([
            'name' => 'categoryId',
            'type' => ObjectSelect::class,
            'options' => [
                'object_manager' => $this->entityManager,
                'target_class' => $this->entityOptions->getTicketCategory(),
                'property' => 'subject',
                'label' => 'Kategorie:',
                'empty_option' => 'auswählen',
                'is_method' => true,
                'find_method' => [
                    'name' => 'getActiveCategory',
                ],
            ],
            'attributes' => [
                'class' => 'form-control',
            ],
        ]);
        $this->add([
            'name' => 'memo',
            'type' => Form\Element\Textarea::class,
            'options' => [
                'label' => 'Beschreibung:',
            ],
            'attributes' => [
                'placeholder' => 'hier können Sie uns Ihr Anliegen schildern.',
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