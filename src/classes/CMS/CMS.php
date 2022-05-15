<?php
namespace PhpBook\CMS;                                  

class CMS
{
    protected $db        = null;                                        
    protected $member    = null;                        
    protected $session   = null;                              
    protected $ksiazka     = null;                         
    protected $czytelnik     = null;                        
    protected $wypozyczenie     = null;                       
    protected $pracownik     = null;                    

    public function __construct($dsn, $username, $password)
    {
        $this->db = new Database($dsn, $username, $password); 
    }

   

    public function getMember()
    {
        if ($this->member === null) {                 
            $this->member = new Member($this->db);     
        }
        return $this->member;                          
    }

    public function getSession()
    {
        if ($this->session === null) {                 
            $this->session = new Session($this->db);    
        }
        return $this->session;                          
    }

    
    public function getKsiazka()
    {
        if ($this->ksiazka === null) {                   
            $this->ksiazka = new Ksiazka($this->db);      
        }
        return $this->ksiazka;                          
    }
    public function getCzytelnik()
    {
        if ($this->czytelnik === null) {                     
            $this->czytelnik = new Czytelnik($this->db);      
        }
        return $this->czytelnik;                          
    }
    public function getWypozyczenie()
    {
        if ($this->wypozyczenie === null) {                     
            $this->wypozyczenie = new Wypozyczenie($this->db);      
        }
        return $this->wypozyczenie;                          
    }
    public function getPracownik()
    {
        if ($this->pracownik === null) {                     
            $this->pracownik = new Pracownik($this->db);      
        }
        return $this->pracownik;                          
    }


  
}