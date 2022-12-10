<?php
namespace PhpBook\CMS;                                   // Declare namespace

class Session
{                                                        // Define Session class
    public $id;                                          // Store member's id
    public $imie;                                    // Store member's imie                                  

    public function __construct()
    {                                                    // Runs when object created
        session_start();                                 // Start, or restart, session
        $this->id       = $_SESSION['id'] ?? 0;          // Set id property of this object
        $this->imie = $_SESSION['imie'] ?? '';   // Set imie property of this object
        $this->nazwisko = $_SESSION['nazwisko'] ?? '';   // Set imie property of this object
        $this->login = $_SESSION['login'] ?? '';   // Set imie property of this object
        $this->numer_telefonu = $_SESSION['numer_telefonu'] ?? '';   // Set imie property of this object
        
    }

    // Create new session
    public function create($member)
    {
        session_regenerate_id(true);                     // Update session id
        $_SESSION['id']       = $member['id']; 
        $_SESSION['login'] = $member['login'];     // Add imie to session
        $_SESSION['haslo']     = $member['haslo'];          // Add member id to session
        $_SESSION['imie'] =  $member['imie'];     // Add imie to session
        $_SESSION['nazwisko']     = $member['nazwisko'];
        $_SESSION['numer_telefonu']     = $member['numer_telefonu'];
      
    }



    // Update existing session - alias for create()
    public function update($member)
    {
        $this->create($member);                          // Update data in session
    }

    // Delete existing session
    public function delete()
    {
        $_SESSION['id']       = 0; 
        $_SESSION['login'] = '';     // Add imie to session
        $_SESSION['haslo']     = '';          // Add member id to session
        $_SESSION['imie'] =  '';     // Add imie to session
        $_SESSION['nazwisko']     = '';
        $_SESSION['numer_telefonu']     = '';
                                
        $param    = session_get_cookie_params();         // Get session cookie parameters
        setcookie(session_name(), '', time() - 2400, $param['path'], $param['domain'],
            $param['secure'], $param['httponly']);       // Clear session cookie
        session_destroy();                               // Destroy the session
    }
}