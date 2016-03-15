<?php

namespace ZfcTicketSystem\Controller;

use Zend\View\Model\ViewModel;
use ZfcTicketSystem\Entity\TicketSubject;

class TicketSystemController extends AbstractController
{
    /**
     * @return ViewModel
     */
    public function indexAction()
    {
        $view = new ViewModel([
            'ticketList' => $this->getTicketService()->getTickets4User($this->getLoggedInUserId())
        ]);
        $view->setTemplate('zfc-ticket-system/index');

        return $view;
    }

    /**
     * @return \Zend\Http\Response|ViewModel
     */
    public function newAction()
    {
        $form = $this->getTicketService()->getTicketSystemNewForm();

        /** @var \Zend\Http\Request $request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $ticketSystem = $this->getTicketService()->newTicket($this->params()->fromPost(),
                $this->getAuthService()->getIdentity());
            if ($ticketSystem) {
                return $this->redirect()->toRoute('zfc-ticketsystem');
            }
        }
        $view = new ViewModel(['form' => $form]);
        $view->setTemplate('zfc-ticket-system/new');

        return $view;
    }

    /**
     * @return \Zend\Http\Response|ViewModel
     */
    public function viewAction()
    {
        $ticketId = $this->params()->fromRoute('id');
        $ticketSubject = $this->getTicketService()->getTicketSubject($this->getLoggedInUserId(), $ticketId);
        // Fallback if no task
        if (!$ticketSubject) {
            return $this->redirect()->toRoute('zfc-ticketsystem');
        }

        $form = $this->getTicketService()->getTicketSystemEntryForm();

        /** @var \Zend\Http\Request $request */
        $request = $this->getRequest();

        if ($request->isPost()) {
            $ticketSubject->setType(TicketSubject::TYPE_NEW);
            $ticketSystem = $this->getTicketService()->newEntry(
                $this->params()->fromPost(),
                $this->getAuthService()->getIdentity(),
                $ticketSubject
            );

            if ($ticketSystem) {
                return $this->redirect()->toRoute('zfc-ticketsystem', ['id' => $ticketId, 'action' => 'view']);
            }
        }

        $entry = $ticketSubject->getTicketEntry();

        $view = new ViewModel([
            'form' => $form,
            'ticket' => $ticketSubject,
            'entry' => $entry
        ]);
        $view->setTemplate('zfc-ticket-system/view');

        return $view;
    }

    /**
     * @return \Zend\Http\Response
     */
    public function closeTicketAction()
    {
        $ticketId = $this->params()->fromRoute('id');
        $ticketSubject = $this->getTicketService()->getTicketSubject($this->getLoggedInUserId(), $ticketId);

        if ($ticketSubject) {
            $this->getTicketService()->closeTicket($ticketSubject);
        }

        return $this->redirect()->toRoute('zfc-ticketsystem');
    }

    /**
     * @return int
     */
    protected function getLoggedInUserId()
    {
        return $this->getAuthService()->getIdentity()->getId();
    }

} 