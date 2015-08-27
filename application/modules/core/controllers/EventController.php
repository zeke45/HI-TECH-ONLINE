<?php

class EventController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $event = new Core_Model_Event();
        var_dump($event->getNextEvents());
        var_dump($event->getProduitsEvent(1));
        var_dump($event->InEvent(1,1));
    }


}