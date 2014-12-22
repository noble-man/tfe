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
class etudiant 
{
    
    private $_idStudent; 
    private $_nom ;
    private $_prenom ; 
    private $_adresse ;
	private $_cp ; 
    private $_ville ;
	private $_tel ; 
    private $_email ;
	private $_statut ; 
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
    
    public function get_idStudent() 
    {
        return $this->_idStudent;
    }
    public function get_nom() 
    {
        return $this->_nom;
    }
    public function get_prenom() 
    {
        return $this->_prenom;
    }
    public function get_adresse() 
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
    }
	public function get_email() 
    {
        return $this->_email;
    }
	public function get_statut() 
    {
        return $this->_statut;
    }
   /* public function get_login() 
    {
        return $this->_login;
    }*/
   /* public function get_password() 
    {
        return $this->_password;
    }*/

    // SETTEURS => 
    
    public function set_idStudent($_idStudent) 
    {
        $this->_idStudent = $_idStudent;
    }
    public function set_nom($_nom) 
    {
        $this->_nom = $_nom;
    }
    public function set_prenom($_prenom) 
    {
        $this->_prenom = $_prenom;
    }
    public function set_adresse($_adresse) 
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
    }
	public function set_email($_adresse) 
    {
        $this->_email = $_adresse;
    }
	public function set_statut($_adresse) 
    {
        $this->_statut = $_adresse;
    }
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

class etudiantsManager
{
    
    private $_db ; 
    // CONNECTION PDO 
    
    function __construct($_db) 
    {
        $this->_db = $_db;
    }
    public function add(etudiant $part)
    {        
        
		//$req='select ajoutParticipant("'.$part->get_nom().'","'.$part->get_prenom().'","'.$part->get_adresse().'","'.$part->get_login().'","'.$part->get_password().'")';
		////$req='select ajoutParticipant("'.$part->get_nom().'","'.$part->get_prenom().'","'.$part->get_adresse().'",")';
        // echo 'test' .$req ; => OK ! 
       // $q = $this->_db->query($req);        
       // $part->hydrate(array('idStudent' => $this->_db->lastInsertId() ) );        
       // return  $q->fetchColumn();
		
		$nom=$part->get_nom();
		$prenom=$part->get_prenom();
		$adresse=$part->get_adresse();
		//echo "$nom";
			//$id=$part->get_idStudent();
		//$nom=$part->get_nom();
		//$prenom=$part->get_prenom();
		//$adresse=$part->get_adresse();
		$cp=$part->get_cp();
		$ville=$part->get_ville();
		$tel=$part->get_tel();
		$email=$part->get_email();
		$statut=$part->get_statut();
		
		try {
			$req="INSERT INTO student (nom, prenom, adresse,cp, ville,tel,email,statut) VALUES ('$nom','$prenom','$adresse','$cp','$ville','$tel','$email','$statut')";
			// use exec() because no results are returned
			$this->_db->exec($req);
			//echo "New record created successfully";
		   }
		catch(PDOException $e)
			{
			echo $req . "<br>" . $e->getMessage();
			}
		//$this->_db->query("INSERT INTO student (nom, prenom, adresse) VALUES ($nom,$prenom,$adresse)");
        // echo 'test' .$req ; => OK ! 
        //$q = $this->_db->query($req);        
      //  $part->hydrate(array('idStudent' => $this->_db->lastInsertId() ) );        
        //return  $q->fetchColumn();
		//return true;
    }
    
    public function cleanDB($jours)
    {
             
        $cpt = $test = 0 ;
        
        $req=
                "SELECT t2.idStudent, DATEDIFF(CURDATE(),MAX(t2.MaxJour)) AS diff 
                  FROM
                  (SELECT i.idStudent, i.idseance, t1.MaxJour 
                  FROM inscription AS i, 
                  (SELECT idseance , MAX(dateJour)AS MaxJour FROM alieu GROUP BY idseance) AS t1  
                  WHERE 
                  i.idseance=t1.idseance ORDER BY i.idStudent , i.idseance
                  ) AS t2 
                 GROUP BY t2.idStudent" ;
        
        
        
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
                    $req2="delete FROM etudiant WHERE idStudent=".$donnees['idStudent'];
                    $r = $this->_db->prepare($req2);
                    $r->execute(); 
                }    
            }   
       
            // echo' <SCRIPT LANGUAGE="Javascript">alert("Ont/a ete supprime de la base de donnee => '.$cpt .' etudiant(s)!");location="classes.php"</SCRIPT>';
        }
        
        return $cpt ; 
        
    }
    
    public function rechEtud($nom , $prenom)
    {
        $etuds=array();
        //$req='select rechPart("'.$nom.'","'.$prenom.'")';
        $req='SELECT * FROM student WHERE nom LIKE "'.$nom.'%" AND prenom LIKE "'.$prenom.'%"';
        $q = $this->_db->query($req);     
        $cpt=0;
        while($donnees = $q->fetch())
        {
			//echo "$donnees[nom]";
			//echo "$donnees[prenom]";
			//echo "$donnees[email]";
            $etuds[$cpt]=new etudiant($donnees);
			
			//$temp=$etuds[$cpt]->get_nom();
			
			//echo "$temp"."ça c'est etuds";
			$cpt++;
        }   
        //return  $q;
        if($cpt==0){echo' <SCRIPT LANGUAGE="Javascript">alert("PARTICIPANT PAS TROUVE!")</SCRIPT>';};
        
        return  $etuds; 
        
    }
    
    public function update(etudiant $part) 
    // CHANGER UNIQUEMENT L'ADRESSE !!!!         
    {   
        
        //$req='UPDATE student  SET adresse = "'.$part->get_adresse().'" WHERE idStudent  = "'.$part->get_idStudent().'"';
        // echo $req ; => OK ! 
		
		$id=$part->get_idStudent();
		$nom=$part->get_nom();
		$prenom=$part->get_prenom();
		$adresse=$part->get_adresse();
		$cp=$part->get_cp();
		$ville=$part->get_ville();
		$tel=$part->get_tel();
		$email=$part->get_email();
		$statut=$part->get_statut();
	
		
		/* echo "dans update -addresse: $adresse";
		echo "dans update -id: $id"; */
		
        $q = $this->_db->query('UPDATE student  SET nom = "'.$part->get_nom().'" WHERE idStudent  = "'.$part->get_idStudent().'"');
		$q = $this->_db->query('UPDATE student  SET prenom = "'.$part->get_prenom().'" WHERE idStudent  = "'.$part->get_idStudent().'"');
		$q = $this->_db->query('UPDATE student  SET adresse = "'.$part->get_adresse().'" WHERE idStudent  = "'.$part->get_idStudent().'"');
		$q = $this->_db->query('UPDATE student  SET cp = "'.$part->get_cp().'" WHERE idStudent  = "'.$part->get_idStudent().'"');
		$q = $this->_db->query('UPDATE student  SET ville = "'.$part->get_ville().'" WHERE idStudent  = "'.$part->get_idStudent().'"');
		$q = $this->_db->query('UPDATE student  SET tel = "'.$part->get_tel().'" WHERE idStudent  = "'.$part->get_idStudent().'"');
		$q = $this->_db->query('UPDATE student  SET email = "'.$part->get_email().'" WHERE idStudent  = "'.$part->get_idStudent().'"');
		$q = $this->_db->query('UPDATE student  SET statut = "'.$part->get_statut().'" WHERE idStudent  = "'.$part->get_idStudent().'"');
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
        
        $req="select * FROM student WHERE idStudent=$id";
        $q = $this->_db->prepare($req);
        $q->execute();    
        
        while($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $part=new etudiant($donnees); 
        }   
       
        return $part ;
    }
    /*
    public function getListAllParticipants ()
    {        
        
        $tableParticipants = "";
        $req="select * FROM etudiant ORDER by nom , prenom";
        $q = $this->_db->prepare($req);
        $q->execute();
        
        $tableParticipants.="<center>     
        <TABLE BORDER='1'>
        <CAPTION><h2><u>LISTE DES PARTICIPANTS :</u></h2> </CAPTION>
        </br>
        <TR>
        <TH><u>- identifiant  -  </u></TH>
        <TH><u>- Nom - </u></TH>
        <TH><u>- Prenom -</u></TH>
        <TH><u> - Adresse - </u></TH>
        </TR>";
       
        while($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $part=new etudiant($donnees); 
            
        $tableParticipants.="<TR>
        <TH><?Php echo $part->get_idStudent(); ?></TH>
        <TH>".$part->get_nom()."</TH>
        <TH>".$part->get_prenom()."</TH>
        <TH>".$part->get_adresse()."</TH>
        </TR></center>";     
        } 
        
        return $tableParticipants;
    }
    */
        public function getListCmbBx ()
    {        
        $listePart = array();
        $req="select * FROM etudiant ORDER by nom , prenom";
        $q = $this->_db->prepare($req);
        $q->execute();
       
        while($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $listePart[]=new etudiant($donnees); 
        }  
        return $listePart ;  
    }
    
    public function get($id)
        {
            $id = (int) $id;
            
            //$q = $this->_db->query('SELECT idStudent, nom, prenom, adresse, login, password FROM student WHERE idStudent = '.$id);
			$q = $this->_db->query('SELECT idStudent, nom, prenom, adresse, cp,ville, tel, email, statut  FROM student WHERE idStudent = '.$id);
            $donnees = $q->fetch(PDO::FETCH_ASSOC);
            
            return new etudiant($donnees);
        }
		
	public function effacer($id)
        {
            $id = (int) $id;
            
            //$q = $this->_db->query('SELECT idStudent, nom, prenom, adresse, login, password FROM student WHERE idStudent = '.$id);
			//$q = $this->_db->query('SELECT idStudent, nom, prenom, adresse, cp,ville, tel, email, statut  FROM student WHERE idStudent = '.$id);
			$q = $this->_db->query('DELETE FROM Student WHERE idStudent= '.$id);
            //$donnees = $q->fetch(PDO::FETCH_ASSOC);
            
           // return new etudiant($donnees);
        }
	 /*public function get_id($nom,$prenom)
        {
            $id = (int) $id;
            
            //$q = $this->_db->query('SELECT idStudent, nom, prenom, adresse, login, password FROM student WHERE idStudent = '.$id);
			$q = $this->_db->query('SELECT idStudent, nom, prenom, adresse, cp,ville, tel, email, statut  FROM student WHERE idStudent = '.$id);
            $donnees = $q->fetch(PDO::FETCH_ASSOC);
            
            return new etudiant($donnees);
        }*/
	public function get_studentid($nom , $prenom)
    {
        $etuds=array();
        //$req='select rechPart("'.$nom.'","'.$prenom.'")';
        $req='SELECT idStudent FROM student WHERE nom LIKE "'.$nom.'%" AND prenom LIKE "'.$prenom.'%"';
        $q = $this->_db->query($req);     
        $cpt=0;
        while($donnees = $q->fetch())
        {
			//echo "$donnees[nom]";
			//echo "$donnees[prenom]";
			//echo "$donnees[email]";
            $studs[$cpt]=new etudiant($donnees);
			
			//$temp=$etuds[$cpt]->get_nom();
			
			//echo "$temp"."ça c'est etuds";
			$cpt++;
        }   
        //return  $q;
        if($cpt==0){echo' <SCRIPT LANGUAGE="Javascript">alert("PARTICIPANT PAS TROUVE!")</SCRIPT>';};
        return  $studs[$cpt-1]->get_idStudent(); 
		
        
    }
 }

//INSCRIPTION_CLASS

class Inscription
{
    
   	private $_idInscription ;
	private $_fkStudent ;
	private $_annee ;
	private $_date ;
	private $_montantVerse ;
	private $_decision;
    private $_remarque;
    
   
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
        
     // = > GUETTEUR 
     
     public function get_idInscription() 
     {
        return $this->_idInscription;
     }
     public function get_fkStudent() 
     {
        return $this->_fkStudent;
     }
     public function get_annee() 
     {
        return $this->_annee;
     }
     public function get_decision() 
     {
        return $this->_decision;
     }
	  public function get_remarque() 
     {
        return $this->_remarque;
     }
	 public function get_montantVerse() 
     {
        return $this->_montantVerse;
     }
	  public function get_date() 
     {
        return $this->_date;
     }
        
        // SETTEURS => 
     
     public function set_IdInscription($_idInscription) 
     {
        $this->_idInscription = $_idInscription;
     }
     public function set_fkStudent($_fkStudent) 
     {
        $this->_fkStudent = $_fkStudent;
     }
     public function set_annee($_annee) 
     {
        $this->_annee = $_annee;
     }
     public function set_decision($_decision) 
     {
        $this->_decision = $_decision;
     }
	 public function set_remarque($_remarque) 
     {
        $this->_remarque = $_remarque;
     }
	  public function set_montantVerse($_montantVerse) 
     {
        $this->_montantVerse = $_montantVerse;
     }
	  public function set_date($_date) 
     {
        $this->_date = $_date;
     }
}

    //  MANAGER => INSCRIPTION
    //  xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

class InscriptionsManager
{
    private $_db ; 
    // CONNECTION PDO 
    
    function __construct($_db) 
    {
        $this->_db = $_db ;
    }
 
    public function add (Inscription $inscr)
    {        
       /*
		$req='call ajoutinscription('.$inscr->get_fkStudent().','.$inscr->get_fkPromotion().','.$inscr->get_decision().',@y);';
  
        // $sql="CALL ajoutinscription(".$idPart.",".$fkPromotion.",".$decision.",@y);";
        
        $this->_db->query($req);
        $q=$this->_db->query("SELECT @y;");
        $result=$q->fetchColumn();
        return $result;
		*/

		$fkStudent=$inscr->get_fkStudent();
		$date=$inscr->get_date();
		$montantVerse=$inscr->get_montantVerse();
		
		//echo "$fkStudent";
		try {
			$req="INSERT INTO inscription (fkStudent, date, montantVerse) VALUES ('$fkStudent','$date','$montantVerse')";
			// use exec() because no results are returned
			$this->_db->exec($req);
			echo "New record created successfully";
		   }
		catch(PDOException $e)
			{
			echo $req . "<br>" . $e->getMessage();
			}
		
    }
	
	public function get($id)
	{
		$id = (int) $id;
		
		//$q = $this->_db->query('SELECT idStudent, nom, prenom, adresse, login, password FROM student WHERE idStudent = '.$id);
		$q = $this->_db->query('SELECT idInscr, fkStudent, annee, date, montantVerse, decision, remarque FROM inscription WHERE fkStudent = '.$id);
		$donnees = $q->fetch(PDO::FETCH_ASSOC);
		
		return new Inscription($donnees);
	}
   
    public function setDb(PDO $db)
    {
	$this->_db = $db;
    }
    
     public function getListInscriptions ($fkPromotion)
    {        
        $tableInscriptions="";
        $req="select * FROM inscription WHERE fkPromotion=".$fkPromotion;
        $q = $this->_db->prepare($req);
        $q->execute();
        
        
        $tableInscriptions.="<center>     
        <CAPTION><h2><u>LISTE DES INSCRIPTIONS POUR LA SEANCE NO. ".$fkPromotion.":</u></h2> </CAPTION>
        <table id='rounded-corner'>
        <thead>
         <th class='rounded-q2'> Participant  </th>
        <th class='rounded-q2'> Statut  </th>
        <thead><tbody>";
        
        $cpt=0;
        
        $parts=  new participantsManager($this->_db);
        $statuts= new StatutprofessionnelsManager($this->_db);
            
        while($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $inscr=new Inscription($donnees); 
            
        
        $tableInscriptions.=
                "<tr>
                  <td><center>".$parts->get($inscr->get_fkStudent())->get_prenom()." ".$parts->get($inscr->get_fkStudent())->get_nom()."</center></td>
                  <td><center>".$statuts->get($inscr->get_decision())->get_intitule()."</center></td>";
		
        $cpt++;
        }
        
        $tableInscriptions.="</tr></tbody></table></center>";
        
        if($cpt==0)
            $tableInscriptions="<center><h2><u>Il n'y a aucun element a afficher car il n'existe encore aucune session pour cette seance !!</u></h2></center>";
	
  
        return $tableInscriptions;       
    }
	
	public function update(Inscription $part) 
    // CHANGER UNIQUEMENT L'ADRESSE !!!!         
    {   
        
        //$req='UPDATE student  SET adresse = "'.$part->get_adresse().'" WHERE idStudent  = "'.$part->get_idStudent().'"';
        // echo $req ; => OK ! 
		
	//	$id=$part->get_idStudent();
		$id=$part->get_fkStudent();
		$annee=$part->get_annee();
		$date=$part->get_date();
		$montantVerse=$part->get_montantVerse();
		$decision=$part->get_decision();
		$remarque=$part->get_remarque();
		//$email=$part->get_email();
		//$statut=$part->get_statut();
	
		
		/* echo "dans update -addresse: $adresse";
		echo "dans update -id: $id"; */
		
       // $q = $this->_db->query('UPDATE inscription  SET fkStudent = "'.$part->get_fkStudent().'" WHERE idStudent  = "'.$part->get_idStudent().'"');
		$q = $this->_db->query('UPDATE inscription  SET annee = "'.$part->get_annee().'" WHERE fkStudent  = "'.$part->get_fkStudent().'"');
		$q = $this->_db->query('UPDATE inscription  SET date = "'.$part->get_date().'" WHERE fkStudent = "'.$part->get_fkStudent().'"');
		$q = $this->_db->query('UPDATE inscription  SET montantVerse = "'.$part->get_montantVerse().'" WHERE fkStudent  = "'.$part->get_fkStudent().'"');
		$q = $this->_db->query('UPDATE inscription  SET decision = "'.$part->get_decision().'" WHERE fkStudent  = "'.$part->get_fkStudent().'"');
		$q = $this->_db->query('UPDATE inscription  SET remarque = "'.$part->get_remarque().'" WHERE fkStudent  = "'.$part->get_fkStudent().'"');
		//$q = $this->_db->query('UPDATE student  SET email = "'.$part->get_email().'" WHERE idStudent  = "'.$part->get_idStudent().'"');
		//$q = $this->_db->query('UPDATE student  SET statut = "'.$part->get_statut().'" WHERE idStudent  = "'.$part->get_idStudent().'"');
        //$q = $this->_db->prepare($req);    
       // $q->execute();
        
    }

 }
 //     CLASS LOCAL
 //     xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
 

/*------Classe Criminal Record----*/
class criminalrecord 
{
    
    private $_num;
	private $_ville ;
	private $_date ;
	private $_charge ;	
    private $_peine ; 
    private $_fkStudent ;

    
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
    
    public function get_num() 
    {
        return $this->_num;
    }
	public function get_ville() 
    {
        return $this->_ville;
    }
	public function get_date() 
    {
        return $this->_date;
    }
	 public function get_charge() 
    {
        return $this->_charge;
    }
	public function get_peine() 
    {
        return $this->_peine;
    }
	public function get_fkStudent() 
    {
        return $this->_fkStudent;
    }
			
   /* public function get_login() 
    {
        return $this->_login;
    }*/
   /* public function get_password() 
    {
        return $this->_password;
    }*/

    // SETTEURS => 
    
    public function set_num($_num) 
    {
        $this->_num = $_num;
    }
	public function set_ville($_charge) 
    {
        $this->_ville = $_charge;
    }
	public function set_date($_charge) 
    {
        $this->_date = $_charge;
    }
	 public function set_charge($_charge) 
    {
        $this->_charge = $_charge;
    }
	public function set_peine($_peine) 
    {
        $this->_peine = $_peine;
    }
    public function set_fkStudent($_fkStudent) 
    {
        $this->_fkStudent = $_fkStudent;
    }
 }

//      MANAGER => PARTICIPANT
//      xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

class criminalrecordManager
{
    
    private $_db ; 
    // CONNECTION PDO 
    
    function __construct($_db) 
    {
        $this->_db = $_db;
    }
    public function add(criminalrecord $part)
    {        
        
		//$req='select ajoutParticipant("'.$part->get_fkStudent().'","'.$part->get_peine().'","'.$part->get_charge().'","'.$part->get_login().'","'.$part->get_password().'")';
		////$req='select ajoutParticipant("'.$part->get_fkStudent().'","'.$part->get_peine().'","'.$part->get_charge().'",")';
        // echo 'test' .$req ; => OK ! 
       // $q = $this->_db->query($req);        
       // $part->hydrate(array('num' => $this->_db->lastInsertId() ) );        
       // return  $q->fetchColumn();
		
		$fkStudent=$part->get_fkStudent();
		$peine=$part->get_peine();
		$charge=$part->get_charge();
		echo "$fkStudent";
		try {
			$req="INSERT INTO criminalrecord (fkStudent, peine, charge) VALUES ('$fkStudent','$peine','$charge')";
			// use exec() because no results are returned
			$this->_db->exec($req);
			echo "New record created successfully";
		   }
		catch(PDOException $e)
			{
			echo $req . "<br>" . $e->getMessage();
			}
		//$this->_db->query("INSERT INTO student (fkStudent, peine, charge) VALUES ($fkStudent,$peine,$charge)");
        // echo 'test' .$req ; => OK ! 
        //$q = $this->_db->query($req);        
      //  $part->hydrate(array('num' => $this->_db->lastInsertId() ) );        
        //return  $q->fetchColumn();
		//return true;
    }
    
       public function cleanDB($jours)
    {
             
        $peinet = $test = 0 ;
        
        $req=
                "SELECT t2.num, DATEDIFF(CURDATE(),MAX(t2.MaxJour)) AS diff 
                  FROM
                  (SELECT i.num, i.idseance, t1.MaxJour 
                  FROM inscription AS i, 
                  (SELECT idseance , MAX(dateJour)AS MaxJour FROM alieu GROUP BY idseance) AS t1  
                  WHERE 
                  i.idseance=t1.idseance ORDER BY i.num , i.idseance
                  ) AS t2 
                 GROUP BY t2.num" ;
        
        
        
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
                    $peinet++;
                    $req2="delete FROM etudiant WHERE num=".$donnees['num'];
                    $r = $this->_db->prepare($req2);
                    $r->execute(); 
                }    
            }   
       
            // echo' <SCRIPT LANGUAGE="Javascript">alert("Ont/a ete supprime de la base de donnee => '.$peinet .' etudiant(s)!");location="classes.php"</SCRIPT>';
        }
        
        return $peinet ; 
        
    }
    
    public function rechEtud($fkStudent , $peine)
    {
        $etuds=array();
        //$req='select rechPart("'.$fkStudent.'","'.$peine.'")';
        $req='SELECT * FROM criminalrecord WHERE fkStudent LIKE "'.$fkStudent.'%" AND peine LIKE "'.$peine.'%"';
        $q = $this->_db->query($req);     
        $peinet=0;
        while($donnees = $q->fetch())
        {
			//echo "$donnees[fkStudent]";
			//echo "$donnees[peine]";
			//echo "$donnees[date]";
            $etuds[$peinet]=new etudiant($donnees);
			
			//$temp=$etuds[$peinet]->get_fkStudent();
			
			//echo "$temp"."ça c'est etuds";
			$peinet++;
        }   
        //return  $q;
        if($peinet==0){echo' <SCRIPT LANGUAGE="Javascript">alert("PARTICIPANT PAS TROUVE!")</SCRIPT>';};
        
        return  $etuds; 
        
    }
    
    public function update(etudiant $part) 
    // CHANGER UNIQUEMENT L'ADRESSE !!!!         
    {   
        
        $req='UPDATE etudiant  SET charge = "'.$part->get_charge().'" WHERE num  = "'.$part->get_num().'"';
        // echo $req ; => OK ! 
        
        $q = $this->_db->prepare($req);    
        $q->execute();
        
    }
    public function setDb(PDO $db)
    {
	$this->_db = $db;
    }
    
    public function getPartById($id)
    {
        $part = null ; 
        
        $req="select * FROM criminalrecord WHERE num=$id";
        $q = $this->_db->prepare($req);
        $q->execute();    
        
        while($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $part=new etudiant($donnees); 
        }   
       
        return $part ;
    }
    /*
    public function getListAllParticipants ()
    {        
        
        $tableParticipants = "";
        $req="select * FROM etudiant ORDER by fkStudent , peine";
        $q = $this->_db->prepare($req);
        $q->execute();
        
        $tableParticipants.="<center>     
        <TABLE BORDER='1'>
        <CAPTION><h2><u>LISTE DES PARTICIPANTS :</u></h2> </CAPTION>
        </br>
        <TR>
        <TH><u>- identifiant  -  </u></TH>
        <TH><u>- Nom - </u></TH>
        <TH><u>- PrefkStudent -</u></TH>
        <TH><u> - Adresse - </u></TH>
        </TR>";
       
        while($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $part=new etudiant($donnees); 
            
        $tableParticipants.="<TR>
        <TH><?Php echo $part->get_num(); ?></TH>
        <TH>".$part->get_fkStudent()."</TH>
        <TH>".$part->get_peine()."</TH>
        <TH>".$part->get_charge()."</TH>
        </TR></center>";     
        } 
        
        return $tableParticipants;
    }
    */
        public function getListCmbBx ()
    {        
        $listePart = array();
        $req="select * FROM etudiant ORDER by fkStudent , peine";
        $q = $this->_db->prepare($req);
        $q->execute();
       
        while($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $listePart[]=new etudiant($donnees); 
        }  
        return $listePart ;  
    }
    
    public function get($id)
        {
            $id = (int) $id;
            
            //$q = $this->_db->query('SELECT num, fkStudent, peine, charge, login, password FROM student WHERE num = '.$id);
			$q = $this->_db->query('SELECT num, fkStudent, peine, charge, peine,ville, tel, date, statut  FROM student WHERE num = '.$id);
            $donnees = $q->fetch(PDO::FETCH_ASSOC);
            
            return new etudiant($donnees);
        }
		
	public function effacer($id)
        {
            $id = (int) $id;
            
            //$q = $this->_db->query('SELECT num, fkStudent, peine, charge, login, password FROM student WHERE num = '.$id);
			//$q = $this->_db->query('SELECT num, fkStudent, peine, charge, peine,ville, tel, date, statut  FROM student WHERE num = '.$id);
			$q = $this->_db->query('DELETE FROM Student WHERE num= '.$id);
            //$donnees = $q->fetch(PDO::FETCH_ASSOC);
            
           // return new etudiant($donnees);
        }
	 /*public function get_id($fkStudent,$peine)
        {
            $id = (int) $id;
            
            //$q = $this->_db->query('SELECT num, fkStudent, peine, charge, login, password FROM student WHERE num = '.$id);
			$q = $this->_db->query('SELECT num, fkStudent, peine, charge, peine,ville, tel, date, statut  FROM student WHERE num = '.$id);
            $donnees = $q->fetch(PDO::FETCH_ASSOC);
            
            return new etudiant($donnees);
        }*/
	public function get_studentid($fkStudent , $peine)
    {
        $etuds=array();
        //$req='select rechPart("'.$fkStudent.'","'.$peine.'")';
        $req='SELECT num FROM criminal WHERE fkStudent LIKE "'.$fkStudent.'%" AND peine LIKE "'.$peine.'%"';
        $q = $this->_db->query($req);     
        $peinet=0;
        while($donnees = $q->fetch())
        {
			//echo "$donnees[fkStudent]";
			//echo "$donnees[peine]";
			//echo "$donnees[date]";
            $studids[$peinet]=new etudiant($donnees);
			
			//$temp=$etuds[$peinet]->get_fkStudent();
			
			//echo "$temp"."ça c'est etuds";
			$peinet++;
        }   
        //return  $q;
        if($peinet==0){echo' <SCRIPT LANGUAGE="Javascript">alert("PARTICIPANT PAS TROUVE!")</SCRIPT>';};
        
        return  $studids; 
        
    }
 }
?>
