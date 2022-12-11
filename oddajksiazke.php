<?php
            
include 'src/bootstrap.php';    


is_admin($session->role); 

$errors['id']='';


$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); // Validate id
if (!$id) {     
    header("Location: nieznaleziono.php");  
    exit();                                          // If no valid id
}
$data=$cms->getWypozyczenie()->getDataOddania($id);     
$idWypo=$cms->getWypozyczenie()->getIdWypozyczenia($id);     
$czytelnik = $cms->getCzytelnik()->getCzytelnik($idWypo);
$ksiazka =  $cms->getKsiazka()->getKsiazka($id);     
if (!$ksiazka) {   
    header("Location: nieznaleziono.php");  
    exit();                                 // Page not found
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="photos/favicon.ico" type="image/x-icon"/>
    <title>Oddaj książkę</title>
    <?php if((isset($_SESSION['id']))==true) { ?> 
    <?php include 'includes/header-loged.php'; ?>  
    <?php }else{ ?> 
    <?php include 'includes/header.php'; ?>    
    <?php }?>



</head>
<body>
<br><br><br><br><br><br><br>
<div class="wypozycz">
    <div class="ramka">
            <div class="okladka">
                <img class="image-resize" src="uploads/<?= html_escape($ksiazka['okladka'] ?? 'blank.png') ?>">
            </div>
            <div class="tekst">
            <h2>Formularz oddania książki:</h2><br>
                <h3>Książka:</h3>
                
                <?= "ID: ".$ksiazka['id']?> <br>
                <?= "Tytuł: ".$ksiazka['tytul']?><br>
                <?= "Autor: ".$ksiazka['autor']?> <br>
                <?= "Gatunek: ".$ksiazka['gatunek']?> <br>
                <?= "Liczba stron: ".$ksiazka['liczba_stron']?> <br>
            </div>
            <div class="tekst">
                <h3>Wypożyczona do:</h3>
                <?php
                    $czas=strtotime("+".$data['Czas']." Days");
                    $od=strtotime($data['Data_wypozyczenia']);
                    $do=date("Y-m-d", strtotime("+".$data['Czas']." Days" ,strtotime($data['Data_wypozyczenia'])));
                ?>
                <?php "Do: ".$czas?> 
                <?php "Do: ".date("Y-m-d",strtotime($data['Data_wypozyczenia']))?> 
                <?= $do?> <br>
            </div>
            <div class="tekst">
                <h3>Wypożyczona przez:</h3>
                <?= "ID: ".$idWypo ?><br>
                <?= $czytelnik['imie'] ?>
                <?= $czytelnik['nazwisko'] ?><br>
                <?= "E-mail: ".$czytelnik['login'] ?><br>
                <?= "Nr telefonu: ".$czytelnik['numer_telefonu'] ?><br>
            </div>
            <form action="oddajpotwierdz.php?id=<?= $ksiazka['id'] ?>" method="POST" enctype="multipart/form-data"> 
            <div class="tekst">
            
                    <input type="submit" name="update" class="btnprzywroc2" value="PRZYWRÓĆ "> 
                        
                
            </div>
           
                
            </form>

       
                     
                            
    </div>   
    
</div>

    <?php include 'includes/footer.php'; ?>  
</body>
</html>