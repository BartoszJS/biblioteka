<?php                      
include 'src/bootstrap.php';    
include 'src/database-connection.php'; 

is_admin($session->role); 

$term  = filter_input(INPUT_GET, 'term');                 // Get search term
$show  = filter_input(INPUT_GET, 'show', FILTER_VALIDATE_INT) ?? 8; // Limit
$from  = filter_input(INPUT_GET, 'from', FILTER_VALIDATE_INT) ?? 0; // Offset
$count = 0;
$czytelnicy=[];


if(!$term){
    $count = 0;
    $count = $cms->getCzytelnik()->liczCzytelnikow();  
    if($count>0){
        $czytelnicy =$cms->getCzytelnik()->getCzytelnikow($show,$from);  
    }

}

if($term){

    $count = $cms->getCzytelnik()->policzTerm($term);  
    if ($count > 0) {  
        $czytelnicy = $cms->getCzytelnik()->getCzytelnikowTerm($show,$from,$term);  
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
<div class="czytelnicy">

    <div class="ramka1">
        
        <h1>Czytelnicy: </h1>
        <br>
        <div class="szukaj">
        <form action="czytelnicy.php" method="get" class="form-search">
                    <label for="search"><span> </span></label>
                    <input type="text" name="term" 
                        id="search" placeholder="Wyszukaj tutaj:"  
                    /><input type="submit" value="Szukaj" class="btnszukajo" />
                    
            </form>
        </div>
        <div class="dodajbutton">
            <a href="dodajczytelnika.php" class="btndodaj">DODAJ CZYTELNIKA</a>
        </div> <br>
   
        <?php foreach($czytelnicy as $pojedynczo) { ?> 
            <a href="czytelnik.php?id=<?= $pojedynczo['ID'] ?>" >
            <div class="ramkaczytelnicy">
           
                <div class="tekst">
                    <div class="id">  <?= $pojedynczo['ID']; ?></div>
                
                    <?= $pojedynczo['imie']; ?>
                    <?= $pojedynczo['nazwisko']; ?><br>
                    <?= "Nr telefonu: ".$pojedynczo['numer_telefonu']; ?> <br>
                    <?= "E-mail: ".$pojedynczo['adres_email']; ?>
                </div>
                <div class="przyciski">
                
                    <a href="edytujczytelnika.php?id=<?= $pojedynczo['ID'] ?>" class="btnzobacz">EDYTUJ</a>
                    <a href="usunczytelnika.php?id=<?= $pojedynczo['ID'] ?>" class="btnzobacz">USUŃ</a>
                </div>
            </div>
            </a> 
        <?php }?>
        
    </div>
 
</div>


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