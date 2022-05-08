<?php                      
include 'src/bootstrap.php';    
include 'src/database-connection.php'; 

is_admin($session->role); 


$sql="SELECT id,tytul,autor,dostepnosc,okladka,gatunek,liczba_stron
    FROM ksiazki
    where dostepnosc=1   
    order by id desc
    limit 6;";
$ksiazka = pdo($pdo,$sql)->fetchAll();

$today=date("Y-m-d");
$sql="SELECT wypozyczenia.IdPracownika, wypozyczenia.IdCzytelnika,wypozyczenia.IdKsiazki,
    wypozyczenia.Data_wypozyczenia, wypozyczenia.Czas, wypozyczenia.Do, wypozyczenia.zakonczona,ksiazki.id,ksiazki.tytul,
    ksiazki.autor,ksiazki.okladka
    FROM wypozyczenia
    join ksiazki on wypozyczenia.IdKsiazki = ksiazki.id
    where wypozyczenia.Do<:today
    and wypozyczenia.zakonczona=0
    order by Do asc
    limit 6;";



$przedawnione = pdo($pdo,$sql,[$today])->fetchAll();








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