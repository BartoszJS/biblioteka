<?php                      
include 'src/bootstrap.php';    
include 'src/database-connection.php'; 
include 'src/validate.php';

$term  = filter_input(INPUT_GET, 'term');                 // Get search term
$show  = filter_input(INPUT_GET, 'show', FILTER_VALIDATE_INT) ?? 8; // Limit
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
        where dostepnosc=1
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



<div class="ksiazki">
    <div class="h1"><h1>Dostępne książki:</h1></div>
    <div class="btnwypo"><a href="wypozyczone.php" class="btnwypozycz">WYPOŻYCZONE KSIĄŻKI</a></div>
    <div class="ksiazkiszukaj">
        <div class="szukaj">
            <form action="ksiazki.php" method="get" class="form-search">
                    <label for="search"><span> </span></label>
                    <input type="text" name="term" id="search" placeholder="Wyszukaj tutaj:"  />
                    <input type="submit" value="Szukaj" class="btnksiazka" />
                    
            </form>
        </div>
    </div>
    <div class="buttony">
            <a href="dodajksiazke.php" class="btnwypozycz">DODAJ KSIĄŻKĘ</a> <br><br>
    </div> 
    
        
   
    <?php foreach($ksiazki as $pojedynczo) { ?> 
    <a href="ksiazka.php?id=<?= $pojedynczo['ID'] ?>">
        <div class="ramka">
            <div class="rameczka">
                <div class="column">
                    <img class="image-resize" src="uploads/<?= html_escape($pojedynczo['okladka'] ?? 'blank.png') ?>">
                </div> 
                <div class="tekst">
                    <?= "ID: ".$pojedynczo['ID'] ?><br>
                    <?= "Tytuł: ".$pojedynczo['tytul'] ?><br>
                    <?= "Autor: ". $pojedynczo['autor'] ?><br>
                    <?= "Gatunek: ".$pojedynczo['gatunek'] ?><br>
                    <?= "Liczba stron: ".$pojedynczo['liczba_stron'] ?><br>
                </div>
                <div class="buttons">
                        <a href="wypozycz.php?id=<?= $pojedynczo['ID'] ?>" class="btnksiazka">WYPOZYCZ</a> <br>
                        <a href="edytujksiazke.php?id=<?= $pojedynczo['ID'] ?>" class="btnksiazka">EDYTUJ</a> <br>
                        <a href="usunksiazke.php?id=<?= $pojedynczo['ID'] ?>" class="btnksiazka">USUŃ</a> <br>
                      
                </div>
            </div>
        </div>
    </a>
    <?php }?>
    
</div>

<div class="clear"></div>

<?php  if ($count > $show) { ?>
    <nav class="pagination" role="navigation" aria-label="Pagination Navigation">
      <ul>
      <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
        <li>
          <a href="?term=<?= $term ?>&show=<?= $show ?>&from=<?= (($i - 1) * $show) ?>"
            class="btnpage <?= ($i == $current_page) ? 'active" aria-current="true' : '' ?>">
            <?= $i ?>
          </a>
        </li>
      <?php } ?>
      </ul>
    </nav>
    <?php } ?>


      
<?php include 'includes/footer.php'; ?>
</body>
</html>