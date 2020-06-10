<?php
class LdapManager
{
	private $_ldapuri;
	private $_dn;
	private $_ldaphost;
	private $_ldapport;
	private $_ldapconn;
	private $_manager;
  
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

    public function getLdapuri()
    {
        return $this->_ldapuri;
    }
    public function getDn()
    {
        return $this->_dn;
    }
    public function getLdaphost()
    {
        return $this->_ldaphost;
    }
    public function getLdapport()
    {
        return $this->_ldapport;
    }
    public function getManager()
    {
        return $this->_manager;
    }

    public function setLdapuri($ldapuri)
    {
        $this->_ldapuri = $ldapuri;
    }
    public function setDn($dn)
    {
        $this->_dn = $dn;
    }
    public function setLdaphost($ldaphost)
    {
        $this->_ldaphost = $ldaphost;
    }
    public function setLdapport($ldapport)
    {
        $this->_ldapport = $ldapport;
    }
    public function setManager(StudentManager $manager)
    {
        $this->_manager = $manager;
    }
        
    public function Read($justthese, $filter)
    {
        $this->_ldapconn = ldap_connect($this->_ldapuri);
    
        ldap_set_option($this->_ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

        $sr = ldap_search($this->_ldapconn, $this->_dn, $filter , $justthese);
        $info = ldap_get_entries($this->_ldapconn, $sr);
        return $info;
    }
    
    public function search_existant($nom, $prenom, $group)
    {
        $search = $this->_manager->getDb("*","surname='$nom' AND firstname='$prenom' AND class='$group'");
        $count = 0;
        foreach($search as $search){
            $count++;
        }
        if($count === 0) {
            return false;
        }
        else{
            return true;
        }
    }

	public function insertUser($selectedGroup)
	{
	    $filter="(|(sn=*)(ou=*))";
        $justthese = ["uid" , "sn" , "givenname" , "mail" , "mobile"];
        $info = $this->Read($justthese , $filter);
        $cpt = 0;
        while($info["count"] > $cpt)
        {
            $group1[$cpt] = "";
            $group2[$cpt] = "";

            if(isset($info[$cpt]["uid"][0]))
            {
                $dn = $info[$cpt]["dn"];
                $posOU = strpos($dn, 'ou=');
                $posVIRG = strpos($dn, ',' ,$posOU);
                //sous groupe
                $group1[$cpt] = substr($dn , $posOU + 3 , $posVIRG - $posOU - 3);

                $posOU = strpos($dn, 'ou',$posVIRG);
                $posVIRG = strpos($dn, ',' ,$posOU);
                //groupe
                $group2[$cpt] = substr($dn , $posOU + 3 , $posVIRG - $posOU -3 );

                if($group2[$cpt] == "STUDENTS" && $group1[$cpt] == $selectedGroup)
                {
                    $donnees['surname']  = $info[$cpt]["sn"][0];
                    $donnees['firstname'] = $info[$cpt]["givenname"][0];
                    $donnees['class'] = $group1[$cpt];
                    $donnees['ldap'] = true;
                    $object = new Student($donnees);
                    if($this->search_existant($donnees['surname'], $donnees['firstname'], $donnees['class']) != true)
                    {
                        $this->_manager->add($object);
                    }
                }
            }
            $cpt++;
        }
    }
    
    public function groups()
    {
        $filter="(|(cn=*)(objectClass=*))";
        $justthese = ["cn" , "uid" , "userpassword"];

        $cpt = 0;
        $info = $this->Read($justthese , $filter);
        while($info["count"] > $cpt)
        {
            $dn = $info[$cpt]["dn"];
            $posOU = strpos($dn, 'ou');
            $posVIRG = strpos($dn, ',' ,$posOU);
            $group1[$cpt] = substr($dn , $posOU + 3 , $posVIRG - $posOU - 3);

            if (!isset($info[$cpt]["uid"][0]) && strpos($dn, 'ou' ,$posOU) != false)
            {
                $posOU = strpos($dn, 'ou',$posVIRG);
                $posVIRG = strpos($dn, ',' ,$posOU);
                //groupe
                $group2 = substr($dn , $posOU + 3 , $posVIRG - $posOU -3 );  
                //substr($dn , $posOU + 3 , $posVIRG - $posOU - 3)
                //echo "<option>". $info[$cpt]["dn"] . "</option>";
                if (isset($info[$cpt]["cn"][0]) && $group2 == "STUDENTS" )
                {
                    if(strpos(" " . $info[$cpt]["cn"][0] , "SISR", 0) == 0 AND strpos( " " . $info[$cpt]["cn"][0] , "SLAM", 0) == 0)
                    {
                        echo  "<option value='". $info[$cpt]["cn"][0] ."'>" . $info[$cpt]["cn"][0] . "</option>" ;
                    }
                }
            }
            $cpt++;
        }  
    }
}
