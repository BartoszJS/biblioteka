<?php
namespace PhpBook\CMS;     

class Wypozyczenie
{
    protected $db;                                       // Holds ref to Database object

    public function __construct(Database $db)
    {
        $this->db = $db;                                 // Store ref to Database object
    }

    
    //potwwypo.php
    public function insertWypozyczenie($arguments)
    { 
        $sql="INSERT INTO wypozyczenia(IdPracownika,IdCzytelnika,IdKsiazki,Data_wypozyczenia,Czas)
                values(:IdPracownika,:IdCzytelnika,:IdKsiazki,:Data_wypozyczenia,:Czas);";
                
                
                try{
                    return $this->db->runSql($sql,$arguments)->fetch();   
                    header("Location: wypozyczono.php"); 
                    exit();
                  }catch(PDOException $e){
                    throw $e;
                  }
        
    }

    //czytelnik.php
    public function getWypozyczeniaCzytelnika($id){

      $sql="SELECT wypozyczenia.IdPracownika, wypozyczenia.IdCzytelnika, wypozyczenia.IdKsiazki,wypozyczenia.Data_wypozyczenia,wypozyczenia.Czas,
        ksiazki.id,ksiazki.tytul,ksiazki.autor,ksiazki.dostepnosc,ksiazki.okladka,ksiazki.gatunek
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

    
}