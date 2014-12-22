<?php
/** Include the database file */
include_once 'db/db.php';
/**
 * The main class of login
 * All the necesary system functions are prefixed with _
 * examples, _login_action - to be used in the login-action.php file
 * _authenticate - to be used in every file where admin restriction is to be inherited etc...
 * @author Swashata <swashata@intechgrity.com>
 */

/*-----------*/
class cours 
{
    private $_code ;
    private $_intitule ;
	private $_fkProf;
	private $_local;
	private $_annee ;
    
    public function hydrate($donnees)
    {
        foreach($donnees as $key => $value)
        {
            $method = 'set_' .ucfirst($key) ;            
        
            if(method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }
            
//=> CONSTRUCTEUR
            
    public function __construct (array$donnees)
    {
         $this->hydrate($donnees);
    }
    
  //  GETTEURS => 
    
    public function get_code() 
    {
        return $this->_code;
    }
	
	public function get_intitule() 
    {
        return $this->_intitule;
    }
	
	public function get_fkProf() 
    {
        return $this->_fkProf;
    }
	
	public function get_local() 
    {
        return $this->_local;
    }
	
	public function get_annee() 
    {
        return $this->_annee;
    }

    // SETTEURS => 
    
    public function set_code($_code) 
    {
        $this->_code = $_code;
    }
	
	public function set_intitule($_intitule) 
    {
        $this->_intitule = $_intitule;
    }
	
	public function set_fkProf($_fkProf) 
    {
        $this->_fkProf = $_fkProf;
    }
	
	public function set_local($_local) 
    {
        $this->_local = $_local;
    }
   
	public function set_annee($_annee) 
    {
        $this->_annee = $_annee;
    }

}

//      MANAGER => PARTICIPANT
//      xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

class coursManager
{
    
    private $_db ; 
    // CONNECTION PDO 
    
    function __construct($_db) 
    {
        $this->_db = $_db;
    }
    public function add(cours $part)
    {        
        
		$annee=$part->get_annee();
		$intitule=$part->get_intitule();
		
		$fkProf=$part->get_fkProf();
		
		$local=$part->get_local();
		//echo"$intitule, $annee, $fkProf";
		try {
			$req="INSERT INTO cours (annee, intitule, fkProf, local) VALUES ('$annee','$intitule','$fkProf','$local')";
			// use exec() because no results are returned
			$this->_db->exec($req);
			//echo "New record created successfully";
		   }
		catch(PDOException $e)
			{
			echo $req . "<br>" . $e->getMessage();
			}
		
    }
    

	 public function getAll()
    {
        $etuds=array();
        
        $req='SELECT * FROM cours';
        $q = $this->_db->query($req);     
        $cpt=0;
        while($donnees = $q->fetch())
        {
			
            $etuds[$cpt]=new cours($donnees);
			
			
			$cpt++;
        }   
        //return  $q;
        if($cpt==0){echo' <SCRIPT LANGUAGE="Javascript">alert("PARTICIPANT PAS TROUVE!")</SCRIPT>';};
        
        return  $etuds; 
        
    }
    
    public function update(cours $part) 
    // CHANGER UNIQUEMENT L'ADRESSE !!!!         
    {   
        
        $fkProf=$part->get_fkProf();
		$annee=$part->get_annee();
		$intitule=$part->get_intitule();

		$code=$part->get_code();
		//$statut=$part->get_statut();
	
		
        $q = $this->_db->query('UPDATE cours  SET annee = "'.$part->get_annee().'" WHERE code  = "'.$part->get_code().'"');
		$q = $this->_db->query('UPDATE cours  SET intitule = "'.$part->get_intitule().'" WHERE code  = "'.$part->get_code().'"');
		$q = $this->_db->query('UPDATE cours  SET local = "'.$part->get_local().'" WHERE code  = "'.$part->get_code().'"');
		$q = $this->_db->query('UPDATE cours  SET fkProf = "'.$part->get_fkProf().'" WHERE code  = "'.$part->get_code().'"');
		
        
    }   
    public function get($id)
        {
            $id = (int) $id;
            
            //$q = $this->_db->query('SELECT fkProf, annee, intitule, adresse, login, password FROM cours WHERE fkProf = '.$id);
			$q = $this->_db->query('SELECT code, intitule, local, fkProf, annee FROM cours WHERE code = '.$id);
            $donnees = $q->fetch(PDO::FETCH_ASSOC);
            
            return new cours($donnees);
        }
		
	public function effacer($id)
        {
            $id = (int) $id;
            
           	$q = $this->_db->query('DELETE FROM cours WHERE code= '.$id);
            
        }

	public function get_profid($annee , $intitule)
    {
        $etuds=array();
      
        $req='SELECT fkProf FROM cours WHERE annee LIKE "'.$code.'%" AND intitule LIKE "'.$intitule.'%"';
        $q = $this->_db->query($req);     
        $cpt=0;
        while($donnees = $q->fetch())
        {

            $studs[$cpt]=new cours($donnees);
			
			
			$cpt++;
        }   
        
        if($cpt==0){echo' <SCRIPT LANGUAGE="Javascript">alert("PARTICIPANT PAS TROUVE!")</SCRIPT>';};
        return  $studs[$cpt-1]->get_fkProf(); 
		
        
    }
 }

?>
