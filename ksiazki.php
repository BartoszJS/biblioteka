<?php                  
declare(strict_types = 1);     
include 'src/bootstrap.php';    




$term  = filter_input(INPUT_GET, 'term');                 // Get search term
$show  = filter_input(INPUT_GET, 'show', FILTER_VALIDATE_INT) ?? 8; // Limit
$from  = filter_input(INPUT_GET, 'from', FILTER_VALIDATE_INT) ?? 0; // Offset
$count = 0;
$ksiazki=[];


if(!$term){
    $count = 0;
    $count = $cms->getKsiazka()->liczDostepne();  
    if($count>0){
        $ksiazki = $cms->getKsiazka()->getDostepne($show,$from);  
    }
}


if($term){

    $count = $cms->getKsiazka()->policzTerm($term);  
    if ($count > 0) {  
        $ksiazki = $cms->getKsiazka()->getDostepneTerm($show,$from,$term);  
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
    <link rel="icon" href="photos/favicon.ico" type="image/x-icon"/>
    <title>Książki</title>
    <?php if((isset($_SESSION['id']))==true) { ?> 
    <?php include 'includes/header-loged.php'; ?>  
    <?php }else{ ?> 
    <?php include 'includes/header.php'; ?>    
    <?php }?>



</head>
<body>



<div class="ksiazki">
     
    <div class="dostepne">

    <div class="nagl"><h1>Dostępne książki:</h1></div>
    <div class="szukaj">
        <form action="ksiazki.php" method="get" class="form-search">
                <label for="search"><span> </span></label>
                <input type="text" name="term" id="search" placeholder="Wyszukaj tutaj:"  />
                <input type="submit" value="Szukaj" class="btnksiazka" />
                    
        </form>
    </div>
    
    

    </div>
<!--   
    <div class="btnwypozyczone"><a href="wypozyczone.php" class="btnwypozycz">WYPOŻYCZONE KSIĄŻKI</a></div>
    -->


    
</div>
    

    <div class="books_container">
        
    <?php foreach($ksiazki as $pojedynczo) { ?> 
        <div class="books_container-book">
        
    
       <div class="books_container-book-img">
                    <img class="books_container-book-img-img" src="uploads/<?= html_escape($pojedynczo['okladka'] ?? 'blank.png') ?>">
                </div>
               <div class="books_container-book-text">
                    
                    <?= "ID: ".$pojedynczo['ID'] ?><br>
                    <?= "Tytuł: ".$pojedynczo['tytul'] ?><br>
                    <?= "Autor: ". $pojedynczo['autor'] ?><br>
                    <?= "Gatunek: ".$pojedynczo['gatunek'] ?><br>
                    <?= "Liczba stron: ".$pojedynczo['liczba_stron'] ?><br>
                    </div>
              
              <div class="books_container-book-button">
                        <a href="ksiazka.php?id=<?= $pojedynczo['ID'] ?>" class="btnksiazka">ZOBACZ</a> 
                        <a href="wypozycz.php?id=<?= $pojedynczo['ID'] ?>" class="btnksiazka">ZAREZERWUJ</a> 
                </div>
                 
           
            
   
    </div>
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

