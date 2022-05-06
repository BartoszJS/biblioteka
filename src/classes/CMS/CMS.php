<?php
namespace PhpBook\CMS;                                   // Namespace declaration

class CMS
{
    protected $db        = null;                         // Stores reference to Database object
    protected $article   = null;                         // Stores reference to Article object
    protected $category  = null;                         // Stores reference to Category object
    protected $member    = null;                         // Stores reference to Member object
    protected $session   = null;                         // Stores reference to Session object
    protected $token     = null;                         // Stores reference to Token object
    protected $ksiazka     = null;                         // Stores reference to Token object

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


  
}