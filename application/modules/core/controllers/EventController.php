<?php

class EventController extends Zend_Controller_Action
{

    public function init()
    {
        zend_session::start();
        $ns = new Zend_Session_Namespace('user');
        
        if(!empty($ns->data))
        {    
            $this->view->firstname = $ns->data['nom'];
            $this->view->lastname = $ns->data['prenom'];
            $this->view->admin = $ns->data['admin'];
        }
    }

    public function indexAction()
    {
        $event = new Core_Model_Event();
        $this->view->event = $event;
        $this->view->events = $event->getNextEvents();
        $this->view->produits = $event->getProduitsEvent();
    }


}