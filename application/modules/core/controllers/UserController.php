<?php

class UserController extends Zend_Controller_Action
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
         $this->view->headTitle('Gestion utilisateur');
        
        $ns = new Zend_Session_Namespace('user');
        if($this->_getParam('type') == "apply")
        {        
                $mdp = $_POST['password'];
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $mail = $_POST['mail'];
                $phone = $_POST['phone'];
                $address = $_POST['address'];
                $ville = $_POST['ville'];
                $pays = $_POST['pays'];
                $cp = $_POST['cp'];
                $news =  !isset($_POST['newsletter'])?null:$_POST['newsletter'];
                $user = new Core_Model_User();
                $stat = $user->updateUser($mdp, $firstname, $lastname, $mail, $phone, $address, $ns->data['id'],$ville,$pays,$cp,$news);   
                $ns->data = $stat;
                

        }

        $this->view->firstname = $ns->data['prenom'];
        $this->view->lastname = $ns->data['nom'];
        $this->view->email = $ns->data['email'];
        $this->view->telephone = $ns->data['telephone'];
        $this->view->address = $ns->data['adresse'];
        $this->view->ville = $ns->data['ville'];
        $this->view->pays = $ns->data['pays'];
        $this->view->codepostale = $ns->data['codePostale'];
        $this->view->actif = $ns->data['actif'];
        $this->view->newsletter = $ns->data['newsletter'];
    }
    public function modifyAction()
    {
        $ns = new Zend_Session_Namespace('user');
        $this->view->firstname = $ns->data['prenom'];
        $this->view->lastname = $ns->data['nom'];
        $this->view->email = $ns->data['email'];
        $this->view->telephone = $ns->data['telephone'];
        $this->view->address = $ns->data['adresse'];
        $this->view->ville = $ns->data['ville'];
        $this->view->pays = $ns->data['pays'];
        $this->view->codepostale = $ns->data['codePostale'];
        $this->view->newsletter = $ns->data['newsletter'];
    }
}