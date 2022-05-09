<?php
            
include 'src/bootstrap.php';    


is_admin($session->role); 

$errors['id']='';




if($_SERVER['REQUEST_METHOD'] == 'POST') {
   

    $pracownik=$_POST['IdPracownika'];
    $czytelnik=$_POST['IdCzytelnika'];
    $ksiazka=$_POST['IdKsiazki'];
    $rent['Data_wypozyczenia']=$_POST['Data_wypozyczenia'];
    $rent['Czas']=$_POST['Czas'];
    $od=date("Y-m-d", strtotime($rent['Data_wypozyczenia']));

    
    $book =    $cms->getKsiazka()->getKsiazka($ksiazka); 
    $reader = $cms->getCzytelnik()->getCzytelnik($czytelnik);
    $worker = $cms->getPracownik()->getPracownik($pracownik);


    



   
    

    $czas=strtotime("+".$rent['Czas']." Days");
    
  
    $do=date("Y-m-d", strtotime("+".$rent['Czas']." Days" ,strtotime($rent['Data_wypozyczenia'])));
}  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Wypożycz</title>
    <?php include 'includes/header.php'; ?>    
    

</head>
<body>
<br><br><br><br><br><br><br>
<div class="wypozycz">
    <div class="ramka">
            
    <div class="okladka">
                <img class="image-resize" src="uploads/<?= html_escape($book['okladka'] ?? 'blank.png') ?>">
            </div>
            <div class="tekst">
                <h2>Podsumowanie wypożyczenia:</h2><br>
                <h3>Książka:</h3>
                <?= "ID: ".$book['id']?> <br>
                <?= "Tytuł: ".$book['tytul']?><br>
                <?= "Autor: ".$book['autor']?> <br>
                <?= "Gatunek: ".$book['gatunek']?> <br>
                <?= "Liczba stron: ".$book['liczba_stron']?> <br>
            </div>
            <div class="tekst">
             <h3>Dane pracownika:</h3>
                <?= "ID: ".$worker['id'] ?><br>
                <?=        $worker['imie'] ?>
                <?=        $worker['nazwisko'] ?>
            </div>
            <div class="tekst">
            <h3>Dane czytelnika:</h3>
                <?= "ID: ".$reader['id'] ?><br>
                <?=        $reader['imie'] ?>
                <?=        $reader['nazwisko'] ?><br>
                <?= "Adres e-mail: ".$reader['adres_email'] ?><br>
                <?= "Nr telefonu: ".$reader['numer_telefonu'] ?><br>
            </div>
            <div class="tekst">
            <h3>Czas wypożyczenia :</h3>
                <?= "Od: ".$rent['Data_wypozyczenia'] ?><br>
                <?= "Do: ".$do ?><br>
            </div>

            <form action="wypozyczono.php" method="POST" enctype="multipart/form-data"> 
                <input type="hidden" name="IdPracownika" id="IdPracownika" value= "<?=$worker['id'] ?>">
                <input type="hidden" name="IdCzytelnika" id="IdCzytelnika" value= "<?= $reader['id'] ?> ">
                <input type="hidden" name="IdKsiazki" id="IdKsiazki"       value= "<?= $book['id'] ?> ">
                <input type="hidden" name="Data_wypozyczenia" id="Data_wypozyczenia" value= "<?= $od ?> ">
                <input type="hidden" name="Czas" id="Czas" value= "<?= $rent['Czas'] ?> ">
                <input type="hidden" name="Do" id="Do" value= "<?= $do ?> ">
                <input type="hidden" name="zakonczona" id="zakonczona" value= "<?= '0' ?> ">

                <div class="buttons">
                    <input type="submit" name="update" class="btnbook" value="POTWIERDZ "> <br>
                        
                </div>
            
            </form>  
        
    
                            
    </div>   
    
</div>

    <?php include 'includes/footer.php'; ?>  
</body>
</html>