<?php
namespace PhpBook\CMS;     

class Ksiazka
{
    protected $db;                                       // Holds ref to Database object

    public function __construct(Database $db)
    {
        $this->db = $db;                                 // Store ref to Database object
    }

    

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

    // SEARCH
    
}