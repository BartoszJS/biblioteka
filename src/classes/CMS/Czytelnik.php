<?php
namespace PhpBook\CMS;     

class Czytelnik
{
    protected $db;                                       // Holds ref to Database object

    public function __construct(Database $db)
    {
        $this->db = $db;                                 // Store ref to Database object
    }

    
    //potwwypo.php, czytelnik.php edytujczytelnika.php usunczytelnika.php
    public function getCzytelnik($czytelnik)
    { 
        $sql="SELECT id,imie,nazwisko,numer_telefonu,adres_email
        FROM czytelnik
        where id=:czytelnik;";
       return $this->db->runSql($sql,[$czytelnik])->fetch();     
    }

    

    //czytelnicy.php

    public function liczCzytelnikow()
    { 
        $sql="SELECT COUNT(id) from czytelnik ;";
       return $this->db->runSql($sql)->fetchColumn();  
    }
   


    public function getCzytelnikow($show,$from)
    {
        $arguments['show'] = $show;                     
        $arguments['from'] = $from;

        $sql="SELECT ID,imie,nazwisko,numer_telefonu,adres_email
        FROM czytelnik  
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


    $sql="SELECT COUNT(id) 
    from czytelnik
    where imie like :term1
    or id like :term2
    or nazwisko like :term3;";


    return $this->db->runSql($sql,$arguments)->fetchColumn(); 

    }

    public function getCzytelnikowTerm($show,$from,$term)
    {
        $arguments['show'] = $show;                       // Add to array for pagination
        $arguments['from'] = $from; 
        $arguments['term1'] ='%'.$term.'%'; 
        $arguments['term2'] ='%'.$term.'%';            // three times as placeholders
        $arguments['term3'] ='%'.$term.'%';
       
        

        $sql="SELECT ID,imie,nazwisko,numer_telefonu,adres_email
            FROM czytelnik
            where imie like :term1
            or id like :term2
            or nazwisko like :term3
            order by id desc
            limit :show
            OFFSET :from;";
       return $this->db->runSql($sql,$arguments)->fetchAll();    
    }

    //dodajczytelnika.php

    public function getLastId()
    { 
        $sql="SELECT ID
        FROM czytelnik
        order by id desc
        limit 1;";
         return $this->db->runSql($sql)->fetchColumn();     
    }

    

    public function dodajCzytelnika($arguments,$last)
    { 

    $sql="INSERT INTO czytelnik(imie,nazwisko,numer_telefonu,adres_email)
    values            (:imie,:nazwisko,:numer_telefonu,:adres_email);";
  

    try{
        $this->db->runSql($sql,$arguments)->fetch();  
        header("Location: czytelnik.php?id=".$last); 
        exit();
    }catch(PDOException $e){
      throw $e;
    }

    }

    //edytujczytelnika.php


    public function edytujCzytelnika($arguments,$id)
    { 

        $sql="UPDATE czytelnik 
        set imie=:imie,nazwisko=:nazwisko,numer_telefonu=:numer_telefonu,adres_email=:adres_email
        where id=:id;";
 

    
       

        try{
            $this->db->runSql($sql,$arguments)->fetch();  
            header("Location: czytelnik.php?id=".$id); 
            exit();
        }catch(PDOException $e){
          throw $e;
        }
   

    }
    //usunczytelnika.php


    public function usunCzytelnika($id)
    { 

        $sql="DELETE FROM czytelnik where id=:id;";
        return $this->db->runSql($sql,[$id])->fetch();

    }


    
}