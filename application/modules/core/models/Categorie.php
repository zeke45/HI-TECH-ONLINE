<?php

class Core_Model_Categorie extends Zend_Db_Table_Abstract {

    protected $_name = "categories";
    
    protected $_dependentTables = array('Core_Model_Produit');
    
    public function getRubrique() {
        
        $select = $this->select()
                ->setIntegrityCheck(false)
                ->from('categories', array('id', 'nomCategorie', 'description'));
        try {
            $tab = $this->fetchAll($select)->toArray();
            
        } catch (Exception $ex) {

            echo 'ERROR_SELECT_GETARTICLES : ' . $ex->getMessage();
            return false;
        }
        return $tab;
    }

    public function getSousRubrique() {
        $select = $this->select()
                ->setIntegrityCheck(false)
                ->from('souscategories', array('id', 'nomCategorie', 'categorie_id','image'));
        try {
            $tab = $this->fetchAll($select)->toArray();
        } catch (Exception $ex) {

            echo 'ERROR_SELECT_GETARTICLES : ' . $ex->getMessage();
            return false;
        }
        return $tab;
    }

    public function convertImageSousRubrique($ssrubrique) {
        foreach ($ssrubrique as &$p) {
            $p['img64'] = base64_encode($p['image']);
            $p['type'] = @pathinfo($p['nom'], PATHINFO_EXTENSION);
        }
        return $ssrubrique;
    }

    public function getProduitByCategory($categorie) {
        
        $select = $this->select()
                ->setIntegrityCheck(false)
                ->from('produits')
                ->where('idProduitCategorie = ?', $categorie);
        
        try {
            $tab = $this->fetchAll($select)->toArray();
        } catch (Exception $ex) {

            echo 'ERROR_SELECT_GETARTICLES : ' . $ex->getMessage();
            return false;
        } 
        return $tab;
    }

}