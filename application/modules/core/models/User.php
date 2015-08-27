<?php

class Core_Model_User extends Zend_Db_Table_Abstract {

    protected $_name = "utilisateurs";
    
    public function login($username,$password)
    {
        try {
        
            $select = $this->select()
                    ->setIntegrityCheck(false)
                    ->where('pseudonyme = ?', $username)
                    ->where('password = ?', $password);
            $row = $this->fetchAll($select)->toArray();

            $flag = false;
            if (!empty($row[0]) && sizeof($row[0]) > 0) {
                $flag = $row[0];
            }
        } 
        catch (Exception $ex) {
            echo $ex->getMessage();
         
        }
        return $flag;
    }
    
    public function getUserData($id) {
        try {
            
            $select = $this->select()
                    ->setIntegrityCheck(false)
                    ->where('id = ?', $id);
            $row = $this->fetchAll($select)->toArray();
            
            $this->data = $row[0];
        
            $flag = false;
            if (sizeof($this->data) > 0) {
                $flag = $this->data;
            }
        } 
        catch (Exception $ex) {
            echo $ex->getMessage();
         
        }
        return $flag;
    }
    

    public function inscription($login, $password, $firstname, $lastname, $mail, $phone, $address,$ville,$pays,$cp,$newsletter) {
        try {
            $data = array(
                'pseudonyme' => $login,
                'password' => $password,
                'nom' => $lastname,
                'prenom' => $firstname,
                'email' => $mail,
                'telephone' => $phone,
                'adresse' => $address,
                'ville' => $ville,
                'pays' => $pays,
                'codePostale' => $cp,
                'actif' => 1,
                'newsletter' => $newsletter == 'on'?1:0
                 );
            
           
            return $this->insert($data);
            
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        
    }
    
    public function updateUser($password, $firstname, $lastname, $mail, $phone, $address,$id, $ville,$pays,$cp,$newsletter) {
        try {
            if($password == '')
            {
                $data = array(
                    'nom' => $lastname,
                    'prenom' => $firstname,
                    'email' => $mail,
                    'telephone' => $phone,
                    'adresse' => $address,
                    'ville' => $ville,
                    'pays' => $pays,
                    'codePostale' => $cp,
                    'newsletter' => $newsletter == 'on'?1:0
                );
            }
            
            else
            {
                $data = array(
                    'password' => $password,
                    'nom' => $lastname,
                    'prenom' => $firstname,
                    'email' => $mail,
                    'telephone' => $phone,
                    'adresse' => $address,
                    'ville' => $ville,
                    'pays' => $pays,
                    'codePostale' => $cp,
                    'actif' => $actif,
                    'newsletter' => $newsletter == 'on'?1:0
                );
            }          
            $result = false;  
            if ($this->update($data,'id = '. $id) != -1) {
                
                $result = $this->getUserData($id);
                
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        return $result;
    }
    
    
    public function loginExist($login) {
        try {
            
            $select = $this->select()
                    ->setIntegrityCheck(false)
                    ->where('pseudonyme = ?', $login);
            $row = $this->fetchAll($select)->toArray();
            return sizeof($row[0]);
        } 
        catch (Exception $ex) {
            echo $ex->getMessage();
         
        }
        
    }
    
}
