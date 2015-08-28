<?php

class Core_Model_Event extends Zend_Db_Table_Abstract {

    protected $_name = "evenements";
    
    public function getNextEvents()
    {          
        $select = $this->select()
                ->setIntegrityCheck(false)
                ->where('dateFin >= ?', date('Y-m-d H:i:s'));
        $row = $this->fetchAll($select)->toArray();

        $flag = false;
        if (!empty($row[0]) && sizeof($row[0]) > 0) {
            $flag = $row;
        }
        return $flag;
    }
    public function getProduitsEvent()
    {          
        $select = $this->select()
                ->from('evenements_produits')
                ->setIntegrityCheck(false);
        $row = $this->fetchAll($select)->toArray();

        $flag = false;
        if (!empty($row[0]) && sizeof($row[0]) > 0) {
            $flag = $row;
        }
        return $flag;
    }
    
    public function InEvent($idUser,$idEvent)
    {          
        $select = $this->select()
                ->from('evenements_clients')
                ->setIntegrityCheck(false)
                ->where('client_id = ?', $idUser)
                ->where('evenements_id = ?', $idEvent);
        $row = $this->fetchAll($select)->toArray();

        $flag = false;
        if (!empty($row[0]) && sizeof($row[0]) > 0) {
            $flag = $row[0];
        }
        return $flag;
    }
}