<?php
namespace PhpBook\CMS;     

class Pracownik
{
    protected $db;                                       // Holds ref to Database object

    public function __construct(Database $db)
    {
        $this->db = $db;                                 // Store ref to Database object
    }

    
    //potwwypo.php
    public function getPracownik($pracownik)
    { 
        $sql="SELECT id,imie,nazwisko
        FROM pracownik
        where id=:pracownik;";
       return $this->db->runSql($sql,[$pracownik])->fetch();     
    }



    
}