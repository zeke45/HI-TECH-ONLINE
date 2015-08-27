<?php

class IndexController extends Zend_Controller_Action
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
    
   
        
        if($this->_getParam('login') == true)
        {
            
            echo "<script>alert('Ce login existe déjà.');</script>";
            
        }
        
        if ($this->_request->isPost()) {         
            //sign in
            if ($this->_getParam('type') == 'signin') {
                
                $login = $_POST['username'];
                $mdp = $_POST['password'];
                
                $user = new Core_Model_User();
                $connection = $user->login($login, $mdp);
                if (!isset($connection['id'])) {
                    echo "vous n'exister pas";
                } else {
                    $this -> sess = new Zend_Session_Namespace('user');
                    $this -> sess->data = $connection;
                    
                    $this->_redirect($this->view->url(array('controller' => 'index', 'action' => 'index'),null,true));
                }
            // sign up
            } elseif ($this->_getParam('type') == 'signup') {
                
                $login = $_POST['username'];
                $mdp = $_POST['password'];
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $mail = $_POST['email'];
                $phone = $_POST['phone'];
                $address = $_POST['address'];
                $cp = $_POST['cp'];
                $ville = $_POST['ville'];
                $pays = $_POST['pays'];
                $news = $_POST['newsletter'];
                $user = new Core_Model_User();
                $verif = $user->loginExist($login);
                if($verif > 0)
                {
                    $this->_redirect($this->view->url(array('controller' => 'index', 'action' => 'index','login'=>false), null, true));
                }
                $stat = $user->inscription($login, $mdp, $firstname, $lastname, $mail, $phone, $address,$ville,$pays,$cp,$news);
                $this->_redirect($this->view->url(array('controller' => 'index', 'action' => 'index'), null, true));
                if ($stat != -1) {
                    echo "vous êtes inscrit";
                } else {
                    echo "erreur lors de l'enregistrement";
                }
            }
        }
    }
    
    public function destroyAction() 
    {
        Zend_Session:: namespaceUnset("user");
        Zend_Session::destroy(true);
        $this->_redirect($this->view->url(array('controller' => 'index', 'action' => 'index'), null, true));
    }

}

