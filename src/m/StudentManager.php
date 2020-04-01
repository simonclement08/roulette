<?php
class StudentManager{
    
    private $_db;
  
    public function __construct($db){
        $this->setDb($db);
    }
    
    public function setDb(PDO $db){
        $this->_db = $db;
    }
    
    public function insertdata($scriptinsert){
        $this->_db->exec($scriptinsert);
    }
    
    public function add(Student $objet){
        $surname = $objet->getSurname();
        $firstname = $objet->getFirstname();
        $class = $objet->getClass();
        $section = $objet->getSection();
        $bool = $objet->getBool();
        $passage = $objet->getPassage();
        $absence = $objet->getAbsence();
        $noteaddition = $objet->getNoteaddition();
        $notetotal = $objet->getNotetotal();
        $average = $objet->getAverage();
        $this->_db->exec("INSERT INTO student(surname,firstname,class,section,bool,passage,absence,noteaddition,notetotal,average) VALUES ('$surname', '$firstname', '$class', '$section',  $bool ,  $passage ,  $absence ,  $noteaddition , $notetotal , average )");
    }
    
    public function delete(Student $objet){
        // Exécute une requête de type DELETE.
        $this->_db->exec('DELETE FROM student WHERE id = "'.$objet->getId().'"');
    }
    
    public function deleteClasse($class){
        // Exécute une requête de type DELETE.
        $this->_db->exec('DELETE FROM student WHERE class = "'.$class.'"');
    }

    public function get(){
        $objets = [];
        $q = $this->_db->query("SELECT * FROM student");
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)){
            $objets[] = new Student($donnees);
        }
        return $objets;
    }

    public function getDb($select,$where = null,$order = null,$limit =null){
        $sql = "SELECT $select FROM student";
        if(isset($where)){
            $sql = $sql . " WHERE $where";
        }
        if(isset($order)){
            $sql = $sql . " ORDER BY $order";
        }
        if(isset($limit)){
            $sql = $sql . " LIMIT $limit";
        }
        $q = $this->_db->query($sql);
        return $q;
    }
    
    public function update(Student $objet){
        $id = $objet->getId();
        $surname = $objet->getSurname();
        $firstname = $objet->getFirstname();
        $class = $objet->getClass();
        $section = $objet->getSection();
        $bool = $objet->getBool();
        $passage = $objet->getPassage();
        $absence = $objet->getAbsence();
        $noteaddition = $objet->getNoteaddition();
        $notetotal = $objet->getNotetotal();
        $average = $objet->getAverage();
        // Prépare une requête de type UPDATE.
        $this->_db->exec("UPDATE student SET surname =  '$surname'  , firstname =  '$firstname' , class =  '$class' , section =  '$section' , bool =  $bool , passage =  $passage , absence =  $absence , noteaddition =  $noteaddition , notetotal =  $notetotal , average = $average WHERE id = $id;");
    }

    public function updateDb($set,$where){
        $this->_db->exec("UPDATE student SET $set WHERE $where;");
    }
}
