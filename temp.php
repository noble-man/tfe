<?php
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
			$req="INSERT INTO student (fkStudent, peine, charge) VALUES ('$fkStudent','$peine','$charge')";
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
        $req='SELECT * FROM student WHERE fkStudent LIKE "'.$fkStudent.'%" AND peine LIKE "'.$peine.'%"';
        $q = $this->_db->query($req);     
        $peinet=0;
        while($donnees = $q->fetch())
        {
			//echo "$donnees[fkStudent]";
			//echo "$donnees[peine]";
			//echo "$donnees[date]";
            $etuds[$peinet]=new etudiant($donnees);
			
			//$temp=$etuds[$peinet]->get_fkStudent();
			
			//echo "$temp"."รงa c'est etuds";
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
        
        $req="select * FROM etudiant WHERE num=$id";
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
        $req='SELECT num FROM student WHERE fkStudent LIKE "'.$fkStudent.'%" AND peine LIKE "'.$peine.'%"';
        $q = $this->_db->query($req);     
        $peinet=0;
        while($donnees = $q->fetch())
        {
			//echo "$donnees[fkStudent]";
			//echo "$donnees[peine]";
			//echo "$donnees[date]";
            $studids[$peinet]=new etudiant($donnees);
			
			//$temp=$etuds[$peinet]->get_fkStudent();
			
			//echo "$temp"."รงa c'est etuds";
			$peinet++;
        }   
        //return  $q;
        if($peinet==0){echo' <SCRIPT LANGUAGE="Javascript">alert("PARTICIPANT PAS TROUVE!")</SCRIPT>';};
        
        return  $studids; 
        
    }
 }
 ?>