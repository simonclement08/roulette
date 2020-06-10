<?php
class Student{
    private $_id;
    private $_surname;
    private $_firstname;
    private $_class;
    private $_ldap;
    private $_bool;
    private $_passage;
    private $_absence;
    private $_noteaddition;
    private $_notetotal;
    private $_average;
    
    public function __construct(array $donnees){
        $this->hydrate($donnees);
    }
    public function hydrate(array $donnees){
        foreach ($donnees as $key => $value){
            // On récupère le nom du setter correspondant à l'attribut.
            $method = 'set'.ucfirst($key);
            
            // Si le setter correspondant existe.
            if (method_exists($this, $method)){
              // On appelle le setter.
              $this->$method($value);
            }
        }
    }

    public function getId(){
        return  $this->_id;
    }
    
    public function getSurname(){
        return  $this->_surname;
    }
    
    public function getFirstname(){
        return  $this->_firstname;
    }
    
    public function getClass(){
        return  $this->_class;
    }

    public function getLdap(){
        return  $this->_ldap;
    }
    
    public function getBool(){
        return  $this->_bool;
    }
    
    public function getPassage(){
        return  $this->_passage;
    }

    public function getAbsence(){
        return  $this->_absence;
    }
    
    public function getNoteaddition(){
        return  $this->_noteaddition;
    }
    
    public function getNotetotal(){
        return  $this->_notetotal;
    }
    
    public function getAverage(){
        return  $this->_average;
    }

    public function setId(int $id){
        if (is_int($id)){
            $this->_id = $id;
        }
    }

    public function setSurname($surname){
        if ($surname !== ""){
            $this->_surname = $surname;
        }
    }

    public function setFirstname($firstname){
        if ($firstname !== ""){
            $this->_firstname = $firstname;
        }
    }

    public function setClass($class){
        if ($class !== ""){
            $this->_class = $class;
        }
    }

    public function setLdap(bool $ldap){
        if (is_bool($ldap)){
            $this->_ldap = $ldap;
        }
    }

    public function setBool(bool $bool){
        if (is_bool($bool)){
            $this->_bool = $bool;
        }
    }

    public function setPassage(int $passage){
        if (is_int($passage)){
            $this->_passage = $passage;
        }
    }

    public function setAbsence(bool $absence){
        if (is_bool($absence)){
            $this->_absence = $absence;
        }
    }

    public function setNoteaddition($noteaddition){
        if (is_int($noteaddition) or NULL){
            $this->_noteaddition = $noteaddition;
        }
    }

    public function setNotetotal($notetotal){
        if (is_int($notetotal) or NULL){
            $this->_notetotal = $notetotal;
        }
    }

    public function setAverage($average){
        if (is_int($average) or NULL){
            $this->_average = $average;
        }
    }

}