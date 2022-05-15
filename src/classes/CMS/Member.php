<?php
namespace PhpBook\CMS;                                   // Namespace declaration

class Member
{
    protected $db;                                       

    public function __construct(Database $db)
    {
        $this->db = $db;                                 
    }

    // Get individual member by id
    public function get(int $id)
    {
        $sql = "SELECT id, imie, nazwisko, login, data_dolaczenia, telefon, role 
                  FROM pracownik
                 WHERE id = :id;";                      
        return $this->db->runSQL($sql, [$id])->fetch(); 
    }

    // Get details of all members
    public function getAll(): array
    {
        $sql = "SELECT id, imie, nazwisko, data_dolaczenia, telefon, role 
                  FROM member;";                        
        return $this->db->runSQL($sql)->fetchAll();      
    }

    // Get individual member data using their login
    public function getIdByEmail(string $login)
    {
        $sql = "SELECT id
                  FROM member
                 WHERE login = :login;";                        
        return $this->db->runSQL($sql, [$login])->fetchColumn(); 
    }

    // Login: returns member data if authenticated, false if not
    public function login(string $login, string $haslo)
    {
        $sql = "SELECT id, imie, nazwisko, login, haslo, telefon, role 
                  FROM pracownik
                 WHERE login = :login;";                        
        $member = $this->db->runSQL($sql, [$login])->fetch(); 
        if (!$member) {                                         
            return false;                                       
        }           
        if($haslo == $member['haslo']){
        return $member;
        }else{

            return false;
        }
        // $authenticated = password_verify($haslo, $member['haslo']); // Passwords match?
        // return ($authenticated ? $member : false);               // Return member or false
    }

    // Get total number of members
    public function count(): int
    {
        $sql = "SELECT COUNT(id) FROM member;";                 
        return $this->db->runSQL($sql)->fetchColumn();         
    }

    // Create a new member
    public function create(array $member): bool
    {
        $member['haslo'] = password_hash($member['haslo'], PASSWORD_DEFAULT);  
        try {                                                          
            $sql="INSERT INTO member(imie,nazwisko,login,haslo,telefon,role)
            values (:imie,:nazwisko,:login,:haslo,:telefon,'member');"; 
            $this->db->runSQL($sql, $member);                          
            return true;                                               
        } catch (\PDOException $e) {                                   
            if ($e->errorInfo[1] === 1062) {                           
                return false;                                          
            }                                                          
            throw $e;                                                  
        }
    }

    // Update an existing member
    public function update(array $member): bool
    {
        unset($member['data_dolaczenia'],  $member['telefon']);               
        try {                                                        
            $sql = "UPDATE member 
                       SET imie = :imie, nazwisko = :nazwisko, login = :login, role = :role 
                     WHERE id = :id;";                               
            $this->db->runSQL($sql, $member);                      
            return true;                                           
        } catch (\PDOException $e) {                             
            if ($e->errorInfo[1] == 1062) {                        
                return false;                               
            }                                                      
            throw $e;                                               
        }
    }

  
}