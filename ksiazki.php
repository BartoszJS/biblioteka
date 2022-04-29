<?php                      
include 'src/bootstrap.php';    
include 'src/database-connection.php'; 
include 'src/validate.php';

$term  = filter_input(INPUT_GET, 'term');                 // Get search term
$show  = filter_input(INPUT_GET, 'show', FILTER_VALIDATE_INT) ?? 10; // Limit
$from  = filter_input(INPUT_GET, 'from', FILTER_VALIDATE_INT) ?? 0; // Offset
$count = 0;
$ksiazki=[];


if(!$term){
    $count = 0;
    $sqlicz="SELECT COUNT(id) from ksiazki ;";
    $count = pdo($pdo, $sqlicz)->fetchColumn();
    if($count>0){
        $arguments['show'] = $show;                     
        $arguments['from'] = $from;

        $sql="SELECT ID,tytul,autor,dostepnosc,okladka,gatunek,liczba_stron
        FROM ksiazki  
        order by id desc
        limit :show
        OFFSET :from;";
        $ksiazki = pdo($pdo,$sql, $arguments)->fetchAll();
    }
}






if($term){
    
    $arguments['term1'] ='%'.$term.'%'; 
    $arguments['term2'] ='%'.$term.'%';            // three times as placeholders
    $arguments['term3'] ='%'.$term.'%';
    $arguments['term4'] ='%'.$term.'%';


    $sql="SELECT COUNT(id) 
    from ksiazki
    where tytul like :term1
    or id like :term2
    or autor like :term3
    or gatunek like :term4
    and dostepnosc=1;";


    $count = 0;
    $count = pdo($pdo, $sql, $arguments)->fetchColumn();

    if ($count > 0) {  
        $arguments['show'] = $show;                       // Add to array for pagination
        $arguments['from'] = $from; 
        

        $sql="SELECT ID,tytul,autor,dostepnosc,okladka,gatunek,liczba_stron
        FROM ksiazki  
            where tytul like :term1
            or id like :term2
            or autor like :term3
            or gatunek like :term4
            and dostepnosc=1
            order by id desc
            limit :show
            OFFSET :from;";
        $ksiazki = pdo($pdo,$sql,$arguments)->fetchAll();
    }
}


if ($count > $show) {                                     // If matches is more than show
    $total_pages  = ceil($count / $show);                 // Calculate total pages
    $current_page = ceil($from / $show) + 1;              // Calculate current page
}



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

<?php /* 
<div class="czytelnicy">

    <div class="ramka1">
        
        <h1>Ksiazki: </h1>
        <br>
        <div class="szukaj">
        <form action="ksiazki.php" method="get" class="form-search">
                    <label for="search"><span> </span></label>
                    <input type="text" name="term" 
                        id="search" placeholder="Wyszukaj tutaj:"  
                    /><input type="submit" value="Szukaj" class="btnszukajo" />
                    
            </form>
        </div>
        <div class="dodajbutton">
            <a href="dodajczytelnika.php" class="btndodaj">DODAJ CZYTELNIKA</a>
        </div> <br>
   
        <?php foreach($ksiazki as $pojedynczo) { ?> 
            <div class="ramkaczytelnicy">
           
                <div class="tekst">
                    <div class="id">  <?= $pojedynczo['ID']; ?></div>
                
                    <?= $pojedynczo['tytul']; ?>
                    <?= $pojedynczo['autor']; ?><br>
                    <?= $pojedynczo['ID']; ?> <br>
                    <?= $pojedynczo['gatunek']; ?>
                </div>
                <div class="przyciski">
                <a href="ksiazki.php" class="btnzobacz">ZOBACZ</a> 
                    <a href="edytujksiazkia.php?id=<?= $pojedynczo['ID'] ?>" class="btnzobacz">EDYTUJ</a>
                    <a href="usunksiazkia.php?id=<?= $pojedynczo['ID'] ?>" class="btnzobacz">USUŃ</a>
                </div>
            </div>
        <?php }?>
        
    </div>
 
</div>

*/ ?>

<div class="ksiazki">
<?php foreach($ksiazki as $pojedynczo) { ?> 
    <a href="ksiazka.php?id=<?= $pojedynczo['ID'] ?>">
            <div class="ramka">
                <div class="rameczka">
                    <div class="column">
                        <img class="image-resize" src="uploads/<?= html_escape($pojedynczo['okladka'] ?? 'blank.png') ?>">
                    </div> 
                    <div class="tekst">
                        <?= "Tytuł: ".$pojedynczo['tytul'] ?><br>
                        <?= "Autor: ". $pojedynczo['autor'] ?><br>
                        <?= "Gatunek: ".$pojedynczo['gatunek'] ?><br>
                    </div>
                    <div class="buttons">
                        <a href="wypozyczksiazke.php?id=<?= $pojedynczo['ID'] ?>" class="btnksiazka">WYPOZYCZ</a> <br>
                        <a href="edytujksiazke.php?id=<?= $pojedynczo['ID'] ?>" class="btnksiazka">EDYTUJ</a> <br>
                        <a href="usunksiazke.php?id=<?= $pojedynczo['ID'] ?>" class="btnksiazka">USUŃ</a> <br>
                      
                    </div>
                </div>
            </div>
            </a>
        <?php }?>
</div>

      
<?php include 'includes/footer.php'; ?>
</body>
</html>