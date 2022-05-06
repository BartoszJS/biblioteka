<?php
namespace PhpBook\CMS;     

class Ksiazka
{
    protected $db;                                       // Holds ref to Database object

    public function __construct(Database $db)
    {
        $this->db = $db;                                 // Store ref to Database object
    }

    
    //ksiazki.php
    public function getDostepne($show,$from)
    {
        $arguments['show'] = $show;                     
        $arguments['from'] = $from;

        $sql="SELECT ID,tytul,autor,dostepnosc,okladka,gatunek,liczba_stron
        FROM ksiazki  
        where dostepnosc=1
        order by id desc
        limit :show
        OFFSET :from;";

        return $this->db->runSql($sql,$arguments)->fetchAll();                           // Return Token object
    }



    public function policzTerm($term)
    {  
        $arguments['term1'] ='%'.$term.'%'; 
        $arguments['term2'] ='%'.$term.'%';            // three times as placeholders
        $arguments['term3'] ='%'.$term.'%';
        $arguments['term4'] ='%'.$term.'%';

        $sql="SELECT COUNT(id) 
        from ksiazki
        where tytul like :term1
        and dostepnosc=1 
        or id like :term2
        and dostepnosc=1 
        or autor like :term3
        and dostepnosc=1 
        or gatunek like :term4
        and dostepnosc=1 ;";

    return $this->db->runSql($sql,$arguments)->fetchColumn(); 

    }

    public function getDostepneTerm($show,$from,$term)
    {
        $arguments['show'] = $show;                       // Add to array for pagination
        $arguments['from'] = $from; 
        $arguments['term1'] ='%'.$term.'%'; 
        $arguments['term2'] ='%'.$term.'%';            // three times as placeholders
        $arguments['term3'] ='%'.$term.'%';
        $arguments['term4'] ='%'.$term.'%';
        

        $sql="SELECT ID,tytul,autor,dostepnosc,okladka,gatunek,liczba_stron
        FROM ksiazki  
            where tytul like :term1
            and dostepnosc=1 
            or id like :term2
            and dostepnosc=1 
            or autor like :term3
            and dostepnosc=1 
            or gatunek like :term4
            and dostepnosc=1 
            order by id desc
            limit :show
            OFFSET :from;";
       return $this->db->runSql($sql,$arguments)->fetchAll();    
    }

    public function liczDostepne()
    { 
    $sql="SELECT COUNT(id) from ksiazki where dostepnosc=1;";
       return $this->db->runSql($sql)->fetchColumn();  
    }

    //wypozyczone.php
    public function getNiedostepne($show,$from)
    {
        $arguments['show'] = $show;                     
        $arguments['from'] = $from;

        $sql="SELECT ID,tytul,autor,dostepnosc,okladka,gatunek,liczba_stron
        FROM ksiazki  
        where dostepnosc=0
        order by id desc
        limit :show
        OFFSET :from;";

        return $this->db->runSql($sql,$arguments)->fetchAll();                           // Return Token object
    }



    public function policzNieTerm($term)
    {  
        $arguments['term1'] ='%'.$term.'%'; 
        $arguments['term2'] ='%'.$term.'%';            // three times as placeholders
        $arguments['term3'] ='%'.$term.'%';
        $arguments['term4'] ='%'.$term.'%';

        $sql="SELECT COUNT(id) 
        from ksiazki
        where tytul like :term1
        and dostepnosc=0
        or id like :term2
        and dostepnosc=0 
        or autor like :term3
        and dostepnosc=0 
        or gatunek like :term4
        and dostepnosc=0 ;";

    return $this->db->runSql($sql,$arguments)->fetchColumn(); 

    }

    public function getNiedostepneTerm($show,$from,$term)
    {
        $arguments['show'] = $show;                       // Add to array for pagination
        $arguments['from'] = $from; 
        $arguments['term1'] ='%'.$term.'%'; 
        $arguments['term2'] ='%'.$term.'%';            // three times as placeholders
        $arguments['term3'] ='%'.$term.'%';
        $arguments['term4'] ='%'.$term.'%';
        

        $sql="SELECT ID,tytul,autor,dostepnosc,okladka,gatunek,liczba_stron
        FROM ksiazki  
            where tytul like :term1
            and dostepnosc=0
            or id like :term2
            and dostepnosc=0 
            or autor like :term3
            and dostepnosc=0 
            or gatunek like :term4
            and dostepnosc=0 
            order by id desc
            limit :show
            OFFSET :from;";
       return $this->db->runSql($sql,$arguments)->fetchAll();    
    }

    public function liczNiedostepne()
    { 
    $sql="SELECT COUNT(id) from ksiazki where dostepnosc=0;";
       return $this->db->runSql($sql)->fetchColumn();  
    }

    //ksiazka.php, wypozycz.php, potwwypo.php
    public function getKsiazka($id)
    { 
    $sql="SELECT id,tytul,autor,dostepnosc,okladka,gatunek,liczba_stron
        FROM ksiazki
        where id=:id;";
       return $this->db->runSql($sql,[$id])->fetch();     
    }


    //wypozyczono.php
    public function updateDostepnosc($id)
    { 
        $sql="UPDATE ksiazki
        SET dostepnosc = 0
        where id=:id;";
       return $this->db->runSql($sql,[$id])->fetch();     
    }

    //dodajksiazke.php
    public function getLastId()
    { 
    $sql=   "SELECT ID
            FROM ksiazki  
            order by id desc
            limit 1;";
         return $this->db->runSql($sql)->fetchColumn();     
    }

    
    public function dodajKsiazke($arguments,$last)
    { 
    $sql="INSERT INTO ksiazki(tytul,autor,dostepnosc,okladka,gatunek,liczba_stron)
    values            (:tytul,:autor,1,:okladka,:gatunek,:liczba_stron);";
  
    try{
    $this->db->runSql($sql,$arguments)->fetch();  
    header("Location: ksiazka.php?id=".$last); 
    exit();
    }catch(PDOException $e){
      throw $e;
    }
}



 



    
    
    

   
    
}