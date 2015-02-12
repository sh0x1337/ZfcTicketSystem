<?php

namespace ZfcTicketSystem;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ],
            ],
        ];
    }

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getServiceConfig()
    {
        return array(
            'invokables' => array(
                'zfcticketsystem_ticketsystem_service' => 'ZfcTicketSystem\Service\TicketSystem',
            ),
            'factories'  => array(
                'zfcticketsystem_ticketsystem_new_form'   => function ( $sm ) {
                    /** @var $sm \Zend\ServiceManager\ServiceLocatorInterface */
                    $form = new Form\TicketSystem( $sm->get( 'Doctrine\ORM\EntityManager' ) );
                    $form->setInputFilter( new Form\TicketSystemFilter( $sm ) );
                    return $form;
                },
                'zfcticketsystem_ticketsystem_entry_form' => function () {
                    $form = new Form\TicketEntry();
                    $form->setInputFilter( new Form\TicketEntryFilter() );
                    return $form;
                },
                'zfcticketsystem_entry_options'           => function ( $sm ) {
                    /** @var $sm \Zend\ServiceManager\ServiceLocatorInterface */
                    $config = $sm->get( 'Configuration' );
                    return new Options\EntityOptions( $config['zfcticketsystem']['entity'] );
                }
            ),
        );
    }
}