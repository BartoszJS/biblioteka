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
        $sql = "SELECT id, imie, nazwisko, login, haslo, numer_telefonu
                  FROM czytelnik
                 WHERE login = :login;";                        
        $member = $this->db->runSQL($sql, [$login])->fetch(); 
        if (!$member) {                                       
            return false;                                       
        }           
        $authenticated = password_verify($haslo, $member['haslo']); 
        return ($authenticated ? $member : false);  
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
        
        $sql="INSERT INTO czytelnik(imie,nazwisko,numer_telefonu,login,haslo)
        values            (:imie,:nazwisko,:numer_telefonu,:login,:haslo);";
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