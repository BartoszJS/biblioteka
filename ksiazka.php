<?php
            
include 'src/bootstrap.php';    



$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); // Validate id
if (!$id) {     
    header("Location: nieznaleziono.php");  
    exit();                                         // If no valid id
}

$ksiazka =  $cms->getKsiazka()->getKsiazka($id);    // Get article data
if (!$ksiazka) {   
    header("Location: nieznaleziono.php");  
    exit();                              // Page not found
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
    <title>Książka</title>
    <?php if((isset($_SESSION['id']))==true) { ?> 
    <?php include 'includes/header-loged.php'; ?>  
    <?php }else{ ?> 
    <?php include 'includes/header.php'; ?>    
    <?php }?>



</head>
<body>
    <div class="ksiazka">
        
 

        <div class="ksiazka_img">

            <img class="ksiazka_img-img" src="uploads/<?= html_escape($ksiazka['okladka'] ?? 'blank.png') ?>">
        </div>
        <div class="ksiazka_tekst">
                <?= "ID: ".$ksiazka['id']?> <br>
                <?= "Tytuł: ".$ksiazka['tytul']?><br>
                <?= "Autor: ".$ksiazka['autor']?> <br>
                <?= "Gatunek: ".$ksiazka['gatunek']?> <br>
                <?= "Liczba stron: ".$ksiazka['liczba_stron']?> <br>
        </div>
        <div class="ksiazka_button">
            <a href="wypozycz.php?id=<?= $ksiazka['id'] ?>" class="ksiazka_button-button">ZAREZERWUJ</a> 
        </div>
                
                
    </div>
            

    <?php include 'includes/footer.php'; ?>  
</body>
</html>