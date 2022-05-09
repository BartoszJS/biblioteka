<?php
namespace PhpBook\CMS;     

class Wypozyczenie
{
    protected $db;                                       // Holds ref to Database object

    public function __construct(Database $db)
    {
        $this->db = $db;                                 // Store ref to Database object
    }
        
    

    public function getAll()
    { 


      $sql="SELECT ID,IdPracownika,IdCzytelnika,IdKsiazki,Data_wypozyczenia,Czas,Do
      from wypozyczenia
      order by ID desc;";
                
                
              
        return $this->db->runSql($sql)->fetchAll();   
                 
    }
    public function getAllSort()
    { 


      $sql="SELECT ID,IdPracownika,IdCzytelnika,IdKsiazki,Data_wypozyczenia,Czas,Do
      from wypozyczenia
      order by Data_wypozyczenia asc;";
                
                
              
        return $this->db->runSql($sql)->fetchAll();   
                 
    }



    
    //potwwypo.php
    public function insertWypozyczenie($arguments)
    { 
        $sql="INSERT INTO wypozyczenia(IdPracownika,IdCzytelnika,IdKsiazki,Data_wypozyczenia,Czas,Do,zakonczona)
                values(:IdPracownika,:IdCzytelnika,:IdKsiazki,:Data_wypozyczenia,:Czas,:Do,:zakonczona);";
                
                
                try{
                    return $this->db->runSql($sql,$arguments)->fetch();   
                    header("Location: wypozyczono.php"); 
                    exit();
                  }catch(PDOException $e){
                    throw $e;
                  }
        //index.php
    }
    public function indexWypozyczenia($today)
    { 
      $sql="SELECT wypozyczenia.IdPracownika, wypozyczenia.IdCzytelnika,wypozyczenia.IdKsiazki,
      wypozyczenia.Data_wypozyczenia, wypozyczenia.Czas, wypozyczenia.Do, wypozyczenia.zakonczona,ksiazki.id,ksiazki.tytul,
      ksiazki.autor,ksiazki.okladka
      FROM wypozyczenia
      join ksiazki on wypozyczenia.IdKsiazki = ksiazki.id
      where wypozyczenia.Do<:today
      and wypozyczenia.zakonczona=0
      order by Do asc
      limit 6;";
  
 
  return $this->db->runSql($sql,[$today])->fetchAll();  
        
    }

    //czytelnik.php
    public function getWypozyczeniaCzytelnika($id){

      $sql="SELECT wypozyczenia.IdPracownika, wypozyczenia.IdCzytelnika, wypozyczenia.IdKsiazki,wypozyczenia.Data_wypozyczenia,wypozyczenia.Czas,
        wypozyczenia.Do,wypozyczenia.zakonczona,ksiazki.id,ksiazki.tytul,ksiazki.autor,ksiazki.dostepnosc,ksiazki.okladka,ksiazki.gatunek
        FROM wypozyczenia
        join ksiazki on wypozyczenia.IdKsiazki = ksiazki.id
        where IdCzytelnika=:id;";

      return $this->db->runSql($sql,[$id])->fetchAll();
    }


    public function usunWypozyczeniaCzytelnika($id){
      $sql="DELETE FROM wypozyczenia where IdCzytelnika=:id;";
      return $this->db->runSql($sql,[$id])->fetch();

    }

    public function getDataOddania($id){


    $sql="SELECT ID,IdPracownika,IdCzytelnika,IdKsiazki,Data_wypozyczenia,Czas
      from wypozyczenia
      where IdKsiazki=:id
      order by ID desc
      limit 1;";
       return $this->db->runSql($sql,[$id])->fetch();  


    }


    public function getIdWypozyczenia($id){


    $sql="SELECT IdCzytelnika
      from wypozyczenia
      where IdKsiazki=:id
      order by ID desc
      limit 1;";
       return $this->db->runSql($sql,[$id])->fetchColumn();  


    }



    public function updateZakonczona($id)
    { 
        $sql="UPDATE wypozyczenia
        SET zakonczona = 1
        where id=:id;";
       return $this->db->runSql($sql,[$id])->fetch();     
    }

    public function liczDlaDaty($data)
    {  
        


    $sql="SELECT COUNT(id) 
    from wypozyczenia
    where Data_wypozyczenia =:data;";


    return $this->db->runSql($sql,[$data])->fetchColumn(); 

    }

    
}