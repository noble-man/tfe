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
class professeur 
{
    
    private $_idProf; 
    private $_nom ;
    private $_prenom ; 
  /*  private $_adresse ;
	private $_cp ; 
    private $_ville ;
	private $_tel ; */
    private $_email ;
//	private $_statut ; 
    //private $_adresse ;
  //  private $_login ;
   // private $_password ; 
    
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
    
    public function get_idProf() 
    {
        return $this->_idProf;
    }
    public function get_nom() 
    {
        return $this->_nom;
    }
    public function get_prenom() 
    {
        return $this->_prenom;
    }
   /* public function get_adresse() 
    {
        return $this->_adresse;
    }
	public function get_cp() 
    {
        return $this->_cp;
    }
	public function get_ville() 
    {
        return $this->_ville;
    }
	public function get_tel() 
    {
        return $this->_tel;
    }*/
	public function get_email() 
    {
        return $this->_email;
    }
	/* public function get_statut() 
    {
        return $this->_statut;
    } */
   /* public function get_login() 
    {
        return $this->_login;
    }*/
   /* public function get_password() 
    {
        return $this->_password;
    }*/

    // SETTEURS => 
    
    public function set_idProf($_idProf) 
    {
        $this->_idProf = $_idProf;
    }
    public function set_nom($_nom) 
    {
        $this->_nom = $_nom;
    }
    public function set_prenom($_prenom) 
    {
        $this->_prenom = $_prenom;
    }
   /*  public function set_adresse($_adresse) 
    {
        $this->_adresse = $_adresse;
    }
	public function set_cp($_adresse) 
    {
        $this->_cp = $_adresse;
    }
	public function set_ville($_adresse) 
    {
        $this->_ville = $_adresse;
    }
	public function set_tel($_adresse) 
    {
        $this->_tel = $_adresse; 
    }*/
	public function set_email($_adresse) 
    {
        $this->_email = $_adresse;
    }
	/* public function set_statut($_adresse) 
    {
        $this->_statut = $_adresse;
    } */
   /* public function set_Login($_login) 
    {
        $this->_login = $_login;
    }*/
   /* public function set_Password($_password) 
    {
        $this->_password = $_password;
    }*/
}

//      MANAGER => PARTICIPANT
//      xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

class professeursManager
{
    
    private $_db ; 
    // CONNECTION PDO 
    
    function __construct($_db) 
    {
        $this->_db = $_db;
    }
    public function add(professeur $part)
    {        
        
		//$req='select ajoutParticipant("'.$part->get_nom().'","'.$part->get_prenom().'","'.$part->get_adresse().'","'.$part->get_login().'","'.$part->get_password().'")';
		////$req='select ajoutParticipant("'.$part->get_nom().'","'.$part->get_prenom().'","'.$part->get_adresse().'",")';
        // echo 'test' .$req ; => OK ! 
       // $q = $this->_db->query($req);        
       // $part->hydrate(array('idProf' => $this->_db->lastInsertId() ) );        
       // return  $q->fetchColumn();
		
		$nom=$part->get_nom();
		$prenom=$part->get_prenom();
		//$adresse=$part->get_adresse();
		//echo "$nom";
			//$id=$part->get_idProf();
		//$nom=$part->get_nom();
		//$prenom=$part->get_prenom();
		//$adresse=$part->get_adresse();
		/* $cp=$part->get_cp();
		$ville=$part->get_ville();
		$tel=$part->get_tel(); */
		$email=$part->get_email();
		//$statut=$part->get_statut();
		
		try {
			//$req="INSERT INTO professeur (nom, prenom, adresse,cp, ville,tel,email,statut) VALUES ('$nom','$prenom','$adresse','$cp','$ville','$tel','$email','$statut')";
			$req="INSERT INTO professeur (nom, prenom, email) VALUES ('$nom','$prenom','$email')";
			// use exec() because no results are returned
			$this->_db->exec($req);
			//echo "New record created successfully";
		   }
		catch(PDOException $e)
			{
			echo $req . "<br>" . $e->getMessage();
			}
		//$this->_db->query("INSERT INTO professeur (nom, prenom, adresse) VALUES ($nom,$prenom,$adresse)");
        // echo 'test' .$req ; => OK ! 
        //$q = $this->_db->query($req);        
      //  $part->hydrate(array('idProf' => $this->_db->lastInsertId() ) );        
        //return  $q->fetchColumn();
		//return true;
    }
    
    public function cleanDB($jours)
    {
             
        $cpt = $test = 0 ;
        
        $req=
                "SELECT t2.idProf, DATEDIFF(CURDATE(),MAX(t2.MaxJour)) AS diff 
                  FROM
                  (SELECT i.idProf, i.idseance, t1.MaxJour 
                  FROM inscription AS i, 
                  (SELECT idseance , MAX(dateJour)AS MaxJour FROM alieu GROUP BY idseance) AS t1  
                  WHERE 
                  i.idseance=t1.idseance ORDER BY i.idProf , i.idseance
                  ) AS t2 
                 GROUP BY t2.idProf" ;
        
        
        
        $q = $this->_db->query($req);
        // $q->query();      
        
        $test = $q->rowCount(); 
        
        
        if($test==0)
            echo' <SCRIPT LANGUAGE="Javascript">alert("probleme requete/suppressions !!");location="gestInscriptions.php"</SCRIPT>';
        
        else
        {    
            while($donnees = $q->fetch(PDO::FETCH_ASSOC))
            {
             
                print_r ($donnees); 
                
                if($donnees['diff']>$jours) // => testing !!
                // if($donnees['diffJours']<$jours)
                { 
                    $cpt++;
                    $req2="delete FROM professeur WHERE idProf=".$donnees['idProf'];
                    $r = $this->_db->prepare($req2);
                    $r->execute(); 
                }    
            }   
       
            // echo' <SCRIPT LANGUAGE="Javascript">alert("Ont/a ete supprime de la base de donnee => '.$cpt .' professeur(s)!");location="classes.php"</SCRIPT>';
        }
        
        return $cpt ; 
        
    }
    
    public function rechProf($nom , $prenom)
    {
        $etuds=array();
        //$req='select rechPart("'.$nom.'","'.$prenom.'")';
        $req='SELECT * FROM professeur WHERE nom LIKE "'.$nom.'%" AND prenom LIKE "'.$prenom.'%"';
        $q = $this->_db->query($req);     
        $cpt=0;
        while($donnees = $q->fetch())
        {
			//echo "$donnees[nom]";
			//echo "$donnees[prenom]";
			//echo "$donnees[email]";
            $etuds[$cpt]=new professeur($donnees);
			
			//$temp=$etuds[$cpt]->get_nom();
			
			//echo "$temp"."ça c'est etuds";
			$cpt++;
        }   
        //return  $q;
        if($cpt==0){echo' <SCRIPT LANGUAGE="Javascript">alert("PARTICIPANT PAS TROUVE!")</SCRIPT>';};
        
        return  $etuds; 
        
    }
	 public function getAll()
    {
        $etuds=array();
        //$req='select rechPart("'.$nom.'","'.$prenom.'")';
        $req='SELECT * FROM professeur';
        $q = $this->_db->query($req);     
        $cpt=0;
        while($donnees = $q->fetch())
        {
			//echo "$donnees[nom]";
			//echo "$donnees[prenom]";
			//echo "$donnees[email]";
            $etuds[$cpt]=new professeur($donnees);
			
			//$temp=$etuds[$cpt]->get_nom();
			
			//echo "$temp"."ça c'est etuds";
			$cpt++;
        }   
        //return  $q;
        if($cpt==0){echo' <SCRIPT LANGUAGE="Javascript">alert("PARTICIPANT PAS TROUVE!")</SCRIPT>';};
        
        return  $etuds; 
        
    }
    
    public function update(professeur $part) 
    // CHANGER UNIQUEMENT L'ADRESSE !!!!         
    {   
        
        //$req='UPDATE professeur  SET adresse = "'.$part->get_adresse().'" WHERE idProf  = "'.$part->get_idProf().'"';
        // echo $req ; => OK ! 
		
		$id=$part->get_idProf();
		$nom=$part->get_nom();
		$prenom=$part->get_prenom();
	/* 	$adresse=$part->get_adresse();
		$cp=$part->get_cp();
		$ville=$part->get_ville();
		$tel=$part->get_tel(); */
		$email=$part->get_email();
		//$statut=$part->get_statut();
	
		
		/* echo "dans update -addresse: $adresse";
		echo "dans update -id: $id"; */
		
        $q = $this->_db->query('UPDATE professeur  SET nom = "'.$part->get_nom().'" WHERE idProf  = "'.$part->get_idProf().'"');
		$q = $this->_db->query('UPDATE professeur  SET prenom = "'.$part->get_prenom().'" WHERE idProf  = "'.$part->get_idProf().'"');
/* 		$q = $this->_db->query('UPDATE professeur  SET adresse = "'.$part->get_adresse().'" WHERE idProf  = "'.$part->get_idProf().'"');
		$q = $this->_db->query('UPDATE professeur  SET cp = "'.$part->get_cp().'" WHERE idProf  = "'.$part->get_idProf().'"');
		$q = $this->_db->query('UPDATE professeur  SET ville = "'.$part->get_ville().'" WHERE idProf  = "'.$part->get_idProf().'"');
		$q = $this->_db->query('UPDATE professeur  SET tel = "'.$part->get_tel().'" WHERE idProf  = "'.$part->get_idProf().'"'); */
		$q = $this->_db->query('UPDATE professeur  SET email = "'.$part->get_email().'" WHERE idProf  = "'.$part->get_idProf().'"');
		//$q = $this->_db->query('UPDATE professeur  SET statut = "'.$part->get_statut().'" WHERE idProf  = "'.$part->get_idProf().'"');
        //$q = $this->_db->prepare($req);    
       // $q->execute();
        
    }
    public function setDb(PDO $db)
    {
	$this->_db = $db;
    }
    
    public function getPartById($id)
    {
        $part = null ; 
        
        $req="select * FROM professeur WHERE idProf=$id";
        $q = $this->_db->prepare($req);
        $q->execute();    
        
        while($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $part=new professeur($donnees); 
        }   
       
        return $part ;
    }

    public function getListCmbBx ()
    {        
        $listePart = array();
        $req="select * FROM professeur ORDER by nom , prenom";
        $q = $this->_db->prepare($req);
        $q->execute();
       
        while($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $listePart[]=new professeur($donnees); 
        }  
        return $listePart ;  
    }
    
    public function get($id)
        {
            $id = (int) $id;
            
            //$q = $this->_db->query('SELECT idProf, nom, prenom, adresse, login, password FROM professeur WHERE idProf = '.$id);
			$q = $this->_db->query('SELECT idProf, nom, prenom, email FROM professeur WHERE idProf = '.$id);
            $donnees = $q->fetch(PDO::FETCH_ASSOC);
            
            return new professeur($donnees);
        }
		
	public function effacer($id)
        {
            $id = (int) $id;
            
            //$q = $this->_db->query('SELECT idProf, nom, prenom, adresse, login, password FROM professeur WHERE idProf = '.$id);
			//$q = $this->_db->query('SELECT idProf, nom, prenom, adresse, cp,ville, tel, email, statut  FROM professeur WHERE idProf = '.$id);
			$q = $this->_db->query('DELETE FROM professeur WHERE idProf= '.$id);
            //$donnees = $q->fetch(PDO::FETCH_ASSOC);
            
           // return new professeur($donnees);
        }
	 /*public function get_id($nom,$prenom)
        {
            $id = (int) $id;
            
            //$q = $this->_db->query('SELECT idProf, nom, prenom, adresse, login, password FROM professeur WHERE idProf = '.$id);
			$q = $this->_db->query('SELECT idProf, nom, prenom, adresse, cp,ville, tel, email, statut  FROM professeur WHERE idProf = '.$id);
            $donnees = $q->fetch(PDO::FETCH_ASSOC);
            
            return new professeur($donnees);
        }*/
	public function get_profid($nom , $prenom)
    {
        $etuds=array();
        //$req='select rechPart("'.$nom.'","'.$prenom.'")';
        $req='SELECT idProf FROM professeur WHERE nom LIKE "'.$nom.'%" AND prenom LIKE "'.$prenom.'%"';
        $q = $this->_db->query($req);     
        $cpt=0;
        while($donnees = $q->fetch())
        {
			//echo "$donnees[nom]";
			//echo "$donnees[prenom]";
			//echo "$donnees[email]";
            $studs[$cpt]=new professeur($donnees);
			
			//$temp=$etuds[$cpt]->get_nom();
			
			//echo "$temp"."ça c'est etuds";
			$cpt++;
        }   
        //return  $q;
        if($cpt==0){echo' <SCRIPT LANGUAGE="Javascript">alert("PARTICIPANT PAS TROUVE!")</SCRIPT>';};
        return  $studs[$cpt-1]->get_idProf(); 
		
        
    }
 }

?>
