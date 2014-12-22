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
class seance 
{
    private $_idSeance ;
	private $_date ;
    private $_heureDebut ;
	private $_heureFin ;
	private $_idLocal;
	private $_idProf;
	private $_idCours;
	
    
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
    
    public function get_idSeance() 
    {
        return $this->_idSeance;
    }
	
	public function get_date() 
    {
        return $this->_date;
    }
	
	public function get_heureDebut() 
    {
        return $this->_heureDebut;
    }
	
	public function get_heureFin() 
    {
        return $this->_heureFin;
    }
	
	public function get_idLocal() 
    {
        return $this->_idLocal;
    }
	
	public function get_idProf() 
    {
        return $this->_idProf;
    }
	
	public function get_idCours() 
    {
        return $this->_idCours;
    }

	

    // SETTEURS => 
    
    public function set_idSeance($_idSeance) 
    {
        $this->_idSeance = $_idSeance;
    }
	
	public function set_date($_date) 
    {
        $this->_date = $_date;
    }
	
	public function set_heureDebut($_heureDebut) 
    {
        $this->_heureDebut = $_heureDebut;
    }
	
	public function set_heureFin($_heureDebut) 
    {
        $this->_heureFin = $_heureDebut;
    }
	
	public function set_idLocal($_idLocal) 
    {
        $this->_idLocal = $_idLocal;
    }
	
	public function set_idProf($_idProf) 
    {
        $this->_idProf = $_idProf;
    }
	
	public function set_idCours($_idCours) 
    {
        $this->_idCours = $_idCours;
    }
}

//      MANAGER => PARTICIPANT
//      xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

class seanceManager
{
    
    private $_db ; 
    // CONNECTION PDO 
    
    function __construct($_db) 
    {
        $this->_db = $_db;
    }
    public function add(seance $part)
    {        
        
		$date=$part->get_date();
		$heureDebut=$part->get_heureDebut();
		$heureFin=$part->get_heureFin();
		
		$idLocal=$part->get_idLocal();
		$idProf=$part->get_idProf();
		$idCours=$part->get_idCours();
		
		//echo"$heureDebut, $date, $idProf";
		try {
			$req="INSERT INTO seance (date, heureDebut, heureFin, idLocal, idProf, idCours) VALUES ('$date','$heureDebut','$heureFin','$idLocal','$idProf','$idCours')";
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
        
        $req='SELECT * FROM seance';
        $q = $this->_db->query($req);     
        $cpt=0;
        while($donnees = $q->fetch())
        {
			
            $etuds[$cpt]=new seance($donnees);
			
			
			$cpt++;
        }   
        //return  $q;
        if($cpt==0){echo' <SCRIPT LANGUAGE="Javascript">alert("PARTICIPANT PAS TROUVE!")</SCRIPT>';};
        
        return  $etuds; 
        
    }
    
    public function update(seance $part) 
    // CHANGER UNIQUEMENT L'ADRESSE !!!!         
    {   
        
        $idProf=$part->get_idProf();
		$date=$part->get_date();
		$heureDebut=$part->get_heureDebut();

		$idSeance=$part->get_idSeance();
		//$statut=$part->get_statut();
	
		
        $q = $this->_db->query('UPDATE seance  SET date = "'.$part->get_date().'" WHERE idSeance  = "'.$part->get_idSeance().'"');
		$q = $this->_db->query('UPDATE seance  SET heureDebut = "'.$part->get_heureDebut().'" WHERE idSeance  = "'.$part->get_idSeance().'"');

		$q = $this->_db->query('UPDATE seance  SET idProf = "'.$part->get_idProf().'" WHERE idSeance  = "'.$part->get_idSeance().'"');
		
        
    }   
    public function get($id)
        {
            $id = (int) $id;
            
            //$q = $this->_db->query('SELECT idProf, date, heureDebut, adresse, login, password FROM seance WHERE idProf = '.$id);
			$q = $this->_db->query('SELECT idSeance, date, heureDebut, heureFin, idLocal, idProf, idCours FROM seance WHERE idCours = '.$id);
            $donnees = $q->fetch(PDO::FETCH_ASSOC);
            
            return new seance($donnees);
        }
		
	public function effacer($id)
        {
            $id = (int) $id;
            
           	$q = $this->_db->query('DELETE FROM seance WHERE idSeance= '.$id);
            
        }

	public function get_profid($date , $heureDebut)
    {
        $etuds=array();
      
        $req='SELECT idProf FROM seance WHERE date LIKE "'.$idSeance.'%" AND heureDebut LIKE "'.$heureDebut.'%"';
        $q = $this->_db->query($req);     
        $cpt=0;
        while($donnees = $q->fetch())
        {

            $studs[$cpt]=new seance($donnees);
			
			
			$cpt++;
        }   
        
        if($cpt==0){echo' <SCRIPT LANGUAGE="Javascript">alert("PARTICIPANT PAS TROUVE!")</SCRIPT>';};
        return  $studs[$cpt-1]->get_idProf(); 
		
        
    }
 }

?>
