<?php

class Core_Model_Produit extends Zend_Db_Table_Abstract {

    protected $_name = "produits";
    
    protected $_referenceMap    = array(
        'categorie' => array(
            'columns'           => 'idProduitCategorie',
            'refTableClass'     => 'Core_Model_Categorie',
            'refColumns'        => 'id'
        ),      
    );
    
}