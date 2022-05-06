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
        $this->db = new Database($dsn, $username, $password); // Create Database object
    }

   

    public function getMember()
    {
        if ($this->member === null) {                    // If $member property null
            $this->member = new Member($this->db);       // Create Member object
        }
        return $this->member;                            // Return Member object
    }

    public function getSession()
    {
        if ($this->session === null) {                   // If $session property null
            $this->session = new Session($this->db);     // Create Session object
        }
        return $this->session;                           // Return Session object
    }

    
    public function getKsiazka()
    {
        if ($this->ksiazka === null) {                     // If $ksiazka property null
            $this->ksiazka = new Ksiazka($this->db);         // Create Token object
        }
        return $this->ksiazka;                             // Return Token object
    }
    public function getCzytelnik()
    {
        if ($this->czytelnik === null) {                     // If $czytelnik property null
            $this->czytelnik = new Czytelnik($this->db);         // Create Token object
        }
        return $this->czytelnik;                             // Return Token object
    }
    public function getWypozyczenie()
    {
        if ($this->wypozyczenie === null) {                     // If $wypozyczenie property null
            $this->wypozyczenie = new Wypozyczenie($this->db);         // Create Token object
        }
        return $this->wypozyczenie;                             // Return Token object
    }
    public function getPracownik()
    {
        if ($this->pracownik === null) {                     // If $pracownik property null
            $this->pracownik = new Pracownik($this->db);         // Create Token object
        }
        return $this->pracownik;                             // Return Token object
    }


  
}