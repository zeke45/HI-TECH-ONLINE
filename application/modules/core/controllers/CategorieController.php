<?php

class CategorieController extends Zend_Controller_Action
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
        $id_category = $this->_getParam('sous_categorie');
        $categorie = new Core_Model_Categorie();
        $produit = $categorie->getProduitByCategory($id_category);
        
        $produit = $categorie->convertImageSousRubrique($produit);
        $this->view->produit = $produit;
    }


}
