<?php                      
include 'src/bootstrap.php';    


$ksiazka = $cms->getKsiazka()->indexKsiazki();
$today=date("Y-m-d");
$polecane = $cms->getWypozyczenie()->indexWypozyczenia();




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Strona główna</title>
    

    <?php if((isset($_SESSION['id']))==true) { ?> 
    <?php include 'includes/header-loged.php'; ?>  
    <?php }else{ ?> 
    <?php include 'includes/header.php'; ?>    
    <?php }?>




 
    

</head>
<body>

<div class="back">
    <div class="content_back">
        <p>Biblioteka nr 1 w Radomiu</p>
        <button class="button_back">Zobacz książki</button>
    </div>
</div>
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
    <div class="ramka1">
      
    <h1>Polecane ksiązki:</h1><br>
        <?php foreach($polecane as $pojedynczo) { ?> 
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
</div>
      
<?php include 'includes/footer.php'; ?>
</body>
</html>