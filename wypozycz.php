<?php
            
include 'src/bootstrap.php';  


loggedin($session->id);




$errors['id']='';


$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); // Validate id
if (!$id) {     
    header("Location: nieznaleziono.php");  
    exit();                                          // If no valid id
}

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
    <title>Wypożycz</title>
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
            <h2>Wypożycz:</h2><br>
                <h3>Książka:</h3>
                <?= "ID: ".$ksiazka['id']?> <br>
                <?= "Tytuł: ".$ksiazka['tytul']?><br>
                <?= "Autor: ".$ksiazka['autor']?> <br>
                <?= "Gatunek: ".$ksiazka['gatunek']?> <br>
                <?= "Liczba stron: ".$ksiazka['liczba_stron']?> <br>
            </div>
            <div class="tekst">
             <h3>Twoje dane:</h3>
                <?= "ID: ".$_SESSION['id'] ?><br>
                <?= $_SESSION['imie'] ?><br>
                <?= $_SESSION['nazwisko'] ?><br>
                <?= $_SESSION['login'] ?><br>
                <?= $_SESSION['numer_telefonu'] ?>


               
            </div>
        <form action="potwierdzwypozyczenie.php" method="POST" enctype="multipart/form-data"> 
            <input type="hidden" name="IdPracownika" id="IdPracownika" value= "1">
            <input type="hidden" name="IdKsiazki" id="IdKsiazki" value= "<?= $ksiazka['id'] ?> ">
            <input type="hidden" name="IdCzytelnika" id="IdCzytelnika" value= "<?=$_SESSION['id'] ?>">
            <input type="hidden" name="Data_wypozyczenia" id="Data_wypozyczenia"  value="<?= date("Y-m-d") ?>">
            <input type="hidden" name="Czas" id="Czas"  value="3">
             <p class="tekst">Książka zostanie zarezerwowana na 3 dni, <br> w tym czasie proszę odebrać książkę z naszej biblioteki</p>
                <div class="buttons">
                    <input type="submit" name="update" class="btnbook" value="ZAREZERWUJ"> 
                        
                </div>
        </form>  
                     
                            
    </div>   
    
</div>

    <?php include 'includes/footer.php'; ?>  
</body>
</html>