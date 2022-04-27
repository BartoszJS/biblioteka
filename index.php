<?php                      
include 'src/bootstrap.php';    
include 'src/database-connection.php'; 
include 'src/validate.php';

$sql="SELECT id,tytul,autor,dostepnosc,okladka,gatunek,liczba_stron
    FROM ksiazki
    where dostepnosc=1   
    order by id desc
    limit 6;";
$ksiazka = pdo($pdo,$sql)->fetchAll();


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
    

</head>
<body>
<br><br>
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
                    <a href="ksiazka.php" class="btnzobacz" >ZOBACZ</a><br> 
                </div>
            </div>
        <?php }?>
        
    </div>
    <div class="ramka2">
      
        <h1>najnowssze</h1>
        
    </div>
</div>
      
<?php include 'includes/footer.php'; ?>
</body>
</html>