<?php                      
include 'src/bootstrap.php';    


is_admin($session->role); 



$ksiazka = $cms->getKsiazka()->indexKsiazki();

$today=date("Y-m-d");
$przedawnione = $cms->getWypozyczenie()->indexWypozyczenia($today);








?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Strona główna</title>
    <?php include 'includes/header.php'; ?>  
    
    <?php include 'includes/wykres.php'; ?>    
    

</head>
<body>
<br><br><br><br>
<div class="glowna">
    <div class="ramka1">
    
        
        <h1>Najnowsze ksiązki:</h1><br>
        <?php foreach($ksiazka as $pojedynczo) { ?> 
            <div class="ramka">
                <div class="column">
                    <img class="image-resize" src="uploads/<?= html_escape($pojedynczo['okladka'] ?? 'blank.png') ?>">
                </div> 
                <div class="tekst">
                    <?= "Tytuł: ".$pojedynczo['tytul'] ?><br>
                    <?= "Autor: ". $pojedynczo['autor'] ?><br>
                    <?= "Gatunek: ".$pojedynczo['gatunek'] ?><br>
                </div>
                <div class="button1">
                    <a href="ksiazka.php?id=<?= $pojedynczo['id'] ?>" class="btnzobacz" >ZOBACZ</a><br> 
                </div>
                
            </div>
            <div class="przerwa">
                    
                </div>
        <?php }?>
        
    </div>
    <div class="ramka2">
      
    <h1>Przedawnione książki:</h1><br>
        <?php foreach($przedawnione as $pojedynczo) { ?> 
            <div class="ramka">
            <div class="column">
                    <img class="image-resize" src="uploads/<?= html_escape($pojedynczo['okladka'] ?? 'blank.png') ?>">
                </div> 
                <?php /* $today=date("Y-m-d");
                     $suma=$today-$pojedynczo['Do'];
                     */
                 ?>
                <div class="tekst">
                    <?= "Data oddania: ".$pojedynczo['Do'] ?><br>
                    <?= "Tytuł: ".$pojedynczo['tytul'] ?><br>
                    <?= "Data oddania: ".$pojedynczo['autor'] ?><br>
                    
                </div>
                <div class="button1">
                    <a href="oddajksiazke.php?id=<?= $pojedynczo['id'] ?>" class="btnzobacz" >ZGLOŚ</a><br> 
                </div>
                
            </div>
            <div class="przerwa">
                    
                </div>
        <?php }?>
        
    </div>
</div>
      
<?php include 'includes/footer.php'; ?>
</body>
</html>