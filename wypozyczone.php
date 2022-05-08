<?php                      
include 'src/bootstrap.php';    
include 'src/database-connection.php'; 

is_admin($session->role); 

$term  = filter_input(INPUT_GET, 'term');                 // Get search term
$show  = filter_input(INPUT_GET, 'show', FILTER_VALIDATE_INT) ?? 10; // Limit
$from  = filter_input(INPUT_GET, 'from', FILTER_VALIDATE_INT) ?? 0; // Offset
$count = 0;
$ksiazki=[];
$data=[];


if(!$term){
    $count = 0;
    $count = $cms->getKsiazka()->liczNiedostepne();  
    if($count>0){
        $ksiazki = $cms->getKsiazka()->getNiedostepne($show,$from); 
    }
}

// $data=$cms->getWypozyczenie()->getDataOddania($id);   



if($term){
    
    $count = $cms->getKsiazka()->policzNieTerm($term);  
    if ($count > 0) {  
        $ksiazki = $cms->getKsiazka()->getNiedostepneTerm($show,$from,$term);  
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
    <div class="h1"><h1>Wypożyczone książki:</h1></div>
    <div class="btnwypo"><a href="ksiazki.php" class="btnwypozycz">DOSTĘPNE KSIĄŻKI</a></div>
    <div class="ksiazkiszukaj">
        <div class="szukaj">
            <form action="wypozyczone.php" method="get" class="form-search">
                    <label for="search"><span> </span></label>
                    <input type="text" name="term" id="search" placeholder="Wyszukaj tutaj:"  />
                    <input type="submit" value="Szukaj" class="btnksiazka" />
                    
            </form>
        </div>
    </div>
    <div class="buttony">
            <a href="dodajksiazke.php" class="btnwypozycz">DODAJ KSIĄZKĘ</a> <br><br>
    </div> 
    
        
   
    <?php foreach($ksiazki as $pojedynczo) { ?> 
    <a href="oddajksiazke.php?id=<?= $pojedynczo['ID'] ?>">
        <div class="ramka">
            <div class="rameczka">
                <div class="column">
                    <img class="image-resize" src="uploads/<?= html_escape($pojedynczo['okladka'] ?? 'blank.png') ?>">
                </div> 
                <div class="tekst">
                    
                 <?php /* getRentDate($pojedynczo['ID']); */ ?>
                   <h4> <?= "Wypożyczona do: " ?> 
                     <?= $pojedynczo['Do'] ?> </h4> <br>
                    <?= "ID: ".$pojedynczo['ID'] ?><br>
                    <?= "Tytuł: ".$pojedynczo['tytul'] ?><br>
                    <?= "Autor: ". $pojedynczo['autor'] ?><br>
                    <?= "Gatunek: ".$pojedynczo['gatunek'] ?><br>
                    <?= "Liczba stron: ".$pojedynczo['liczba_stron'] ?><br>
                </div>
                <div class="buttons">
                        <a href="oddajksiazke.php?id=<?= $pojedynczo['ID'] ?>" class="btnksiazka">ODDAJ</a> <br>
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